@extends('layouts.frontend')

@section('title', 'Reservasi Penginapan')

@section('content')
<section class="py-5" style="margin-top: 100px;">
  <div class="container" data-aos="fade-up">
    <h2 class="fw-bold text-center mb-4 text-dark">Pilih Kamar Sesuai Kebutuhanmu</h2>

    {{-- Grid Penginapan --}}
    <div class="row justify-content-center g-4">
      @forelse($penginapan as $item)
        <div class="col-md-4 col-lg-3" data-aos="zoom-in">
          <div class="card penginapan-card border-0 shadow-sm h-100 rounded-4 overflow-hidden bg-white">
            
            {{-- Gambar --}}
            <img 
              src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('simplecity/img/default-image.jpg') }}"
              alt="{{ $item->nama_paket }}"
              class="card-img-top"
              style="height: 200px; object-fit: cover;">

            {{-- Isi Card --}}
            <div class="card-body text-center">
              <h5 class="fw-semibold text-dark">{{ $item->nama_paket }}</h5>
              <p class="text-muted small mb-2">{{ Str::limit($item->deskripsi, 80) }}</p>

              {{-- Harga --}}
              <div class="mb-3">
                @if($item->diskon > 0)
                  <span class="text-decoration-line-through text-muted me-2">
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
              <a href="{{ route('reservasi.penginapan.show', $item->id) }}" 
                 class="btn btn-outline-primary btn-sm px-4 rounded-pill">
                <i class="bi bi-eye"></i> Lihat Detail
              </a>

              <button 
                class="btn btn-primary btn-pay"
                data-tiket-id="{{ $item->id }}"
                data-jenis="penginapan">
                <i class="bi bi-credit-card"></i> Pesan & Bayar
              </button>
            </div>
          </div>
        </div>
      @empty
        <p class="text-center text-muted">Belum ada kamar penginapan tersedia saat ini.</p>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($penginapan->hasPages())
      <div class="d-flex justify-content-center mt-4">
        {{ $penginapan->links('vendor.pagination.bootstrap-5') }}
      </div>
    @endif
  </div>
</section>

{{-- Custom Style --}}
<style>
  .penginapan-card {
    transition: all 0.3s ease;
  }
  .penginapan-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
  }
  .btn-outline-primary {
    border-color: #0096c7;
    color: #0096c7;
  }
  .btn-outline-primary:hover {
    background-color: #0096c7;
    color: #fff;
  }
</style>
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
