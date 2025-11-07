@extends('layouts.frontend')

@section('title', 'Reservasi Tiket Reguler')

@section('content')
<section class="py-5" style="margin-top: 100px;">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Pilih Tiket Sesuai Kebutuhan</h2>

        <div class="row justify-content-center">
            @forelse($tiket as $item)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_paket }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold mb-2">{{ $item->nama_paket }}</h5>
                            <p class="text-muted small">{{ Str::limit($item->deskripsi, 80) }}</p>

                            <div class="mb-2">
                                @if($item->diskon > 0)
                                    <span class="text-decoration-line-through text-muted me-2">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                                    <span class="text-danger fw-bold">Rp{{ number_format($item->harga - ($item->harga * $item->diskon / 100), 0, ',', '.') }}</span>
                                @else
                                    <span class="text-primary fw-bold">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                                @endif
                            </div>

                            <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-3">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada tiket tersedia saat ini.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
