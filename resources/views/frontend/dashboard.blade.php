@extends('layouts.frontend')
@section('title', 'Beranda Waterpark')

@section('content')
<main class="main">

  {{-- =============== HERO SECTION =============== --}}
  <section id="hero-waterpark" class="position-relative overflow-hidden" aria-label="Promo banner waterpark">
    @if($banner && $banner->gambar)
        {{-- Banner dari database --}}
        <img 
            src="{{ asset('storage/' . $banner->gambar) }}"
            alt="{{ $banner->judul ?? 'Banner Waterpark' }}"
            class="w-100 object-fit-cover"
            style="height: 100vh; object-position: center;">
    @else
        {{-- Default fallback --}}
        <video autoplay muted loop playsinline class="w-100 object-fit-cover" style="height: 100vh;">
            <source src="{{ asset('simplecity/img/travel/video-2.mp4') }}" type="video/mp4">
            <img src="{{ asset('simplecity/img/travel/banner-fallback.webp') }}" alt="Promo Waterpark">
        </video>
    @endif

    {{-- Overlay --}}
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>

    {{-- Teks Banner --}}
    <div class="container position-absolute top-50 start-50 translate-middle text-center text-white" data-aos="fade-up">
        <h1 class="fw-bold display-4 text-white">
            {{ $banner->judul ?? 'Selamat Datang di Embun Pelangi Waterpark' }}
        </h1>
        <p class="lead mb-4">
            {{ $banner->deskripsi ?? 'Nikmati keseruan bermain air dan pengalaman menginap terbaik di Indramayu!' }}
        </p>
        <a href="#reservasi" class="btn btn-danger btn-lg me-3">Pesan Tiket</a>
        <a href="#fasilitas" class="btn btn-outline-light btn-lg">Lihat Fasilitas</a>
    </div>
  </section>

  {{-- =============== MOTO KAMI =============== --}}
  <section id="motto" class="py-5">
    <div class="container" data-aos="fade-up">
      <div class="text-center mb-4">
        <h2 class="fw-bold text-warning">Motto Kami</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">
          "{{ $companyProfile->tagline ?? 'Keseruan tiada henti, kebahagiaan untuk semua umur.' }}"
        </p>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="bg-warning-subtle p-4 rounded-4 shadow-sm">
            <p class="mb-0">
              {{ $companyProfile->deskripsi ?? 'Waterpark kami berkomitmen untuk menghadirkan kebahagiaan keluarga melalui wahana air yang aman dan menyenangkan.' }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- =============== TENTANG KAMI =============== --}}
<section id="tentang" class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8">
        <h2 class="fw-bold mb-3 text-warning">Tentang Kami</h2>
        <p class="text-muted">
          {{ $companyProfile->deskripsi ?? 'Embun Pelangi Waterpark adalah destinasi wisata keluarga yang menghadirkan berbagai wahana air, taman bermain anak, area santai, hingga penginapan nyaman untuk liburan bersama keluarga.' }}
        </p>
      </div>
    </div>
  </div>
</section>


  {{-- =============== FASILITAS =============== --}}
 <section id="fasilitas" class="py-5">
  <div class="container" data-aos="fade-up">
    {{-- Heading --}}
    <div class="text-center mb-5">
      <h2 class="fw-bold text-warning">Fasilitas Kami</h2>
      <p class="text-muted">Nikmati berbagai fasilitas lengkap untuk pengalaman terbaik Anda.</p>
    </div>

    {{-- Card Fasilitas --}}
    <div class="row g-4">
      @forelse($fasilitas as $item)
        <div class="col-md-4 col-sm-6">
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
            
            {{-- Gambar fasilitas --}}
            @if(!empty($item->gambar))
              <img src="{{ asset('storage/' . $item->gambar) }}" 
                   alt="{{ $item->nama ?? 'Gambar Fasilitas' }}" 
                   class="card-img-top" 
                   style="height: 220px; object-fit: cover;">
            @else
              <img src="{{ asset('simplecity/img/travel/default-fasilitas.jpg') }}" 
                   alt="Default Fasilitas" 
                   class="card-img-top" 
                   style="height: 220px; object-fit: cover;">
            @endif

            {{-- Isi Card --}}
            <div class="card-body text-center bg-warning-subtle">
              <h5 class="fw-bold mb-2">{{ $item->nama ?? 'Nama Fasilitas' }}</h5>
              <p class="text-muted small mb-3">{{ $item->deskripsi ?? 'Deskripsi fasilitas belum tersedia.' }}</p>
<a href=""
   class="btn btn-outline-warning btn-sm rounded-pill">
  <i class="bi bi-eye"></i> Lihat Detail
</a>

            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <p class="text-muted">Belum ada fasilitas yang tersedia.</p>
        </div>
      @endforelse
    </div>

    {{-- Tombol ke Halaman Fasilitas --}}
    <div class="text-center mt-5">
      <a href="" class="btn btn-danger btn-lg rounded-pill px-4">
        <i class="bi bi-building"></i> Lihat Semua Fasilitas
      </a>
    </div>
  </div>
</section>

  {{-- =============== PROMO PAKET (DARI BE) =============== --}}
  @php
    $promoPaket = $paket->whereNotNull('deskripsi')->first();
  @endphp

  @if($promoPaket)
  <section id="promo" class="py-5 bg-light">
    <div class="container text-center" data-aos="zoom-in">
      <div class="p-5 bg-warning-subtle rounded-4 shadow-sm">
        <h2 class="fw-bold text-danger mb-3">{{ $promoPaket->nama_paket }}</h2>
        <p class="mb-4 text-dark">{{ $promoPaket->deskripsi }}</p>
        <a href="#reservasi" class="btn btn-danger btn-lg">Pesan Sekarang</a>
      </div>
    </div>
  </section>
  @endif

  {{-- =============== CTA RESERVASI =============== --}}
  <section id="reservasi" class="py-5">
    <div class="container" data-aos="fade-up">
      <div class="row align-items-center bg-warning-subtle rounded-4 p-4 shadow-sm">
        <div class="col-md-8">
          <h4 class="fw-bold text-dark">Reservasi Sekarang</h4>
          <p class="mb-0">
            Nikmati keseruan {{ $companyProfile->nama ?? 'Waterpark Embun Pelangi' }} bersama teman & keluarga.
          </p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
          <div class="d-flex flex-column gap-2">
            <a href="" class="btn btn-danger">Tiket Reguler</a>
            <a href="" class="btn btn-danger">Tiket Paket</a>
            <a href="" class="btn btn-danger">Penginapan</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection
