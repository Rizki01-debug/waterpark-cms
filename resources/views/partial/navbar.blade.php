<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    {{-- LOGO --}}
    <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center me-auto me-xl-0">
      <div >
      {{-- ✅ Dynamic Favicon --}}
      @php
          $favicon = \App\Models\CompanyProfile::first()->favicon ?? null;
      @endphp

      @if ($favicon && file_exists(public_path('storage/' . $favicon)))
          <img src="{{ asset('storage/' . $favicon) }}?v={{ time() }}" 
               alt="Favicon" 
               class="rounded-circle shadow-sm" 
               style="width: 50px; height: 50px; object-fit: cover;">
      @else
          <img src="{{ asset('default-favicon.png') }}" 
               alt="Default Logo" 
               class="rounded-circle shadow-sm" 
               style="width: 50px; height: 50px; object-fit: cover;">
      @endif
    </div>
    </a>

    {{-- NAVIGATION MENU --}}
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ route('dashboard') }}">Beranda</a></li>
        <li><a href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
        <li><a href="{{ route('galeri.index') }}">Galeri</a></li>

        {{-- Dropdown Reservasi --}}
        <li class="dropdown">
          <a href="#">
            <span>Reservasi</span> 
            <i class="bi bi-chevron-down toggle-dropdown"></i>
          </a>
          <ul>
            <li><a href="{{ route('reservasi.reguler.index') }}">Tiket Reguler</a></li>
            <li><a href="{{ route('reservasi.paket.index') }}">Tiket Paket</a></li>
            <li><a href="{{ route('reservasi.penginapan.index') }}">Penginapan</a></li>
          </ul>
        </li>

        {{-- Dropdown Blog --}}
        <li class="dropdown">
          <a href="#">
            <span>Blog</span>
            <i class="bi bi-chevron-down toggle-dropdown"></i>
          </a>
          <ul>
            <li><a href="{{ route('blog.news.index') }}">Berita</a></li>
            <li><a href="{{ route('blog.events.index') }}">Event</a></li>
          </ul>
        </li>

        {{-- Dropdown Halaman Lain --}}
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    {{-- CTA & USER MENU --}}
    <div class="d-flex align-items-center gap-3">
      <a class="btn-getstarted d-none d-md-inline-block" href="">
        <i class="bi bi-ticket-perforated me-1"></i> Pesan Tiket
      </a>

      @auth
        {{-- USER LOGGED IN DROPDOWN --}}
<div class="dropdown">
  <button class="btn btn-outline-light rounded-circle p-2 d-flex align-items-center" 
          type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-person-circle fs-5"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow-sm">
    <li>
      <a href="{{ route('user.profile') }}" class="dropdown-item">
        <i class="bi bi-person me-2"></i> Profil Saya
      </a>
    </li>
    <li>
      <a href="#" class="dropdown-item">
        <i class="bi bi-cart3 me-2"></i> Pembelian
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>
    <li>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="dropdown-item text-danger">
          <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
      </form>
    </li>
  </ul>
</div>
      @else
        {{-- IF NOT LOGGED IN --}}
        <a href="{{ route('login') }}" class="btn btn-outline-light d-flex align-items-center">
          <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </a>
      @endauth
    </div>
  </div>
</header>
