@extends('frontend.layout')

@section('title', 'Beranda - Dinas Kesehatan')

@section('content')
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 mb-4">Selamat Datang di Dinas Kesehatan</h1>
        <p class="lead mb-4">Melayani dengan sepenuh hati untuk kesehatan masyarakat yang lebih baik</p>
        <a href="{{ route('posts.index') }}" class="btn btn-light btn-lg me-3">
            <i class="fas fa-newspaper me-2"></i>Berita Terkini
        </a>
        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
            <i class="fas fa-phone me-2"></i>Hubungi Kami
        </a>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Data Kesehatan</h2>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="card stats-card text-center p-4">
                    <i class="fas fa-newspaper text-primary fa-3x mb-3"></i>
                    <h3 class="text-primary">{{ $statistics['total_posts'] }}</h3>
                    <p>Total Berita</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card stats-card text-center p-4">
                    <i class="fas fa-download text-success fa-3x mb-3"></i>
                    <h3 class="text-success">{{ $statistics['total_downloads'] }}</h3>
                    <p>File Download</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card stats-card text-center p-4">
                    <i class="fas fa-images text-warning fa-3x mb-3"></i>
                    <h3 class="text-warning">{{ $statistics['total_galleries'] }}</h3>
                    <p>Galeri Foto</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card stats-card text-center p-4">
                    <i class="fas fa-hospital text-info fa-3x mb-3"></i>
                    <h3 class="text-info">{{ $statistics['total_services'] }}</h3>
                    <p>Layanan Kesehatan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4">Informasi Penting</h2>
        <p class="lead">Website masih dalam tahap pengembangan. Fitur lengkap akan segera tersedia.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary">
            <i class="fas fa-phone me-2"></i>Hubungi Kami
        </a>
    </div>
</section>
@endsection

