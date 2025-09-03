<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register custom services
        $this->app->singleton('settings', function () {
            return new \App\Services\SettingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set default string length for older MySQL versions
        Schema::defaultStringLength(191);

        // Use Bootstrap for pagination
        Paginator::useBootstrapFive();

        // Share global data with all views
        View::composer('*', function ($view) {
            // Only load settings if database exists and is migrated
            if (Schema::hasTable('settings')) {
                $publicSettings = Setting::where('is_public', true)
                    ->pluck('value', 'key')
                    ->toArray();
                
                $view->with('settings', $publicSettings);
            }

            // Load menus for frontend
            if (Schema::hasTable('menus')) {
                $headerMenu = Menu::where('location', 'header')
                    ->where('is_active', true)
                    ->whereNull('parent_id')
                    ->orderBy('sort_order')
                    ->with('children')
                    ->get();

                $footerMenu = Menu::where('location', 'footer')
                    ->where('is_active', true)
                    ->whereNull('parent_id')
                    ->orderBy('sort_order')
                    ->with('children')
                    ->get();

                $view->with([
                    'headerMenu' => $headerMenu,
                    'footerMenu' => $footerMenu,
                ]);
            }
        });

        // Share admin menu with admin views
        View::composer('admin.*', function ($view) {
            if (Schema::hasTable('menus')) {
                $adminMenu = Menu::where('location', 'admin')
                    ->where('is_active', true)
                    ->whereNull('parent_id')
                    ->orderBy('sort_order')
                    ->with('children')
                    ->get()
                    ->filter(function ($menu) {
                        return $this->userCanAccessMenu($menu);
                    });

                $view->with('adminMenu', $adminMenu);
            }
        });
    }

    /**
     * Check if user can access menu based on roles and permissions
     */
    private function userCanAccessMenu($menu)
    {
        if (!auth()->check()) {
            return false;
        }

        $user = auth()->user();

        // Check roles
        if ($menu->roles) {
            $requiredRoles = json_decode($menu->roles, true);
            if (!$user->hasAnyRole($requiredRoles)) {
                return false;
            }
        }

        // Check permissions
        if ($menu->permissions) {
            $requiredPermissions = json_decode($menu->permissions, true);
            if (!$user->hasAnyPermission($requiredPermissions)) {
                return false;
            }
        }

        return true;
    }
}
