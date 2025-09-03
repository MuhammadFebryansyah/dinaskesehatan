<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::published()
                ->with(['category', 'user'])
                ->latest('published_at')
                ->paginate(10);
        } catch (\Exception $e) {
            $posts = collect()->paginate(10);
        }

        try {
            $categories = Category::active()
                ->ordered()
                ->get();
        } catch (\Exception $e) {
            $categories = collect();
        }

        return view('frontend.posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        // Check if post is published
        if (!$post->isPublished()) {
            abort(404);
        }

        // Increment views (with error handling)
        try {
            $post->incrementViews();
        } catch (\Exception $e) {
            // Ignore error if incrementViews doesn't exist yet
        }

        return view('frontend.posts.show', compact('post'));
    }
}