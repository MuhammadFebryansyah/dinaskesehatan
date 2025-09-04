@extends('admin.layout')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita Baru')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Berita</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('css')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit me-2"></i>Konten Berita
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Judul Berita *</label>
                        <input type="text" name="title" id="title" 
                               class="form-control form-control-lg @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="excerpt" class="form-label">Ringkasan</label>
                        <textarea name="excerpt" id="excerpt" 
                                  class="form-control @error('excerpt') is-invalid @enderror" 
                                  rows="3" placeholder="Ringkasan singkat berita (opsional)">{{ old('excerpt') }}</textarea>
                        <small class="form-text text-muted">Jika kosong, akan otomatis dibuat dari konten utama</small>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="content" class="form-label">Konten Berita *</label>
                        <textarea name="content" id="content" 
                                  class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
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
                               value="{{ old('meta_title') }}" maxlength="60">
                        <small class="form-text text-muted">Jika kosong, akan menggunakan judul berita</small>
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" 
                                  class="form-control @error('meta_description') is-invalid @enderror" 
                                  rows="2" maxlength="160">{{ old('meta_description') }}</textarea>
                        <small class="form-text text-muted">Maksimal 160 karakter</small>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_keywords" class="form-label">Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" 
                               class="form-control @error('meta_keywords') is-invalid @enderror" 
                               value="{{ old('meta_keywords') }}" 
                               placeholder="keyword1, keyword2, keyword3">
                        <small class="form-text text-muted">Pisahkan dengan koma</small>
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
                            <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="published_at" class="form-label">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" id="published_at" 
                               class="form-control @error('published_at') is-invalid @enderror" 
                               value="{{ old('published_at') }}">
                        <small class="form-text text-muted">Kosongkan untuk menggunakan waktu saat ini</small>
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-2">
                        <input type="checkbox" name="is_featured" id="is_featured" 
                               class="form-check-input" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Featured Post
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="allow_comments" id="allow_comments" 
                               class="form-check-input" value="1" {{ old('allow_comments', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="allow_comments">
                            Izinkan Komentar
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan Berita
                        </button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Batal
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
                                        {{ old('category_id', request('category')) == $category->id ? 'selected' : '' }}>
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
                    <div class="form-group">
                        <input type="file" name="featured_image" id="featured_image" 
                               class="form-control @error('featured_image') is-invalid @enderror"
                               accept="image/*">
                        <small class="form-text text-muted">Format: JPG, JPEG, PNG, WEBP. Max: 2MB</small>
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