<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Contact extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message', 'company',
        'website', 'ip_address', 'user_agent', 'referrer', 'status',
        'assigned_to', 'admin_notes', 'replied_at', 'is_spam', 'spam_score'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'is_spam' => 'boolean',
        'spam_score' => 'integer',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'status'])
            ->logOnlyDirty();
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeNotSpam($query)
    {
        return $query->where('is_spam', false);
    }
}