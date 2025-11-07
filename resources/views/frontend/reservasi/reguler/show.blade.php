@extends('layouts.frontend')

@section('title', $tiket->nama_paket ?? 'Detail Tiket')

@section('content')
<main class="main py-5" style="margin-top: 80px;">
  <div class="container" data-aos="fade-up">
    
    {{-- Tombol Kembali --}}
    <div class="mb-4">
      <a href="{{ route('reservasi.reguler.index') }}" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>

    {{-- Card Detail Tiket --}}
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <div class="row align-items-center g-4">
        
        {{-- Gambar Tiket --}}
        <div class="col-md-6 text-center">
          <img 
            src="{{ $tiket->gambar ? asset('storage/' . $tiket->gambar) : asset('simplecity/img/travel/default-fasilitas.jpg') }}" 
            alt="{{ $tiket->nama_paket }}"
            class="img-fluid rounded-4 shadow-sm"
            style="max-height: 400px; object-fit: cover;">
        </div>

        {{-- Detail Tiket --}}
        <div class="col-md-6">
          <h3 class="fw-bold text-dark mb-2">{{ $tiket->nama_paket }}</h3>
          <p class="text-muted mb-3">Harga:</p>
          
          {{-- Harga --}}
          <div class="mb-4">
            @if($tiket->diskon > 0)
              <span class="text-muted text-decoration-line-through me-2">
                Rp{{ number_format($tiket->harga, 0, ',', '.') }}
              </span>
              <span class="text-danger fw-bold fs-5">
                Rp{{ number_format($tiket->harga - ($tiket->harga * $tiket->diskon / 100), 0, ',', '.') }}
              </span>
            @else
              <span class="text-primary fw-bold fs-5">
                Rp{{ number_format($tiket->harga, 0, ',', '.') }}
              </span>
            @endif
          </div>

          {{-- Deskripsi --}}
          <div class="bg-light-subtle p-3 rounded-4 border mb-4">
            <p class="mb-0 text-dark">
              {{ $tiket->deskripsi ?? 'Deskripsi fasilitas atau informasi tiket belum tersedia.' }}
            </p>
          </div>

          {{-- Tombol Aksi --}}
          <div class="d-flex gap-3 mt-3">
            <a href="#pesan" class="btn btn-primary rounded-pill px-4 shadow-sm">Pesan Sekarang</a>
          </div>
        </div>

      </div>
    </div>

  </div>
</main>

{{-- Custom Style --}}
<style>
  .btn-outline-secondary {
    border-color: #ccc;
    color: #444;
  }

  .btn-outline-secondary:hover {
    background-color: #f8f9fa;
    border-color: #999;
  }

  .btn-primary {
    background-color: #0096c7;
    border-color: #0096c7;
  }

  .btn-primary:hover {
    background-color: #0077b6;
    border-color: #0077b6;
  }

  .card {
    transition: box-shadow 0.3s ease;
  }

  .card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
  }
</style>
@endsection
