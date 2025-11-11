@extends('layouts.frontend')
@section('title', 'Pembelian Saya')

@section('content')
<section class="py-5" style="margin-top: 100px;">
  <div class="container">
    <h3 class="fw-bold mb-4 text-dark">Daftar Pembelian Saya</h3>

    @forelse($pemesanan as $item)
      <div class="card shadow-sm mb-4 rounded-4 border-0 hover-shadow transition-all">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">

          {{-- Kiri: Informasi Tiket --}}
          <div class="d-flex align-items-center gap-3">
            {{-- Gambar default --}}
            <img src="{{ asset('simplecity/img/travel/ticket-default.jpg') }}"
                 alt="Tiket"
                 class="rounded-3"
                 width="75"
                 height="75"
                 style="object-fit: cover; background-color: #f8f9fa;">

            <div>
              <h5 class="fw-semibold mb-1 text-capitalize">
                {{ $item->jenis ?? 'Tiket' }} - {{ $item->nama_pemesan }}
              </h5>
              <p class="text-muted mb-0">Total: Rp{{ number_format($item->total ?? 0, 0, ',', '.') }}</p>

              {{-- STATUS --}}
              @if($item->status == 'Pending')
                <span class="badge bg-warning text-dark mt-2 px-3 py-1">Menunggu Konfirmasi</span>
              @elseif($item->status == 'Berhasil')
                <span class="badge bg-success mt-2 px-3 py-1">Berhasil</span>
              @elseif($item->status == 'Batal')
                <span class="badge bg-danger mt-2 px-3 py-1">Dibatalkan</span>
              @else
                <span class="badge bg-secondary mt-2 px-3 py-1">{{ ucfirst($item->status ?? 'Tidak diketahui') }}</span>
              @endif
            </div>
          </div>

          {{-- Kanan: Tombol --}}
          <div class="text-end mt-3 mt-md-0">
            {{-- Tombol download nota --}}
            @if($item->nota_path)
              <a href="{{ asset('storage/' . $item->nota_path) }}"
                 target="_blank"
                 class="btn btn-outline-success btn-sm rounded-pill me-2">
                <i class="bi bi-file-earmark-arrow-down"></i> Nota
              </a>
            @endif

            {{-- Tombol hapus --}}
            <form action="{{ route('user.pemesanan.destroy', $item->id) }}" 
                  method="POST" 
                  class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-outline-danger btn-sm rounded-pill">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <div class="text-center py-5 text-muted">
        <i class="bi bi-ticket-perforated fs-1 mb-3"></i>
        <p>Belum ada pembelian tiket saat ini.</p>
      </div>
    @endforelse

    {{-- Pagination --}}
    @if($pemesanan->hasPages())
      <div class="d-flex justify-content-center mt-5">
{{ $pemesanan->links('vendor.pagination.bootstrap-5') }}
      </div>
    @endif
  </div>
</section>

{{-- Custom Style --}}
<style>
  .hover-shadow:hover {
    box-shadow: 0 0 18px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
  }

  .transition-all {
    transition: all 0.25s ease;
  }

  .pagination {
    margin-top: 2rem !important;
  }

  .pagination .page-item.active .page-link {
    background-color: #0096c7;
    border-color: #0096c7;
  }
</style>
@endsection
