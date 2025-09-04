@extends('admin.layout')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori Baru')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Kategori</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus me-2"></i>Form Tambah Kategori
                </h3>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nama Kategori *</label>
                                <input type="text" name="name" id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="3" placeholder="Deskripsi kategori (opsional)">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="color" class="form-label">Warna</label>
                                <input type="color" name="color" id="color" 
                                       class="form-control form-control-color @error('color') is-invalid @enderror" 
                                       value="{{ old('color', '#007bff') }}">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="icon" class="form-label">Icon (FontAwesome)</label>
                                <input type="text" name="icon" id="icon" 
                                       class="form-control @error('icon') is-invalid @enderror" 
                                       value="{{ old('icon') }}" 
                                       placeholder="fas fa-newspaper">
                                <small class="form-text text-muted">
                                    Contoh: fas fa-newspaper, fas fa-heart
                                </small>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" 
                                       class="form-check-input" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Status Aktif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan Kategori
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection