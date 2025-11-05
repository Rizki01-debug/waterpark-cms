<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- ✅ Vendor CSS --}}
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/glightbox/css/glightbox.min.css') }}">

    {{-- ✅ Custom Template CSS --}}
    <link rel="stylesheet" href="{{ asset('simplecity/css/main.css') }}">

        <!-- Scripts -->
    <script src="{{ asset('simplecity/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/glightbox/js/glightbox.min.js') }}"></script>

    {{-- ✅ Main JS --}}
    <script src="{{ asset('simplecity/js/main.js') }}"></script>
        
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background-color: #f8f9fa;
            }
            .auth-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .auth-card {
                border: none;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 0.5rem;
            }
        </style>
    </head>
    <body class="text-gray-900">
        <div class="auth-container py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 text-center mb-4">
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
               style="width: 200px; height: 200px; object-fit: cover;">
      @else
          <img src="{{ asset('default-favicon.png') }}" 
               alt="Default Logo" 
               class="rounded-circle shadow-sm" 
               style="width: 220px; height: 220px; object-fit: cover;">
      @endif
    </div>
                    </div>
                </div>         
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card auth-card">
                            <div class="card-body p-4">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>