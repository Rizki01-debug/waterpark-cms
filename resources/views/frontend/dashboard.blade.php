@extends('layouts.frontend')
@section('title', 'Beranda Waterpark')

@section('content')
<main class="main">

  {{-- 🌊 HERO SECTION --}}
  <section id="hero-waterpark" class="position-relative overflow-hidden" aria-label="Banner Promo">
    @if($banner && $banner->gambar)
      <img src="{{ asset('storage/' . $banner->gambar) }}"
           alt="{{ $banner->judul ?? 'Banner Waterpark' }}"
           class="w-100 object-fit-cover"
           style="height: 100vh; object-position: center;">
    @else
      <video autoplay muted loop playsinline class="w-100 object-fit-cover" style="height: 100vh;">
        <source src="{{ asset('simplecity/img/travel/video-2.mp4') }}" type="video/mp4">
        <img src="{{ asset('simplecity/img/travel/banner-fallback.webp') }}" alt="Promo Waterpark">
      </video>
    @endif

    {{-- Overlay --}}
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>

    {{-- Text --}}
    <div class="container position-absolute top-50 start-50 translate-middle text-center text-white" data-aos="fade-up">
      <h1 class="fw-bold display-4 mb-3  text-white">{{ $banner->judul ?? 'Selamat Datang di Embun Pelangi Waterpark' }}</h1>
      <p class="lead mb-4">{{ $banner->deskripsi ?? 'Nikmati keseruan tanpa batas di destinasi air keluarga terbaik.' }}</p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="#reservasi" class="btn btn-danger btn-lg rounded-pill shadow-sm px-4">Pesan Tiket</a>
        <a href="#fasilitas" class="btn btn-outline-light btn-lg rounded-pill px-4">Lihat Fasilitas</a>
      </div>
    </div>
  </section>

  {{-- 🌟 MOTTO --}}
  <section id="motto" class="py-5 bg-light-subtle">
    <div class="container" data-aos="fade-up">
      <div class="text-center mb-4">
        <h2 class="fw-bold text-warning">Motto Kami</h2>
        <p class="text-muted fst-italic mx-auto" style="max-width: 600px;">
          “{{ $companyProfile->tagline ?? 'Keseruan tiada henti, kebahagiaan untuk semua umur.' }}”
        </p>
      </div>
      <div class="col-md-8 mx-auto">
        <div class="p-4 rounded-4 shadow-sm bg-warning-subtle">
          <p class="mb-0 text-dark">{{ $companyProfile->deskripsi ?? 'Waterpark kami menghadirkan kebahagiaan keluarga melalui wahana air yang aman, seru, dan menyenangkan.' }}</p>
        </div>
      </div>
    </div>
  </section>

  {{-- 🏖️ TENTANG KAMI --}}
  <section id="tentang" class="py-5 bg-light">
    <div class="container" data-aos="fade-up">
      <div class="text-center mb-4">
        <h2 class="fw-bold text-warning">Tentang Kami</h2>
        <p class="text-muted mx-auto" style="max-width: 700px;">
          {{ $companyProfile->deskripsi ?? 'Embun Pelangi Waterpark menghadirkan berbagai wahana air, taman bermain anak, area santai, hingga penginapan nyaman untuk liburan keluarga Anda.' }}
        </p>
      </div>
    </div>
  </section>

  {{-- 💦 FASILITAS --}}
<section id="fasilitas" class="py-5">
  <div class="container" data-aos="fade-up">
    
    {{-- Heading --}}
    <div class="text-center mb-5">
      <h2 class="fw-bold text-warning">Fasilitas Kami</h2>
      <p class="text-muted">Nikmati berbagai fasilitas terbaik untuk pengalaman yang tak terlupakan.</p>
    </div>

    {{-- Tiga Card Fasilitas --}}
    <div class="row g-4 justify-content-center">
      @forelse($fasilitas->take(3) as $item)
        <div class="col-md-4 col-sm-6">
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
            
            {{-- Gambar Fasilitas --}}
            <img 
              src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('simplecity/img/travel/default-fasilitas.jpg') }}"
              alt="{{ $item->nama ?? 'Gambar Fasilitas' }}"
              class="card-img-top"
              style="height: 220px; object-fit: cover;">
            
            {{-- Isi Card --}}
            <div class="card-body text-center bg-warning-subtle">
              <h5 class="fw-bold mb-2">{{ $item->nama ?? 'Nama Fasilitas' }}</h5>
              <p class="text-muted small mb-3">
                {{ Str::limit($item->deskripsi ?? 'Deskripsi fasilitas belum tersedia.', 80) }}
              </p>
              <a href="{{ route('fasilitas.show', $item->id ?? '#') }}" 
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

    {{-- Tombol Lihat Semua --}}
    <div class="text-center mt-5">
      <a href="{{ route('fasilitas.index') }}" class="btn btn-danger btn-lg rounded-pill px-4 shadow-sm">
        <i class="bi bi-building"></i> Lihat Semua Fasilitas
      </a>
    </div>

  </div>
</section>


  {{-- 🎫 PROMO PAKET --}}
  @php $promoPaket = $paket->whereNotNull('deskripsi')->first(); @endphp
  @if($promoPaket)
    <section id="promo" class="py-5 bg-light">
      <div class="container text-center" data-aos="zoom-in">
        <div class="p-5 bg-warning-subtle rounded-4 shadow-sm">
          <h2 class="fw-bold text-danger mb-3">{{ $promoPaket->nama_paket }}</h2>
          <p class="mb-4 text-dark">{{ $promoPaket->deskripsi }}</p>
          <a href="#reservasi" class="btn btn-danger btn-lg rounded-pill shadow-sm px-4">Pesan Sekarang</a>
        </div>
      </div>
    </section>
  @endif

  {{-- 🧾 CTA RESERVASI --}}
  <section id="reservasi" class="py-5 bg-light-subtle">
    <div class="container" data-aos="fade-up">
      <div class="row align-items-center bg-warning-subtle rounded-4 p-4 shadow-sm">
        <div class="col-md-8">
          <h4 class="fw-bold text-dark mb-2">Reservasi Sekarang</h4>
          <p class="mb-0">Nikmati keseruan {{ $companyProfile->nama ?? 'Embun Pelangi Waterpark' }} bersama teman & keluarga.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
          <div class="d-flex flex-column gap-2">
            <a href="{{ route('reservasi.reguler.index') }}" class="btn btn-danger rounded-pill">Tiket Reguler</a>
            <a href="{{ route('reservasi.paket.index') }}" class="btn btn-danger rounded-pill">Tiket Paket</a>
            <a href="#" class="btn btn-danger rounded-pill">Penginapan</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection
