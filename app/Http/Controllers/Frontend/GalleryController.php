<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = collect();
        $categories = collect();
        return view('frontend.galleries.index', compact('galleries', 'categories'));
    }
}