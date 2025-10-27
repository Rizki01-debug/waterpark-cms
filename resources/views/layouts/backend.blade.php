<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') - Waterpark CMS</title>

  {{-- ✅ Dynamic Favicon --}}
  @php
      $favicon = \App\Models\CompanyProfile::first()->favicon ?? null;
  @endphp

  @if ($favicon)
      <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon) }}?v={{ time() }}">
  @else
      <link rel="icon" type="image/png" href="{{ asset('default-favicon.png') }}">
  @endif

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Material Dashboard CSS -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/material-dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/css/material-dashboard.css.map') }}">
  <!-- Custom Sidebar CSS -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/css/backend.css') }}">
</head>

<body>
  <div class="d-flex">
    <!-- Sidebar -->
    @include('partial.sidebar')

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
      <div class="page-container fade-in-up">
        <!-- Content Header -->
        <div class="content-header">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-1"></i>Home</a></li>
                  <li class="breadcrumb-item active">@yield('breadcrumb', 'Dashboard')</li>
                </ol>
              </nav>
            </div>
            
            <!-- User Menu -->
            <div class="dropdown">
              <button class="btn btn-light bg-white rounded-pill px-4 py-2 dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                <div class="avatar-sm bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                  <i class="fas fa-user text-white small"></i>
                </div>
                <span class="text-dark">Admin</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                <li><hr class="dropdown-divider"></li>
<li>
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="dropdown-item text-danger">
      <i class="fas fa-sign-out-alt me-2"></i> Logout
    </button>
  </form>
</li>

              </ul>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="main-content-area">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.9.1/chart.min.js"></script>
  
  <script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Add active class to current page
    document.addEventListener('DOMContentLoaded', function() {
      const currentPath = window.location.pathname;
      const navLinks = document.querySelectorAll('.nav-link');
      
      navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
          link.classList.add('active');
        }
      });
    });

    // Simple animation on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe cards for animation
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.card-material');
      cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease-out';
        observer.observe(card);
      });
    });
  </script>
  
  @stack('scripts')
</body>
</html>
