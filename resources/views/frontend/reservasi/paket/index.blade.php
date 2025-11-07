@extends('layouts.frontend')

@section('title', 'Reservasi Paket Tiket')

@section('content')
<section class="py-5" style="margin-top: 100px;">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Pilih Paket Sesuai Kebutuhan</h2>

        <div class="row justify-content-center">
            @forelse($paket as $item)
                <div class="col-md-4 col-lg-3 mb-4" data-aos="fade-up">
                    <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_paket }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                        @else
                            <img src="{{ asset('simplecity/img/default-image.jpg') }}" alt="default" class="card-img-top" style="height: 180px; object-fit: cover;">
                        @endif

                        <div class="card-body text-center">
                            <h5 class="fw-semibold">{{ $item->nama_paket }}</h5>
                            <p class="text-muted small mb-2">{{ Str::limit($item->deskripsi, 80) }}</p>

                            <div class="mb-3">
                                @if($item->diskon > 0)
                                    <span class="text-decoration-line-through text-muted me-2">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                                    <span class="text-danger fw-bold">
                                        Rp{{ number_format($item->harga - ($item->harga * $item->diskon / 100), 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-primary fw-bold">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                                @endif
                            </div>

                            <a href="#" class="btn btn-outline-primary btn-sm px-4 rounded-pill">
                                Lihat Detail
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

        <div class="d-flex justify-content-center mt-4">
            {{ $paket->links() }}
        </div>
    </div>
</section>
@endsection
