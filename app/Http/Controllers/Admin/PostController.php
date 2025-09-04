<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->canManageContent()) {
                abort(403, 'Access denied');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $posts = Post::with(['category', 'user'])
            ->when(request('category'), function($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when(request('status'), function($query, $status) {
                return $query->where('status', $status);
            })
            ->when(request('search'), function($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(15);

        $categories = Category::active()->ordered()->get();
        
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'allow_comments' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        $validated['slug'] = $this->generateUniqueSlug($validated['title']);
        $validated['user_id'] = auth()->id();
        $validated['allow_comments'] = $request->has('allow_comments');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['meta_keywords'] = $request->meta_keywords ? 
            explode(',', $request->meta_keywords) : [];

        // Set published_at if status is published and no date set
        if ($validated['status'] === 'published' && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show(Post $post)
    {
        $post->load(['category', 'user', 'comments.replies']);
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::active()->ordered()->get();
        $post->meta_keywords = is_array($post->meta_keywords) 
            ? implode(', ', $post->meta_keywords) 
            : '';
        
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'allow_comments' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        // Update slug if title changed
        if ($post->title !== $validated['title']) {
            $validated['slug'] = $this->generateUniqueSlug($validated['title'], $post->id);
        }

        $validated['allow_comments'] = $request->has('allow_comments');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['meta_keywords'] = $request->meta_keywords ? 
            explode(',', $request->meta_keywords) : [];

        // Set published_at if status changed to published
        if ($validated['status'] === 'published' && $post->status !== 'published' && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy(Post $post)
    {
        // Delete featured image
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        // Delete comments
        $post->comments()->delete();

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    public function updateStatus(Request $request, Post $post)
    {
        $validated = $request->validate([
            'status' => 'required|in:draft,published,archived'
        ]);

        // Set published_at if changing to published
        if ($validated['status'] === 'published' && $post->status !== 'published') {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diupdate!'
        ]);
    }

    public function duplicate(Post $post)
    {
        $newPost = $post->replicate();
        $newPost->title = $post->title . ' (Copy)';
        $newPost->slug = $this->generateUniqueSlug($newPost->title);
        $newPost->status = 'draft';
        $newPost->published_at = null;
        $newPost->views_count = 0;
        $newPost->user_id = auth()->id();
        $newPost->save();

        return redirect()->route('admin.posts.edit', $newPost)
            ->with('success', 'Berita berhasil diduplikasi!');
    }

    private function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->when($excludeId, function($query, $excludeId) {
            return $query->where('id', '!=', $excludeId);
        })->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}