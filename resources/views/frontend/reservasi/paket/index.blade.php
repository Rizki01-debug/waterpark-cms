@extends('layouts.frontend')

@section('title', 'Reservasi Paket Tiket')

@section('content')
<section class="py-5" style="margin-top: 100px;">
    <div class="container" data-aos="fade-up">
        <h2 class="fw-bold text-center mb-4 text-dark">Pilih Paket Sesuai Kebutuhan</h2>

        <div class="row justify-content-center g-4">
            @forelse($paket as $item)
                <div class="col-md-4 col-lg-3" data-aos="zoom-in">
                    <div class="card paket-card border-0 shadow-sm h-100 rounded-4 overflow-hidden bg-white">
                        
                        {{-- Gambar --}}
                        <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('simplecity/img/default-image.jpg') }}"
                             alt="{{ $item->nama_paket }}"
                             class="card-img-top"
                             style="height: 180px; object-fit: cover;">

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
                            <a href="{{ route('reservasi.paket.show', $item->id) }}" class="btn btn-outline-primary btn-sm px-4 rounded-pill">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                            <a href="#" class="btn btn-primary btn-sm px-4 rounded-pill ms-2">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada paket tiket tersedia saat ini.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($paket->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $paket->links('vendor.pagination.bootstrap-5') }}
        </div>
        @endif
    </div>
</section>
@endsection
