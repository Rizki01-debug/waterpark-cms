@extends('layouts.frontend')

@section('title', 'Reservasi Tiket Reguler')

@section('content')
<section class="py-5" style="margin-top: 100px;">
  <div class="container">
    <h2 class="fw-bold text-center mb-4 text-dark">Pilih Tiket Sesuai Kebutuhan</h2>

    {{-- Grid Card Tiket --}}
    <div class="row g-4 justify-content-center">
      @forelse($tiket as $item)
        <div class="col-md-4 col-sm-6">
          <div class="card tiket-card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
            {{-- Gambar --}}
            <img 
              src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('simplecity/img/travel/default-fasilitas.jpg') }}"
              alt="{{ $item->nama_paket }}"
              class="card-img-top"
              style="height: 220px; object-fit: cover;">

            {{-- Isi Card --}}
            <div class="card-body text-center bg-white">
              <h5 class="fw-semibold text-dark mb-2">{{ $item->nama_paket }}</h5>
              <p class="text-muted small mb-3">{{ Str::limit($item->deskripsi, 80) }}</p>

              {{-- Harga --}}
              <div class="mb-3">
                @if($item->diskon > 0)
                  <span class="text-muted text-decoration-line-through me-2">
                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                  </span>
                  <span class="text-danger fw-bold">
                    Rp{{ number_format($item->harga - ($item->harga * $item->diskon / 100), 0, ',', '.') }}
                  </span>
                @else
                  <span class="text-primary fw-bold">
                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                  </span>
                @endif
              </div>

              {{-- Tombol --}}
              <a href="{{ route('reservasi.reguler.show', $item->id) }}" 
                  class="btn btn-outline-primary btn-sm rounded-pill px-3 mb-2">
                <i class="bi bi-eye"></i> Lihat Detail
              </a>

              <button 
                class="btn btn-primary btn-pay"
                data-tiket-id="{{ $item->id }}"
                data-jenis="reguler">
                Pesan & Bayar
              </button>
            </div>
          </div>
        </div>
      @empty
        <div class="text-center py-5">
          <img src="{{ asset('simplecity/img/no-data.svg') }}" alt="Tidak ada tiket" width="180" class="mb-3 opacity-75">
          <p class="text-muted">Belum ada tiket tersedia saat ini.</p>
        </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($tiket->hasPages())
      <div class="d-flex justify-content-center mt-4">
        {{ $tiket->links('vendor.pagination.bootstrap-5') }}
      </div>
    @endif
  </div>
</section>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
  const payButtons = document.querySelectorAll('.btn-pay');
  if (!payButtons.length) return console.error("❌ Tidak ada tombol pembayaran ditemukan!");

  payButtons.forEach(btn => {
    btn.addEventListener('click', async function() {
      const tiketId = this.dataset.tiketId;
      const jenis = this.dataset.jenis;
      const originalText = this.innerHTML;

      // Loading state
      this.disabled = true;
      this.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';

      try {
        const response = await fetch("{{ route('payment.create') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ tiket_id: tiketId, jenis })
        });

        const text = await response.text();
        const data = JSON.parse(text);

        if (data.snap_token) {
          snap.pay(data.snap_token, {
            onSuccess: result => {
              alert('✅ Pembayaran berhasil!');
              location.reload();
            },
            onPending: result => {
              alert('⌛ Pembayaran menunggu konfirmasi.');
            },
            onError: result => {
              alert('❌ Terjadi kesalahan saat pembayaran.');
            },
            onClose: () => {
              alert('Kamu menutup popup pembayaran.');
            }
          });
        } else {
          alert(data.message || 'Gagal memproses pembayaran.');
        }

      } catch (err) {
        console.error(err);
        alert('Terjadi kesalahan koneksi ke server.');
      } finally {
        this.disabled = false;
        this.innerHTML = originalText;
      }
    });
  });
});
</script>