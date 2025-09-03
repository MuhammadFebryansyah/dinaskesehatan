<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::active()
            ->with(['category'])
            ->latest()
            ->paginate(10);

        $categories = Category::active()
            ->whereHas('downloads', function ($query) {
                $query->active();
            })
            ->withCount(['downloads' => function ($query) {
                $query->active();
            }])
            ->ordered()
            ->get();

        return view('frontend.downloads.index', compact('downloads', 'categories'));
    }

    public function download(Download $download)
    {
        if (!$download->is_active) {
            abort(404);
        }

        if ($download->require_login && !auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk mengunduh file ini.');
        }

        // Increment download count
        $download->increment('download_count');

        // Check if file exists
        if (!Storage::disk('public')->exists($download->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download(
            $download->file_path,
            $download->file_name
        );
    }

    public function category(Category $category)
    {
        $downloads = $category->downloads()
            ->active()
            ->latest()
            ->paginate(10);

        return view('frontend.downloads.category', compact('category', 'downloads'));
    }
}