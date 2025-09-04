@extends('admin.layout')

@section('title', 'Kategori')
@section('page-title', 'Manajemen Kategori')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-tags me-2"></i>Daftar Kategori
                    </h3>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Tambah Kategori
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if($categories->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama Kategori</th>
                                    <th>Slug</th>
                                    <th>Deskripsi</th>
                                    <th width="80">Posts</th>
                                    <th width="80">Status</th>
                                    <th width="100">Warna</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->sort_order }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($category->icon)
                                                <i class="{{ $category->icon }} me-2" style="color: {{ $category->color }}"></i>
                                            @endif
                                            <strong>{{ $category->name }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <code>{{ $category->slug }}</code>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ Str::limit($category->description, 50) }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $category->posts_count }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="color-box me-2" 
                                                 style="width: 20px; height: 20px; background: {{ $category->color }}; border: 1px solid #ddd; border-radius: 3px;">
                                            </div>
                                            <small>{{ $category->color }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.categories.show', $category) }}" 
                                               class="btn btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $category) }}" 
                                               class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" 
                                                    onclick="deleteCategory({{ $category->id }})" title="Hapus">
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
                        {{ $categories->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-tags fa-5x text-muted mb-3"></i>
                        <h4>Belum ada kategori</h4>
                        <p class="text-muted">Mulai dengan menambahkan kategori pertama Anda.</p>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Tambah Kategori Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
function deleteCategory(id) {
    if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
        const form = document.getElementById('delete-form');
        form.action = '{{ route("admin.categories.index") }}/' + id;
        form.submit();
    }
}
</script>
@endsection