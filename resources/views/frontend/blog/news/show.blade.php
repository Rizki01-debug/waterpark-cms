@extends('layouts.frontend')

@section('title', $item->judul ?? 'Detail Berita')

@section('content')
<main class="main py-5" style="margin-top: 80px;">
  <div class="container" data-aos="fade-up">

    {{-- Tombol Kembali --}}
    <div class="mb-4">
      <a href="{{ route('blog.news.index') }}" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>

    {{-- Card Detail Berita --}}
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      {{-- Gambar --}}
      @if($item->gambar)
        <img src="{{ asset('storage/' . $item->gambar) }}" 
             alt="{{ $item->judul }}" 
             class="img-fluid rounded-4 mb-4" 
             style="max-height: 400px; object-fit: cover;">
      @endif

      {{-- Judul dan Tanggal --}}
      <h2 class="fw-bold text-dark mb-3">{{ $item->judul }}</h2>
      <p class="text-muted small mb-4">
        <i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}
      </p>

      {{-- Isi Konten --}}
      <div class="text-dark" style="line-height: 1.8;">
        {!! nl2br(e($item->isi)) !!}
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

  .card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
  }
</style>
@endsection
