@extends('layouts.frontend')
@section('title', 'Pembelian Saya')

@section('content')
<section class="py-5" style="margin-top: 100px;">
  <div class="container">
    <h3 class="fw-bold mb-4 text-dark">Daftar Pembelian Saya</h3>

    @forelse($pemesanan as $item)
    <div class="card shadow-sm mb-4 rounded-4 border-0">
      <div class="card-body d-flex justify-content-between align-items-center">

        {{-- Kiri: Gambar & Info Tiket --}}
        <div class="d-flex align-items-center gap-3">
          <img src="{{ asset('simplecity/img/travel/ticket-default.jpg') }}" alt="Tiket"
               class="rounded-3" width="80" height="80" style="object-fit: cover;">
          <div>
            <h5 class="fw-semibold mb-1">{{ ucfirst($item->jenis) }} {{ $item->nama_pemesan }}</h5>
           <p class="text-muted mb-0">Total: {{ $item->total_formatted }}</p>

            {{-- STATUS --}}
            @if($item->status == 'Pending')
              <span class="badge bg-warning text-dark mt-2">Menunggu Konfirmasi</span>
            @elseif($item->status == 'Berhasil')
              <span class="badge bg-success mt-2">Berhasil</span>
            @elseif($item->status == 'Batal')
              <span class="badge bg-danger mt-2">Dibatalkan</span>
            @else
              <span class="badge bg-secondary mt-2">{{ $item->status }}</span>
            @endif
          </div>
        </div>

        {{-- Kanan: Tombol --}}
        <div class="text-end">
          @if($item->nota_path)
            <a href="{{ route('user.pemesanan.nota', $item->id) }}" class="btn btn-outline-success btn-sm rounded-pill me-2">
              <i class="bi bi-file-earmark-arrow-down"></i> Nota
            </a>
          @endif

          <form action="{{ route('user.pemesanan.destroy', $item->id) }}" method="POST" class="d-inline"
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
    <div class="d-flex justify-content-center mt-4">
      {{ $pemesanan->links() }}
    </div>
  </div>
</section>
@endsection
