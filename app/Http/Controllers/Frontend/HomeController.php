<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Download;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Get latest posts/news
            $latestPosts = Post::published()
                ->with(['category', 'user'])
                ->latest('published_at')
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            $latestPosts = collect();
        }

        try {
            // Get featured posts
            $featuredPosts = Post::published()
                ->where('is_featured', true)
                ->with(['category', 'user'])
                ->latest('published_at')
                ->take(3)
                ->get();
        } catch (\Exception $e) {
            $featuredPosts = collect();
        }

        // Get statistics (with error handling)
        $statistics = [
            'total_posts' => $this->safeCount(Post::class),
            'total_downloads' => $this->safeCount(Download::class),
            'total_galleries' => $this->safeCount(Gallery::class),
            'total_services' => 25, // Static for now
        ];

        try {
            // Get categories
            $categories = Category::active()
                ->ordered()
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            $categories = collect();
        }

        return view('frontend.home', compact(
            'latestPosts',
            'featuredPosts', 
            'statistics',
            'categories'
        ));
    }

    private function safeCount($model)
    {
        try {
            return $model::count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return redirect()->route('home');
        }

        try {
            $posts = Post::published()
                ->where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('content', 'LIKE', "%{$query}%")
                      ->orWhere('excerpt', 'LIKE', "%{$query}%");
                })
                ->with(['category', 'user'])
                ->latest('published_at')
                ->paginate(10);
        } catch (\Exception $e) {
            $posts = collect()->paginate(10);
        }

        return view('frontend.search', compact('posts', 'query'));
    }
}