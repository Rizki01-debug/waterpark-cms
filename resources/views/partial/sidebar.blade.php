<div class="sidebar vh-100 d-flex flex-column p-3 shadow-sm"
     style="width: 260px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); overflow-y: auto;">

  <!-- Logo & Header -->
  <div class="sidebar-header text-center mb-4 sticky-top" style="background: inherit;">
    <div class="logo-icon bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-3"
         style="width: 60px; height: 60px;">
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
    <h5 class="text-white fw-semibold mb-1">Waterpark CMS</h5>
    <p class="text-white-50 small mb-0">Admin Panel</p>
  </div>


  <hr class="border-white-25 mb-4">

  <!-- Navigation -->
  <ul class="nav flex-column">
    <!-- Dashboard -->
    <li class="nav-item mb-2">
      <a href="{{ route('admin.dashboard') }}"
         class="nav-link d-flex align-items-center text-white py-2 px-3 rounded-3 sidebar-link">
        <i class="fas fa-tachometer-alt me-3 fs-5"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Management -->
    <li class="nav-item mt-3 mb-2">
      <small class="text-uppercase text-white-50 fw-bold ps-3">Management</small>
    </li>

    <li class="nav-item mb-1">
      <a href="{{ route('admin.fasilitas.index') }}" class="nav-link d-flex align-items-center text-white py-2 px-3 rounded-3 sidebar-link">
        <i class="fas fa-umbrella-beach me-3 fs-5"></i>
        <span>Fasilitas</span>
      </a>
    </li>

    <!-- Reservasi Dropdown -->
    <li class="nav-item mb-1">
      <a class="nav-link d-flex justify-content-between align-items-center text-white py-2 px-3 rounded-3 sidebar-link collapsed"
         data-bs-toggle="collapse" href="#submenuReservasi" role="button" aria-expanded="false" aria-controls="submenuReservasi">
        <div><i class="fas fa-calendar-check me-3 fs-5"></i> Reservasi</div>
        <i class="fas fa-chevron-down small"></i>
      </a>
      <div class="collapse ms-4" id="submenuReservasi">
        <ul class="nav flex-column">
          <li><a href="{{ route('admin.reservasi.reguler.index') }}" class="nav-link text-white-50 py-1 px-2">• Reguler Tiket</a></li>
          <li><a href="{{ route('admin.reservasi.paket.index') }}" class="nav-link text-white-50 py-1 px-2">• Paket Tiket</a></li>
          <li><a href="{{ route('admin.reservasi.penginapan.index') }}" class="nav-link text-white-50 py-1 px-2">• Penginapan</a></li>
          <li><a href="{{ route('admin.reservasi.pemesanan.index') }}" class="nav-link text-white-50 py-1 px-2">• Pemesanan </a></li>
        </ul>
      </div>
    </li>

    <!-- Blog Dropdown -->
    <li class="nav-item mb-1">
      <a class="nav-link d-flex justify-content-between align-items-center text-white py-2 px-3 rounded-3 sidebar-link collapsed"
         data-bs-toggle="collapse" href="#submenuBlog" role="button" aria-expanded="false" aria-controls="submenuBlog">
        <div><i class="fas fa-blog me-3 fs-5"></i> Blog</div>
        <i class="fas fa-chevron-down small"></i>
      </a>
      <div class="collapse ms-4" id="submenuBlog">
        <ul class="nav flex-column">
          <li><a href="{{ route('admin.blog.news.index') }}" class="nav-link text-white-50 py-1 px-2">• News </a></li>
          <li><a href="{{ route('admin.blog.events.index') }}" class="nav-link text-white-50 py-1 px-2">• Events </a></li>
        </ul>
      </div>
    </li>

      <li class="nav-item mb-1">
      <a href="{{ route('admin.banner.index') }}" class="nav-link d-flex align-items-center text-white py-2 px-3 rounded-3 sidebar-link">
        <i class="fas fa-bullhorn me-3 fs-5"></i>
        <span>Promo Banner</span>
      </a>
    </li>

    <!-- System -->
    <li class="nav-item mt-3 mb-2">
      <small class="text-uppercase text-white-50 fw-bold ps-3">System</small>
    </li>

    <li class="nav-item mb-1">
      <a href="{{ route('admin.system.admins.index') }}" class="nav-link d-flex align-items-center text-white py-2 px-3 rounded-3 sidebar-link">
        <i class="fas fa-user-plus me-3 fs-5"></i> <span>Tambah Admin</span>
      </a>
    </li>

    <li class="nav-item mb-1">
      <a href="{{ route('admin.users.index') }}" class="nav-link d-flex align-items-center text-white py-2 px-3 rounded-3 sidebar-link">
        <i class="fas fa-users me-3 fs-5"></i> <span>Akun User</span>
      </a>
    </li>

    <li class="nav-item mb-1">
      <a href="{{ route('admin.settingprofile.identitas.index') }}" class="nav-link d-flex align-items-center text-white py-2 px-3 rounded-3 sidebar-link">
        <i class="fas fa-cog me-3 fs-5"></i> <span>Setting Profil</span>
      </a>
    </li>

    <li class="nav-item mb-1">
      <a href="#" class="nav-link d-flex align-items-center text-white py-2 px-3 rounded-3 sidebar-link">
        <i class="fas fa-chart-bar me-3 fs-5"></i> <span>Laporan</span>
      </a>
    </li>

    <br>

    <li class="nav-item mb-1">
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="dropdown-item text-danger">
      <i class="fas fa-sign-out-alt me-2"></i> Logout
    </button>
  </form>
</li>

  </ul>

  <!-- Footer -->
  <div class="mt-auto text-center pt-4">
    <hr class="border-white-25 mb-3">
    <p class="small text-white-50 mb-1">Version 1.0</p>
    <div class="d-flex justify-content-center align-items-center text-success small">
      <div class="bg-success rounded-circle me-2" style="width: 8px; height: 8px;"></div>
      Online
    </div>
  </div>
</div>
