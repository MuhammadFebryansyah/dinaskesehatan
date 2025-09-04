@extends('admin.layout')

@section('title', 'Berita & Informasi')
@section('page-title', 'Manajemen Berita & Informasi')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Berita</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-newspaper me-2"></i>Daftar Berita & Informasi
                    </h3>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Tambah Berita
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <div class="card-body border-bottom">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari berita..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="category" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                    </div>
                    <div class="col-md-3 text-end">
                        @if(request()->hasAny(['search', 'category', 'status']))
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="card-body">
                @if($posts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Berita</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Penulis</th>
                                    <th>Tanggal</th>
                                    <th>Views</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-start">
                                            @if($post->featured_image)
                                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                                     alt="{{ $post->title }}" class="me-3"
                                                     style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px;">
                                            @endif
                                            <div>
                                                <strong>{{ Str::limit($post->title, 50) }}</strong>
                                                @if($post->is_featured)
                                                    <span class="badge bg-warning badge-sm ms-1">Featured</span>
                                                @endif
                                                <br>
                                                <small class="text-muted">
                                                    {{ Str::limit(strip_tags($post->excerpt), 60) }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($post->category)
                                            <span class="badge" style="background-color: {{ $post->category->color }}">
                                                {{ $post->category->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm status-select" 
                                                data-post-id="{{ $post->id }}">
                                            <option value="draft" {{ $post->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ $post->status === 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="archived" {{ $post->status === 'archived' ? 'selected' : '' }}>Archived</option>
                                        </select>
                                    </td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        <small>
                                            {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                                            <br>
                                            <span class="text-muted">{{ $post->created_at->format('H:i') }}</span>
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ number_format($post->views_count) }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.posts.show', $post) }}" 
                                               class="btn btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.posts.edit', $post) }}" 
                                               class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-secondary" 
                                                    onclick="duplicatePost({{ $post->id }})" title="Duplikat">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" 
                                                    onclick="deletePost({{ $post->id }})" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $posts->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-newspaper fa-5x text-muted mb-3"></i>
                        <h4>Belum ada berita</h4>
                        <p class="text-muted">Mulai dengan menambahkan berita atau informasi pertama Anda.</p>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Tambah Berita Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete & Duplicate Forms -->
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
// Status Change
document.querySelectorAll('.status-select').forEach(select => {
    select.addEventListener('change', function() {
        const postId = this.dataset.postId;
        const status = this.value;
        
        fetch(`{{ route('admin.posts.index') }}/${postId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                alert('Status berhasil diupdate!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan!');
        });
    });
});

function deletePost(id) {
    if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
        const form = document.getElementById('delete-form');
        form.action = '{{ route("admin.posts.index") }}/' + id;
        form.submit();
    }
}

function duplicatePost(id) {
    if (confirm('Duplikat berita ini?')) {
        const form = document.getElementById('duplicate-form');
        form.action = '{{ route("admin.posts.index") }}/' + id + '/duplicate';
        form.submit();
    }
}
</script>
@endsection