@extends('admin.layout')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita: ' . Str::limit($post->title, 50))

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Berita</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('css')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit me-2"></i>Edit Konten Berita
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Judul Berita *</label>
                        <input type="text" name="title" id="title" 
                               class="form-control form-control-lg @error('title') is-invalid @enderror" 
                               value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="excerpt" class="form-label">Ringkasan</label>
                        <textarea name="excerpt" id="excerpt" 
                                  class="form-control @error('excerpt') is-invalid @enderror" 
                                  rows="3" placeholder="Ringkasan singkat berita (opsional)">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="content" class="form-label">Konten Berita *</label>
                        <textarea name="content" id="content" 
                                  class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SEO Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-search me-2"></i>SEO & Meta Tags
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" 
                               class="form-control @error('meta_title') is-invalid @enderror" 
                               value="{{ old('meta_title', $post->meta_title) }}" maxlength="60">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" 
                                  class="form-control @error('meta_description') is-invalid @enderror" 
                                  rows="2" maxlength="160">{{ old('meta_description', $post->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_keywords" class="form-label">Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" 
                               class="form-control @error('meta_keywords') is-invalid @enderror" 
                               value="{{ old('meta_keywords', $post->meta_keywords) }}" 
                               placeholder="keyword1, keyword2, keyword3">
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Publish -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-paper-plane me-2"></i>Publikasi
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $post->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="published_at" class="form-label">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" id="published_at" 
                               class="form-control @error('published_at') is-invalid @enderror" 
                               value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-2">
                        <input type="checkbox" name="is_featured" id="is_featured" 
                               class="form-check-input" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Featured Post
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="allow_comments" id="allow_comments" 
                               class="form-check-input" value="1" {{ old('allow_comments', $post->allow_comments) ? 'checked' : '' }}>
                        <label class="form-check-label" for="allow_comments">
                            Izinkan Komentar
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Berita
                        </button>
                        <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-info">
                            <i class="fas fa-eye me-1"></i>Lihat Detail
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Category -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tags me-2"></i>Kategori
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-image me-2"></i>Gambar Utama
                    </h3>
                </div>
                <div class="card-body">
                    @if($post->featured_image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                 alt="{{ $post->title }}" class="img-fluid rounded" style="max-height: 200px;">
                            <small class="form-text text-muted d-block mt-1">Gambar saat ini</small>
                        </div>
                    @endif

                    <div class="form-group">
                        <input type="file" name="featured_image" id="featured_image" 
                               class="form-control @error('featured_image') is-invalid @enderror"
                               accept="image/*">
                        <small class="form-text text-muted">
                            Format: JPG, JPEG, PNG, WEBP. Max: 2MB
                            @if($post->featured_image)
                                <br>Pilih file baru untuk mengganti gambar yang ada
                            @endif
                        </small>
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="image-preview" class="mt-3" style="display: none;">
                        <img id="preview-img" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">
                            <i class="fas fa-times"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>

            <!-- Post Stats -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar me-2"></i>Statistik
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <strong class="d-block">{{ number_format($post->views_count) }}</strong>
                                <small class="text-muted">Views</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <strong class="d-block">{{ $post->comments->count() }}</strong>
                            <small class="text-muted">Komentar</small>
                        </div>
                    </div>
                    <hr>
                    <small class="text-muted">
                        <strong>Dibuat:</strong> {{ $post->created_at->format('d M Y H:i') }}<br>
                        <strong>Diupdate:</strong> {{ $post->updated_at->format('d M Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
// TinyMCE Editor
tinymce.init({
    selector: '#content',
    height: 400,
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});

// Image Preview
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});

function removeImage() {
    document.getElementById('featured_image').value = '';
    document.getElementById('image-preview').style.display = 'none';
}
</script>
@endsection