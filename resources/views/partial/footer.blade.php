<footer id="footer" class="footer position-relative dark-background">

  {{-- Newsletter Section --}}
  <div class="footer-newsletter">
    <div class="container text-center">
      <h4>Bergabung Bersama Kami</h4>
      <p>Dapatkan info terbaru dan promo menarik dari {{ $companyProfile->nama ?? 'Embun Pelangi Waterpark' }}</p>
      <form action="#" method="post" class="php-email-form d-flex justify-content-center mt-3">
        <div class="newsletter-form">
          <input type="email" name="email" placeholder="Masukkan email kamu" required>
          <input type="submit" value="Berlangganan">
        </div>
      </form>
    </div>
  </div>

  {{-- Footer Content --}}
  <div class="container footer-top py-5">
    <div class="row gy-4">

      {{-- Tentang Perusahaan --}}
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="{{ url('/') }}" class="d-flex align-items-center mb-3 text-decoration-none">
          @if(!empty($companyProfile->logo_footer))
            <img src="{{ asset('storage/' . $companyProfile->logo_footer) }}" alt="Logo Footer" height="50" class="me-2">
          @endif
          <span class="sitename text-warning fs-5 fw-bold">{{ $companyProfile->nama ?? 'Embun Pelangi Waterpark' }}</span>
        </a>
        <p class="small text-light">{{ $companyProfile->deskripsi ?? 'Waterpark keluarga terbaik di Indramayu dengan fasilitas lengkap dan nyaman.' }}</p>

        <div class="footer-contact pt-3">
          <p>{{ $companyContact->alamat ?? 'Alamat belum diatur' }}</p>
          <p class="mt-2"><strong>Telepon:</strong> <span>{{ $companyContact->telepon ?? '-' }}</span></p>
          <p><strong>Email:</strong> <span>{{ $companyContact->email ?? '-' }}</span></p>
          <p><strong>Jam Operasional:</strong> <span>{{ $companyContact->jam_operasional ?? '-' }}</span></p>
        </div>
      </div>

      {{-- Navigasi Cepat --}}
      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Menu</h4>
        <ul class="list-unstyled">
          <li><i class="bi bi-chevron-right"></i> <a href="{{ url('/') }}">Beranda</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#tentang">Tentang Kami</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#fasilitas">Fasilitas</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#reservasi">Reservasi</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#kontak">Kontak</a></li>
        </ul>
      </div>

      {{-- Media Sosial --}}
      <div class="col-lg-4 col-md-12">
        <h4>Ikuti Kami</h4>
        <p class="small text-light">Terhubung dengan kami di media sosial:</p>
        <div class="social-links d-flex gap-3 mt-3">
          @if(!empty($companySocial->facebook))
            <a href="{{ $companySocial->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
          @endif
          @if(!empty($companySocial->instagram))
            <a href="{{ $companySocial->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
          @endif
          @if(!empty($companySocial->tiktok))
            <a href="{{ $companySocial->tiktok }}" target="_blank"><i class="bi bi-tiktok"></i></a>
          @endif
          @if(!empty($companySocial->youtube))
            <a href="{{ $companySocial->youtube }}" target="_blank"><i class="bi bi-youtube"></i></a>
          @endif
        </div>
      </div>

    </div>
  </div>

  {{-- Copyright --}}
  <div class="container text-center mt-4 text-secondary small">
    <p>© {{ date('Y') }} <strong class="text-warning">{{ $companyProfile->nama ?? 'Embun Pelangi Waterpark' }}</strong>. Semua Hak Dilindungi.</p>
    <p class="credits">Dikelola oleh <span class="text-light">Waterpark CMS</span></p>
  </div>

</footer>
