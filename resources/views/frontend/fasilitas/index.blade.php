@extends('layouts.frontend')

@section('title', 'Fasilitas - Waterpark')

@section('content')
<section class="section-fasilitas py-5" style="margin-top: 120px;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Fasilitas</h2>
        <p class="text-muted">Nikmati berbagai fasilitas terbaik yang kami miliki untuk kenyamanan Anda.</p>

        <div class="row justify-content-center mt-5">
            @forelse($fasilitas as $item)
                <div class="col-md-4 mb-4" data-aos="fade-up">
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">{{ $item->nama }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($item->deskripsi, 100) }}</p>
                            <a href="{{ route('fasilitas.show', $item->id) }}" class="btn btn-outline-primary">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada fasilitas yang ditambahkan.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
