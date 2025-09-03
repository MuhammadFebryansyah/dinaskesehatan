<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Menu extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'url',
        'route_name',
        'route_params',
        'parent_id',
        'sort_order',
        'level',
        'icon',
        'badge_text',
        'badge_color',
        'target',
        'permissions',
        'roles',
        'is_active',
        'show_in_menu',
        'location',
    ];

    protected $casts = [
        'route_params' => 'array',
        'permissions' => 'array',
        'roles' => 'array',
        'is_active' => 'boolean',
        'show_in_menu' => 'boolean',
        'sort_order' => 'integer',
        'level' => 'integer',
    ];

    // Activity Log Configuration  
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'url', 'is_active', 'sort_order'])
            ->logOnlyDirty();
    }

    // Relationships
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeVisible($query)
    {
        return $query->where('show_in_menu', true);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', $location);
    }

    public function scopeRootMenus($query)
    {
        return $query->whereNull('parent_id')->orderBy('sort_order');
    }

    // Helper Methods
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    public function getFullUrlAttribute()
    {
        if ($this->url) {
            return $this->url;
        }
        
        if ($this->route_name) {
            try {
                return route($this->route_name, $this->route_params ?: []);
            } catch (\Exception $e) {
                return '#';
            }
        }
        
        return '#';
    }
}
