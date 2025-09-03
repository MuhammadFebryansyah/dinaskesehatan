<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index()
    {
        // Check if user can manage content
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->canManageContent()) {
            abort(403, 'Access denied to admin area');
        }
        
        // Get basic statistics with error handling
        $stats = $this->getBasicStats();
        
        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Get basic statistics for dashboard
     */
    private function getBasicStats()
    {
        $stats = [
            'posts' => 0,
            'pages' => 0,
            'downloads' => 0,
            'galleries' => 0,
            'users' => 0,
            'comments_pending' => 0,
            'contacts_unread' => 0,
        ];

        try {
            // Try to get real counts, fallback to 0 if models don't exist
            if (class_exists('App\Models\Post')) {
                $stats['posts'] = \App\Models\Post::count();
            }
            
            if (class_exists('App\Models\Page')) {
                $stats['pages'] = \App\Models\Page::count();
            }
            
            if (class_exists('App\Models\Download')) {
                $stats['downloads'] = \App\Models\Download::count();
            }
            
            if (class_exists('App\Models\Gallery')) {
                $stats['galleries'] = \App\Models\Gallery::count();
            }
            
            if (class_exists('App\Models\User')) {
                $stats['users'] = \App\Models\User::count();
            }
            
            if (class_exists('App\Models\Comment')) {
                $stats['comments_pending'] = \App\Models\Comment::where('status', 'pending')->count();
            }
            
            if (class_exists('App\Models\Contact')) {
                $stats['contacts_unread'] = \App\Models\Contact::where('status', 'unread')->count();
            }
            
        } catch (\Exception $e) {
            // If any database error, just use default zeros
            \Log::info('Dashboard stats error: ' . $e->getMessage());
        }

        return $stats;
    }

    /**
     * Show system information (SuperAdmin only)
     */
    public function systemInfo()
    {
        if (!auth()->check() || !auth()->user()->isSuperAdmin()) {
            abort(403, 'Only Super Admin can access system information');
        }
        
        $info = [
            'laravel_version' => app()->version(),
            'php_version' => phpversion(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'app_env' => config('app.env', 'Unknown'),
            'app_debug' => config('app.debug') ? 'Enabled' : 'Disabled',
        ];
        
        return view('admin.system-info', compact('info'));
    }

    /**
     * Get dashboard statistics via AJAX
     */
    public function getStats()
    {
        if (!auth()->check() || !auth()->user()->canManageContent()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        return response()->json($this->getBasicStats());
    }
}