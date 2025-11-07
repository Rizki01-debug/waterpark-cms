@extends('layouts.frontend')

@section('title', 'Events')

@section('content')
<section class="py-5" style="margin-top: 100px;">
  <div class="container" data-aos="fade-up">
    <h2 class="fw-bold text-center mb-4 text-dark">Events</h2>

    {{-- Grid Events --}}
    <div class="row justify-content-center g-4">
      @forelse($events as $item)
        <div class="col-md-6 col-lg-5" data-aos="zoom-in">
          <div class="card event-card border-0 shadow-sm rounded-4 overflow-hidden bg-white h-100">

            {{-- Gambar --}}
            <img 
              src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('simplecity/img/default-image.jpg') }}"
              alt="{{ $item->judul }}"
              class="card-img-top"
              style="height: 200px; object-fit: cover;">

            {{-- Isi Card --}}
            <div class="card-body">
              <h5 class="fw-bold text-dark">{{ $item->judul }}</h5>
              <p class="text-muted small mb-2">
                <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
              </p>
              <p class="text-muted small mb-3">{{ Str::limit($item->deskripsi, 80) }}</p>

              <a href="{{ route('blog.events.show', $item->id) }}" class="btn btn-outline-primary btn-sm px-4 rounded-pill">
                <i class="bi bi-eye"></i> Lihat Detail
              </a>
            </div>
          </div>
        </div>
      @empty
        <p class="text-center text-muted">Belum ada event tersedia saat ini.</p>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($events->hasPages())
      <div class="d-flex justify-content-center mt-4">
        {{ $events->links('vendor.pagination.bootstrap-5') }}
      </div>
    @endif
  </div>
</section>

{{-- Custom Style --}}
<style>
  .event-card {
    transition: all 0.3s ease;
  }

  .event-card:hover {
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
