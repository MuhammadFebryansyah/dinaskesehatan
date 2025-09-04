@extends('admin.layout')

@section('title', 'Detail Berita')
@section('page-title', 'Detail Berita')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Berita</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h3 class="card-title mb-1">{{ $post->title }}</h3>
                        <div class="text-muted">
                            <span class="badge bg-{{ $post->status === 'published' ? 'success' : ($post->status === 'draft' ? 'secondary' : 'warning') }}">
                                {{ ucfirst($post->status) }}
                            </span>
                            @if($post->is_featured)
                                <span class="badge bg-warning ms-1">Featured</span>
                            @endif
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <button type="button" class="btn btn-secondary" onclick="duplicatePost({{ $post->id }})">
                            <i class="fas fa-copy me-1"></i>Duplikat
                        </button>
                    </div>
                </div>
            </div>

            @if($post->featured_image)
            <div class="card-img-top">
                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                     alt="{{ $post->title }}" 
                     class="img-fluid" style="width: 100%; max-height: 300px; object-fit: cover;">
            </div>
            @endif

            <div class="card-body">
                <div class="post-meta mb-4">
                    <div class="row text-center">
                        <div class="col-3">
                            <strong class="d-block text-primary">{{ number_format($post->views_count) }}</strong>
                            <small class="text-muted">Views</small>
                        </div>
                        <div class="col-3">
                            <strong class="d-block text-info">{{ $post->comments->count() }}</strong>
                            <small class="text-muted">Komentar</small>
                        </div>
                        <div class="col-3">
                            <strong class="d-block text-success">{{ $post->approvedComments->count() }}</strong>
                            <small class="text-muted">Approved</small>
                        </div>
                        <div class="col-3">
                            <strong class="d-block text-warning">{{ $post->comments()->where('status', 'pending')->count() }}</strong>
                            <small class="text-muted">Pending</small>
                        </div>
                    </div>
                </div>

                @if($post->excerpt)
                <div class="alert alert-info">
                    <strong>Ringkasan:</strong> {{ $post->excerpt }}
                </div>
                @endif

                <div class="post-content">
                    {!! $post->content !!}
                </div>

                @if($post->meta_keywords && count($post->meta_keywords) > 0)
                <div class="mt-4">
                    <strong>Keywords:</strong>
                    @foreach($post->meta_keywords as $keyword)
                        <span class="badge bg-light text-dark me-1">{{ trim($keyword) }}</span>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <!-- Comments Section -->
        @if($post->allow_comments && $post->comments->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comments me-2"></i>Komentar ({{ $post->comments->count() }})
                </h3>
            </div>
            <div class="card-body">
                @foreach($post->comments()->rootComments()->latest()->get() as $comment)
                    <div class="comment mb-3 p-3 {{ $comment->status === 'pending' ? 'bg-light' : '' }}" style="border-left: 3px solid {{ $comment->status === 'approved' ? '#28a745' : '#ffc107' }}">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <strong>{{ $comment->author_name }}</strong>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                <span class="badge bg-{{ $comment->status === 'approved' ? 'success' : 'warning' }} badge-sm ms-2">
                                    {{ ucfirst($comment->status) }}
                                </span>
                            </div>
                            @if($comment->status === 'pending')
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-success" onclick="approveComment({{ $comment->id }})">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-danger" onclick="rejectComment({{ $comment->id }})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endif
                        </div>
                        <p class="mb-0">{{ $comment->content }}</p>

                        @if($comment->replies->count() > 0)
                            <div class="ms-4 mt-3">
                                @foreach($comment->replies as $reply)
                                    <div class="reply mb-2 p-2 bg-light rounded">
                                        <strong>{{ $reply->author_name }}</strong>
                                        <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                        <p class="mb-0 mt-1">{{ $reply->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Post Info -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle me-2"></i>Informasi Post
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Kategori:</strong></td>
                        <td>
                            <span class="badge" style="background-color: {{ $post->category->color }}">
                                {{ $post->category->name }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Penulis:</strong></td>
                        <td>{{ $post->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span class="badge bg-{{ $post->status === 'published' ? 'success' : ($post->status === 'draft' ? 'secondary' : 'warning') }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat:</strong></td>
                        <td>{{ $post->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diupdate:</strong></td>
                        <td>{{ $post->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                    @if($post->published_at)
                    <tr>
                        <td><strong>Dipublikasi:</strong></td>
                        <td>{{ $post->published_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Slug:</strong></td>
                        <td><code>{{ $post->slug }}</code></td>
                    </tr>
                </table>

                <div class="mt-3">
                    <strong>Pengaturan:</strong><br>
                    <i class="fas fa-{{ $post->allow_comments ? 'check text-success' : 'times text-danger' }}"></i> Komentar {{ $post->allow_comments ? 'Diizinkan' : 'Dimatikan' }}<br>
                    <i class="fas fa-{{ $post->is_featured ? 'star text-warning' : 'star-o text-muted' }}"></i> {{ $post->is_featured ? 'Featured Post' : 'Post Biasa' }}
                </div>
            </div>
        </div>

        <!-- SEO Info -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-search me-2"></i>SEO Info
                </h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Meta Title:</strong><br>
                    <small>{{ $post->meta_title ?: $post->title }}</small>
                </div>
                <div class="mb-3">
                    <strong>Meta Description:</strong><br>
                    <small>{{ $post->meta_description ?: $post->excerpt }}</small>
                </div>
                @if($post->meta_keywords && count($post->meta_keywords) > 0)
                <div>
                    <strong>Keywords:</strong><br>
                    <small>{{ implode(', ', $post->meta_keywords) }}</small>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cog me-2"></i>Aksi
                </h3>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    @if($post->isPublished())
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-success" target="_blank">
                        <i class="fas fa-external-link-alt me-1"></i>Lihat di Website
                    </a>
                    @endif
                    
                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit Post
                    </a>
                    
                    <button type="button" class="btn btn-info" onclick="duplicatePost({{ $post->id }})">
                        <i class="fas fa-copy me-1"></i>Duplikat Post
                    </button>
                    
                    <button type="button" class="btn btn-danger" onclick="deletePost({{ $post->id }})">
                        <i class="fas fa-trash me-1"></i>Hapus Post
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Forms -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<form id="duplicate-form" method="POST" style="display: none;">
    @csrf
</form>
@endsection

@section('scripts')
<script>
function deletePost(id) {
    if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
        const form = document.getElementById('delete-form');
        form.action = '{{ route("admin.posts.destroy", $post) }}';
        form.submit();
    }
}

function duplicatePost(id) {
    if (confirm('Duplikat berita ini?')) {
        const form = document.getElementById('duplicate-form');
        form.action = '{{ route("admin.posts.duplicate", $post) }}';
        form.submit();
    }
}

function approveComment(commentId) {
    // Implementation for comment approval
    if (confirm('Setujui komentar ini?')) {
        // Add your comment approval logic here
        location.reload();
    }
}

function rejectComment(commentId) {
    // Implementation for comment rejection
    if (confirm('Tolak komentar ini?')) {
        // Add your comment rejection logic here
        location.reload();
    }
}
</script>
@endsection