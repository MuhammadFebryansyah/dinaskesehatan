<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    /**
     * Get setting value by key
     */
    public function get($key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set setting value
     */
    public function set($key, $value)
    {
        $setting = Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        // Clear cache
        Cache::forget("setting.{$key}");

        return $setting;
    }

    /**
     * Get multiple settings by group
     */
    public function getGroup($group)
    {
        return Cache::remember("settings.group.{$group}", 3600, function () use ($group) {
            return Setting::where('group', $group)
                ->orderBy('sort_order')
                ->get()
                ->keyBy('key');
        });
    }

    /**
     * Clear all settings cache
     */
    public function clearCache()
    {
        $keys = Setting::pluck('key');
        
        foreach ($keys as $key) {
            Cache::forget("setting.{$key}");
        }

        // Clear group caches
        $groups = Setting::distinct('group')->pluck('group');
        foreach ($groups as $group) {
            Cache::forget("settings.group.{$group}");
        }
    }
}