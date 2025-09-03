@extends('frontend.layout')

@section('title', 'Berita - Dinas Kesehatan')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="mb-4">Berita & Informasi Kesehatan</h1>
            
            @if($posts->count() > 0)
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image_url }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <div class="text-muted small mb-2">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                                    @if($post->category)
                                        <span class="mx-2">•</span>
                                        <span class="badge bg-primary">{{ $post->category->name }}</span>
                                    @endif
                                </div>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->excerpt }}</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary btn-sm">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-5x text-muted mb-3"></i>
                    <h4>Belum ada berita</h4>
                    <p class="text-muted">Berita dan informasi kesehatan akan segera tersedia.</p>
                </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Kategori Berita</h5>
                </div>
                <div class="card-body">
                    @if($categories->count() > 0)
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    {{ $category->name }}
                                    <span class="badge bg-light text-dark ms-2">0</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Belum ada kategori</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection