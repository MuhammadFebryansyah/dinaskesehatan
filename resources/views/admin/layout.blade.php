<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Dinas Kesehatan</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" rel="stylesheet">
    
    <style>
        .main-sidebar { position: fixed; height: 100vh; overflow-y: auto; }
        .content-wrapper { margin-left: 250px; min-height: 100vh; }
        .sidebar-mini .main-sidebar { width: 250px; }
        .nav-sidebar .nav-link.active { background: rgba(0,123,255,.1); color: #007bff; }
        .brand-text { font-weight: 600; }
        .sidebar-dark-primary { background: #343a40; }
    </style>
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home') }}" class="nav-link" target="_blank">
                    <i class="fas fa-external-link-alt me-1"></i>Lihat Website
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i>
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
            <i class="fas fa-clinic-medical text-primary fa-2x mb-2"></i>
            <span class="brand-text font-weight-light d-block">Admin Panel</span>
            <small class="d-block text-muted">Dinas Kesehatan</small>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="fas fa-user-circle fa-2x text-light"></i>
                </div>
                <div class="info">
                    <span class="text-light">{{ auth()->user()->name }}</span>
                    <br><small class="text-muted">
                        @if(auth()->user()->isSuperAdmin()) Super Admin @else Editor @endif
                    </small>
                </div>
            </div>

            <!-- SIDEBAR MENU - ONLY WORKING ROUTES -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt text-info"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Content Management -->
                    <li class="nav-header text-uppercase">Konten</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper text-primary"></i>
                            <p>Berita & Informasi</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt text-success"></i>
                            <p>Halaman Statis</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tags text-warning"></i>
                            <p>Kategori</p>
                        </a>
                    </li>

                    <!-- Health Services -->
                    <li class="nav-header text-uppercase">Layanan Kesehatan</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hospital text-danger"></i>
                            <p>Layanan Kesehatan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.programs.index') }}" class="nav-link {{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-heartbeat text-pink"></i>
                            <p>Program Kesehatan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.facilities.index') }}" class="nav-link {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clinic-medical text-teal"></i>
                            <p>Fasilitas Kesehatan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.statistics.index') }}" class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-bar text-indigo"></i>
                            <p>Data & Statistik</p>
                        </a>
                    </li>

                    <!-- Organization -->
                    <li class="nav-header text-uppercase">Profil Dinas</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.officials.index') }}" class="nav-link {{ request()->routeIs('admin.officials.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users text-secondary"></i>
                            <p>Pejabat & Staff</p>
                        </a>
                    </li>

                    <!-- Media -->
                    <li class="nav-header text-uppercase">Media & File</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.media.index') }}" class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-photo-video text-purple"></i>
                            <p>Media Library</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-images text-orange"></i>
                            <p>Galeri Foto</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.downloads.index') }}" class="nav-link {{ request()->routeIs('admin.downloads.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-download text-cyan"></i>
                            <p>Download Center</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-sliders-h text-lime"></i>
                            <p>Banner/Slider</p>
                        </a>
                    </li>

                    <!-- Communication -->
                    <li class="nav-header text-uppercase">Komunikasi</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.comments.index') }}" class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-comments text-info"></i>
                            <p>Komentar</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope text-primary"></i>
                            <p>Pesan Kontak</p>
                        </a>
                    </li>

                    @if(auth()->user()->isSuperAdmin())
                    <!-- System -->
                    <li class="nav-header text-uppercase">Sistem</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog text-dark"></i>
                            <p>Manajemen User</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog text-secondary"></i>
                            <p>Pengaturan</p>
                        </a>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page-title', 'Dashboard')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumbs')
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    </div>
                @endif

                @yield('content')
                
            </div>
        </section>
    </div>

    <footer class="main-footer text-center">
        <strong>&copy; {{ date('Y') }} Dinas Kesehatan.</strong> All rights reserved.
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            const closeBtn = alert.querySelector('.btn-close');
            if (closeBtn) closeBtn.click();
        });
    }, 5000);
});
</script>

@yield('scripts')
</body>
</html>