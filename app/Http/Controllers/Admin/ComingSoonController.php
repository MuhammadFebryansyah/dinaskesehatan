<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComingSoonController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check()) {
                return redirect()->route('login');
            }
            
            if (!auth()->user()->canManageContent()) {
                abort(403, 'Access denied to admin area');
            }
            
            return $next($request);
        });
    }

    // Posts methods
    public function posts() { return view('admin.coming-soon', ['module' => 'Berita & Informasi']); }
    public function postsCreate() { return view('admin.coming-soon', ['module' => 'Buat Berita Baru']); }
    public function postsStore() { return redirect()->back()->with('info', 'CRUD belum diimplementasi'); }
    public function postsShow($id) { return view('admin.coming-soon', ['module' => 'Detail Berita']); }
    public function postsEdit($id) { return view('admin.coming-soon', ['module' => 'Edit Berita']); }
    public function postsUpdate($id) { return redirect()->back()->with('info', 'Update belum diimplementasi'); }
    public function postsDestroy($id) { return redirect()->back()->with('info', 'Delete belum diimplementasi'); }

    // Pages methods
    public function pages() { return view('admin.coming-soon', ['module' => 'Halaman Statis']); }
    public function pagesCreate() { return view('admin.coming-soon', ['module' => 'Buat Halaman Baru']); }
    public function pagesStore() { return redirect()->back()->with('info', 'CRUD belum diimplementasi'); }
    public function pagesShow($id) { return view('admin.coming-soon', ['module' => 'Detail Halaman']); }
    public function pagesEdit($id) { return view('admin.coming-soon', ['module' => 'Edit Halaman']); }
    public function pagesUpdate($id) { return redirect()->back()->with('info', 'Update belum diimplementasi'); }
    public function pagesDestroy($id) { return redirect()->back()->with('info', 'Delete belum diimplementasi'); }

    // Categories methods
    public function categories() { return view('admin.coming-soon', ['module' => 'Kategori']); }
    public function categoriesCreate() { return view('admin.coming-soon', ['module' => 'Buat Kategori Baru']); }
    public function categoriesStore() { return redirect()->back()->with('info', 'CRUD belum diimplementasi'); }
    public function categoriesShow($id) { return view('admin.coming-soon', ['module' => 'Detail Kategori']); }
    public function categoriesEdit($id) { return view('admin.coming-soon', ['module' => 'Edit Kategori']); }
    public function categoriesUpdate($id) { return redirect()->back()->with('info', 'Update belum diimplementasi'); }
    public function categoriesDestroy($id) { return redirect()->back()->with('info', 'Delete belum diimplementasi'); }

    // Services methods
    public function services() { return view('admin.coming-soon', ['module' => 'Layanan Kesehatan']); }
    public function servicesCreate() { return view('admin.coming-soon', ['module' => 'Tambah Layanan Kesehatan']); }
    public function servicesStore() { return redirect()->back()->with('info', 'CRUD belum diimplementasi'); }
    public function servicesShow($id) { return view('admin.coming-soon', ['module' => 'Detail Layanan']); }
    public function servicesEdit($id) { return view('admin.coming-soon', ['module' => 'Edit Layanan']); }
    public function servicesUpdate($id) { return redirect()->back()->with('info', 'Update belum diimplementasi'); }
    public function servicesDestroy($id) { return redirect()->back()->with('info', 'Delete belum diimplementasi'); }

    // Programs methods
    public function programs() { return view('admin.coming-soon', ['module' => 'Program Kesehatan']); }
    public function programsCreate() { return view('admin.coming-soon', ['module' => 'Tambah Program Kesehatan']); }
    public function programsStore() { return redirect()->back()->with('info', 'CRUD belum diimplementasi'); }
    public function programsShow($id) { return view('admin.coming-soon', ['module' => 'Detail Program']); }
    public function programsEdit($id) { return view('admin.coming-soon', ['module' => 'Edit Program']); }
    public function programsUpdate($id) { return redirect()->back()->with('info', 'Update belum diimplementasi'); }
    public function programsDestroy($id) { return redirect()->back()->with('info', 'Delete belum diimplementasi'); }

    // Facilities methods
    public function facilities() { return view('admin.coming-soon', ['module' => 'Fasilitas Kesehatan']); }
    public function facilitiesCreate() { return view('admin.coming-soon', ['module' => 'Tambah Fasilitas']); }
    public function facilitiesStore() { return redirect()->back()->with('info', 'CRUD belum diimplementasi'); }
    public function facilitiesShow($id) { return view('admin.coming-soon', ['module' => 'Detail Fasilitas']); }
    public function facilitiesEdit($id) { return view('admin.coming-soon', ['module' => 'Edit Fasilitas']); }
    public function facilitiesUpdate($id) { return redirect()->back()->with('info', 'Update belum diimplementasi'); }
    public function facilitiesDestroy($id) { return redirect()->back()->with('info', 'Delete belum diimplementasi'); }

    // Statistics methods
    public function statistics() { return view('admin.coming-soon', ['module' => 'Data & Statistik']); }
    public function statisticsCreate() { return view('admin.coming-soon', ['module' => 'Input Data Statistik']); }
    public function statisticsStore() { return redirect()->back()->with('info', 'CRUD belum diimplementasi'); }
    public function statisticsShow($id) { return view('admin.coming-soon', ['module' => 'Detail Statistik']); }
    public function statisticsEdit($id) { return view('admin.coming-soon', ['module' => 'Edit Statistik']); }
    public function statisticsUpdate($id) { return redirect()->back()->with('info', 'Update belum diimplementasi'); }
    public function statisticsDestroy($id) { return redirect()->back()->with('info', 'Delete belum diimplementasi'); }

    // Officials methods
    public function officials() { return view('admin.coming-soon', ['module' => 'Pejabat & Staff']); }
    public function officialsCreate() { return view('admin.coming-soon', ['module' => 'Tambah Pejabat']); }
    public function officialsStore() { return redirect()->back()->with('info', 'CRUD belum diimplementasi'); }
    public function officialsShow($id) { return view('admin.coming-soon', ['module' => 'Detail Pejabat']); }
    public function officialsEdit($id) { return view('admin.coming-soon', ['module' => 'Edit Pejabat']); }
    public function officialsUpdate($id) { return redirect()->back()->with('info', 'Update belum diimplementasi'); }
    public function officialsDestroy($id) { return redirect()->back()->with('info', 'Delete belum diimplementasi'); }

    // Other modules
    public function media() { return view('admin.coming-soon', ['module' => 'Media Library']); }
    public function galleries() { return view('admin.coming-soon', ['module' => 'Galeri Foto']); }
    public function downloads() { return view('admin.coming-soon', ['module' => 'Download Center']); }
    public function sliders() { return view('admin.coming-soon', ['module' => 'Banner/Slider']); }
    public function comments() { return view('admin.coming-soon', ['module' => 'Komentar']); }
    public function contacts() { return view('admin.coming-soon', ['module' => 'Pesan Kontak']); }

    public function users()
    {
        if (!auth()->user()->canManageUsers()) {
            abort(403, 'Only Super Admin can access user management');
        }
        return view('admin.coming-soon', ['module' => 'Manajemen User']);
    }

    public function settings()
    {
        if (!auth()->user()->canManageSettings()) {
            abort(403, 'Only Super Admin can access settings');
        }
        return view('admin.coming-soon', ['module' => 'Pengaturan Sistem']);
    }
}