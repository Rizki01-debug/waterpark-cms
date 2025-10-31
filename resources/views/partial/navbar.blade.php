<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">BrandLogo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav gap-3">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Fasilitas</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Penginapan</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="reservasiDropdown" role="button" data-bs-toggle="dropdown">
                        Reservasi
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Tiket Reguler</a></li>
                        <li><a class="dropdown-item" href="#">Tiket Paket</a></li>
                        <li><a class="dropdown-item" href="#">Penginapan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" role="button" data-bs-toggle="dropdown">
                        Blog
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Berita</a></li>
                        <li><a class="dropdown-item" href="#">Event</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center">
            <div class="rounded-circle bg-light text-dark fw-semibold px-3 py-1">
                User
            </div>

                <li class="nav-item mb-1">
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="dropdown-item text-danger">
      <i class="fas fa-sign-out-alt me-2"></i> Logout
    </button>
  </form>
</li>
        </div>
    </div>
</nav>
