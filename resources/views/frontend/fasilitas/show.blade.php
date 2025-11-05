@extends('layouts.frontend')

@section('title', 'Detail Fasilitas - ' . $fasilitas->nama)

@section('content')
<section class="section-fasilitas-detail py-5" style="margin-top: 120px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card shadow-sm border-0 rounded-4">
                    <img src="{{ asset('storage/' . $fasilitas->gambar) }}" 
                         alt="{{ $fasilitas->nama }}" 
                         class="card-img-top rounded-top"
                         style="height: 400px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h2 class="fw-bold mb-3 text-capitalize">{{ $fasilitas->nama }}</h2>
                        <p class="text-muted mb-4">{{ $fasilitas->deskripsi }}</p>

                        <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-primary">
                            ← Kembali ke Fasilitas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
