@extends('admin.layout')

@section('title', $module)
@section('page-title', $module)

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">{{ $module }}</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-tools fa-5x text-muted mb-4"></i>
                <h3>{{ $module }}</h3>
                <p class="text-muted mb-4">Modul ini sedang dalam tahap pengembangan dan akan segera tersedia.</p>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Status:</strong> Backend foundation sudah siap, CRUD interface dalam proses development.
                </div>
                
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection