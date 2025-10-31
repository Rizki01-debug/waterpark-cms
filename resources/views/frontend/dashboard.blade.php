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
        alt="{{ $banner->judul_banner }}" 
        class="w-100 object-fit-cover" 
        style="height: 100vh; object-position: center;">
@else
    {{-- Default fallback (jika tidak ada data aktif) --}}
    <video autoplay muted loop playsinline class="w-100 object-fit-cover" style="height: 100vh;">
        <source src="{{ asset('simplecity/img/travel/video-2.mp4') }}" type="video/mp4">
        <img src="{{ asset('simplecity/img/travel/banner-fallback.webp') }}" alt="Promo Waterpark">
    </video>
@endif


  {{-- Overlay --}}
  <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>

  {{-- Teks Banner --}}
  <div class="container position-absolute top-50 start-50 translate-middle text-center text-white" data-aos="fade-up">
      <h1 class="fw-bold display-4">
          {{ $banner->judul_banner ?? '' }}
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
          "Keseruan tiada henti, kebahagiaan untuk semua umur."
        </p>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="bg-warning-subtle p-4 rounded-4 shadow-sm">
            <p class="mb-0">Waterpark Embun Pelangi berkomitmen untuk menghadirkan kebahagiaan keluarga
              melalui wahana air yang aman, nyaman, dan penuh keceriaan. Kami terus berinovasi untuk
              memberikan pengalaman terbaik kepada pengunjung.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- =============== TENTANG KAMI =============== --}}
  <section id="tentang" class="py-5 bg-light">
    <div class="container" data-aos="fade-up">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <img src="{{ asset('assets/img/travel/showcase-8.webp') }}" alt="Tentang Waterpark" class="img-fluid rounded-4 shadow-sm">
        </div>
        <div class="col-lg-6">
          <h2 class="fw-bold mb-3 text-warning">Tentang Kami</h2>
          <p>Embun Pelangi Waterpark adalah destinasi wisata keluarga yang menghadirkan berbagai wahana air,
            taman bermain anak, area santai, hingga penginapan nyaman untuk liburan bersama keluarga.
            Kami mengutamakan keamanan, kebersihan, dan pelayanan yang ramah untuk setiap pengunjung.</p>
          <ul class="list-unstyled mt-3">
            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Wahana air untuk semua usia</li>
            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Area bersih dan terawat</li>
            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Harga tiket terjangkau</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  {{-- =============== FASILITAS =============== --}}
  <section id="fasilitas" class="py-5">
    <div class="container" data-aos="fade-up">
      <div class="text-center mb-5">
        <h2 class="fw-bold text-warning">Fasilitas Kami</h2>
        <p class="text-muted">Nikmati berbagai fasilitas lengkap untuk pengalaman terbaik Anda.</p>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 text-center p-4 bg-warning-subtle h-100">
            <i class="bi bi-water fs-1 text-primary mb-3"></i>
            <h5 class="fw-bold">Kolam Renang Anak & Dewasa</h5>
            <p class="text-muted">Area kolam bersih dengan berbagai kedalaman aman untuk semua usia.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 text-center p-4 bg-warning-subtle h-100">
            <i class="bi bi-house-door fs-1 text-success mb-3"></i>
            <h5 class="fw-bold">Penginapan Nyaman</h5>
            <p class="text-muted">Kamar bersih, ber-AC, dan fasilitas lengkap untuk beristirahat setelah bermain.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 text-center p-4 bg-warning-subtle h-100">
            <i class="bi bi-egg-fried fs-1 text-danger mb-3"></i>
            <h5 class="fw-bold">Food Court & Kantin</h5>
            <p class="text-muted">Nikmati berbagai kuliner lezat di area makan yang nyaman.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- =============== PROMO BANNER =============== --}}
  <section id="promo" class="py-5 bg-light">
    <div class="container text-center" data-aos="zoom-in">
      <div class="p-5 bg-warning-subtle rounded-4 shadow-sm">
        <h2 class="fw-bold text-danger mb-3">Promo Spesial Akhir Pekan!</h2>
        <p class="mb-4 text-dark">Dapatkan diskon hingga 20% untuk pembelian tiket keluarga di akhir pekan ini!</p>
        <a href="#reservasi" class="btn btn-danger btn-lg">Pesan Sekarang</a>
      </div>
    </div>
  </section>

  {{-- =============== CTA RESERVASI =============== --}}
  <section id="reservasi" class="py-5">
    <div class="container" data-aos="fade-up">
      <div class="row align-items-center bg-warning-subtle rounded-4 p-4 shadow-sm">
        <div class="col-md-8">
          <h4 class="fw-bold text-dark">Reservasi Sekarang</h4>
          <p class="mb-0">Nikmati keseruan Waterpark Embun Pelangi bersama teman & keluarga. Pilih jenis tiket sesuai kebutuhan Anda!</p>
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
