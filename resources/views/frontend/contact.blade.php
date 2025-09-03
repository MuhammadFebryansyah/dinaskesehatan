@extends('frontend.layout')

@section('title', 'Kontak - Dinas Kesehatan')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="mb-4">Hubungi Kami</h1>
            
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Subjek *</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Pesan *</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi Kontak</h5>
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                        <strong>Alamat:</strong><br>
                        Jl. Kesehatan No. 123<br>
                        Jakarta Pusat 10110
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <strong>Telepon:</strong><br>
                        (021) 1234567
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <strong>Email:</strong><br>
                        info@dinkes.go.id
                    </div>
                    <div>
                        <i class="fas fa-clock text-primary me-2"></i>
                        <strong>Jam Layanan:</strong><br>
                        Senin - Jumat: 08:00 - 16:00
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection