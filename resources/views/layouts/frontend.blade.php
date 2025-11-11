<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Waterpark - Homepage')</title>

    {{-- ✅ Dynamic Favicon --}}
    @php
        $favicon = \App\Models\CompanyProfile::first()->favicon ?? null;
    @endphp

    @if ($favicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon) }}?v={{ time() }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('simplecity/img/favicon.png') }}">
    @endif

    {{-- ✅ Vendor CSS --}}
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/glightbox/css/glightbox.min.css') }}">

    {{-- ✅ Custom Template CSS --}}
    <link rel="stylesheet" href="{{ asset('simplecity/css/main.css') }}">
</head>

<body class="bg-light text-dark">

    {{-- Navbar --}}
    @include('partial.navbar')

    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partial.footer')

    {{-- ✅ Vendor JS --}}
    <script src="{{ asset('simplecity/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/glightbox/js/glightbox.min.js') }}"></script>

    {{-- ✅ Main JS --}}
    <script src="{{ asset('simplecity/js/main.js') }}"></script>

    <script>
        AOS.init({ duration: 1000, once: true });

        new Swiper('.swiper', {
            loop: true,
            autoplay: { delay: 3000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
        });

        const lightbox = GLightbox({ selector: '.glightbox' });
    </script>


    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

    @stack('scripts')

</body>
</html>
