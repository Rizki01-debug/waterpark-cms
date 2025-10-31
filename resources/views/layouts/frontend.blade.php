<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Waterpark - Homepage')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('simplecity/css/main.css') }}>
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('simplecity/vendor/glightbox/css/glightbox.min.css') }}">

</head>
<body class="bg-light text-dark">

    {{-- Navbar --}}
    @include('partial.navbar')

    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partial.footer')

     {{-- ✅ Vendor JS Files --}}
    <script src="{{ asset('simplecity/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('simplecity/vendor/glightbox/js/glightbox.min.js') }}"></script>

    {{-- ✅ SimpleCity Main JS --}}
    <script src="{{ asset('simplecity/js/main.js') }}"></script>

    {{-- ✅ Inisialisasi AOS, Swiper, dan Glightbox --}}
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>

</body>
</html>
