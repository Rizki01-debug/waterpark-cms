@extends('layouts.frontend')

@section('title', $penginapan->nama_paket ?? 'Detail Penginapan')

@section('content')
<main class="main py-5" style="margin-top: 80px;">
  <div class="container" data-aos="fade-up">

    {{-- Tombol Kembali --}}
    <div class="mb-4">
      <a href="{{ route('reservasi.penginapan.index') }}" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>

    {{-- Card Detail Penginapan --}}
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <div class="row align-items-center g-4">

        {{-- Gambar --}}
        <div class="col-md-6 text-center">
          <img src="{{ $penginapan->gambar ? asset('storage/' . $penginapan->gambar) : asset('simplecity/img/default-image.jpg') }}"
               alt="{{ $penginapan->nama_paket }}"
               class="img-fluid rounded-4 shadow-sm"
               style="max-height: 400px; object-fit: cover;">
        </div>

        {{-- Detail --}}
        <div class="col-md-6">
          <h3 class="fw-bold text-dark mb-2">{{ $penginapan->nama_paket }}</h3>
          <p class="text-muted mb-3">Harga:</p>

          {{-- Harga --}}
          <div class="mb-4">
            @if($penginapan->diskon > 0)
              <span class="text-muted text-decoration-line-through me-2">
                Rp{{ number_format($penginapan->harga, 0, ',', '.') }}
              </span>
              <span class="text-danger fw-bold fs-5">
                Rp{{ number_format($penginapan->harga - ($penginapan->harga * $penginapan->diskon / 100), 0, ',', '.') }}
              </span>
            @else
              <span class="text-primary fw-bold fs-5">
                Rp{{ number_format($penginapan->harga, 0, ',', '.') }}
              </span>
            @endif
          </div>

          {{-- Deskripsi --}}
          <div class="bg-light-subtle p-3 rounded-4 border mb-4">
            <p class="mb-0 text-dark">
              {{ $penginapan->deskripsi ?? 'Deskripsi penginapan belum tersedia.' }}
            </p>
          </div>

          {{-- Tombol --}}
          <div class="d-flex gap-3 mt-3">
<button 
  class="btn btn-primary btn-pay"
  data-tiket-id="{{ $penginapan->id }}"
  data-jenis="penginapan">
  <i class="bi bi-credit-card"></i> Pesan & Bayar
</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<style>
  .btn-outline-secondary {
    border-color: #ccc;
    color: #444;
  }

  .btn-outline-secondary:hover {
    background-color: #f8f9fa;
    border-color: #999;
  }

  .btn-primary {
    background-color: #0096c7;
    border-color: #0096c7;
  }

  .btn-primary:hover {
    background-color: #0077b6;
    border-color: #0077b6;
  }

  .card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
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

