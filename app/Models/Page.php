<?php
// app/Models/Page.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Page extends Model
{
    use HasFactory, SoftDeletes, HasSlug, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'template',
        'custom_fields',
        'user_id',
        'status',
        'show_in_menu',
        'menu_order',
    ];

    protected $casts = [
        'meta_keywords' => 'array',
        'custom_fields' => 'array',
        'show_in_menu' => 'boolean',
        'menu_order' => 'integer',
    ];

    // Slug Configuration
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    // Activity Log Configuration
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'status', 'show_in_menu'])
            ->logOnlyDirty();
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeInMenu($query)
    {
        return $query->where('show_in_menu', true)
                    ->orderBy('menu_order');
    }

    // Accessors
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image 
            ? asset('storage/' . $this->featured_image)
            : null;
    }

    public function getMetaTitleAttribute($value)
    {
        return $value ?: $this->title;
    }

    public function getMetaDescriptionAttribute($value)
    {
        return $value ?: \Str::limit(strip_tags($this->content), 150);
    }

    // Helper Methods
    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCustomField($key, $default = null)
    {
        return data_get($this->custom_fields, $key, $default);
    }
}