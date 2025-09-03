@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumbs')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Stats Cards Row -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['posts'] ?? 0 }}</h3>
                <p>Total Berita</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <a href="{{ route('admin.posts.index') }}" class="small-box-footer">
                Kelola Berita <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['pages'] ?? 0 }}</h3>
                <p>Halaman</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <a href="{{ route('admin.pages.index') }}" class="small-box-footer">
                Kelola Halaman <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['downloads'] ?? 0 }}</h3>
                <p>File Download</p>
            </div>
            <div class="icon">
                <i class="fas fa-download"></i>
            </div>
            <a href="{{ route('admin.downloads.index') }}" class="small-box-footer">
                Kelola Download <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['galleries'] ?? 0 }}</h3>
                <p>Galeri Foto</p>
            </div>
            <div class="icon">
                <i class="fas fa-images"></i>
            </div>
            <a href="{{ route('admin.galleries.index') }}" class="small-box-footer">
                Kelola Galeri <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Health Stats Row -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>25</h3>
                <p>Layanan Kesehatan</p>
            </div>
            <div class="icon">
                <i class="fas fa-hospital"></i>
            </div>
            <a href="{{ route('admin.services.index') }}" class="small-box-footer">
                Kelola Layanan <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>12</h3>
                <p>Program Kesehatan</p>
            </div>
            <div class="icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <a href="{{ route('admin.programs.index') }}" class="small-box-footer">
                Kelola Program <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-teal">
            <div class="inner">
                <h3>45</h3>
                <p>Fasilitas Kesehatan</p>
            </div>
            <div class="icon">
                <i class="fas fa-clinic-medical"></i>
            </div>
            <a href="{{ route('admin.facilities.index') }}" class="small-box-footer">
                Kelola Fasilitas <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-indigo">
            <div class="inner">
                <h3>{{ $stats['users'] ?? 0 }}</h3>
                <p>Total User</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            @if(auth()->user()->isSuperAdmin())
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                Kelola User <i class="fas fa-arrow-circle-right"></i>
            </a>
            @else
            <div class="small-box-footer">
                <span class="text-muted">User Management</span>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Welcome Message -->
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clinic-medical me-2"></i>
                    Selamat Datang di Admin Panel Dinas Kesehatan
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5>Halo, {{ auth()->user()->name }}!</h5>
                        <p class="mb-3">
                            Selamat datang di panel administrasi Website Dinas Kesehatan. 
                            Anda login sebagai <strong>
                                @if(auth()->user()->isSuperAdmin()) 
                                    Super Administrator
                                @else 
                                    Editor
                                @endif
                            </strong>.
                        </p>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Status Pengembangan:</strong> Backend admin panel telah siap. 
                            Menu-menu CRUD sedang dalam tahap development dan akan segera tersedia.
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-heartbeat fa-5x text-primary mb-3"></i>
                        <p class="text-muted">Sistem Manajemen<br>Kesehatan Terintegrasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-6 text-center mb-3">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-outline-primary btn-block">
                            <i class="fas fa-plus-circle fa-2x d-block mb-2"></i>
                            Buat Berita
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center mb-3">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-outline-danger btn-block">
                            <i class="fas fa-hospital fa-2x d-block mb-2"></i>
                            Tambah Layanan
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center mb-3">
                        <a href="{{ route('admin.programs.create') }}" class="btn btn-outline-success btn-block">
                            <i class="fas fa-heartbeat fa-2x d-block mb-2"></i>
                            Tambah Program
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center mb-3">
                        <a href="{{ route('admin.media.index') }}" class="btn btn-outline-purple btn-block">
                            <i class="fas fa-upload fa-2x d-block mb-2"></i>
                            Upload Media
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center mb-3">
                        <a href="{{ route('admin.statistics.create') }}" class="btn btn-outline-info btn-block">
                            <i class="fas fa-chart-bar fa-2x d-block mb-2"></i>
                            Input Data
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 text-center mb-3">
                        @if(auth()->user()->isSuperAdmin())
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary btn-block">
                            <i class="fas fa-cog fa-2x d-block mb-2"></i>
                            Settings
                        </a>
                        @else
                        <div class="btn btn-outline-secondary btn-block disabled">
                            <i class="fas fa-cog fa-2x d-block mb-2"></i>
                            Settings
                            <small class="d-block">(SuperAdmin Only)</small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin Dashboard loaded successfully!');
    console.log('User role: {{ auth()->user()->isSuperAdmin() ? "SuperAdmin" : "Editor" }}');
});
</script>
@endsection