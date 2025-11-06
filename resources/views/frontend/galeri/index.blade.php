@extends('layouts.frontend')
@section('title', 'Galeri')

@section('content')
<main class="main py-5 bg-light" style="padding-top:120px;">
  <div class="container" data-aos="fade-up">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-dark">Galeri</h2>
      <p class="text-muted">Momen terbaik di Waterpark kami!</p>
    </div>

    <div class="row g-4">
      @forelse($galleries as $index => $item)
        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $index }}">
              <img src="{{ asset('storage/' . $item->gambar) }}" 
                   class="card-img-top" 
                   alt="{{ $item->judul ?? 'Foto Galeri' }}"
                   style="height: 250px; object-fit: cover; transition: 0.3s; cursor:pointer;">
            </a>
            <div class="card-body text-center">
              <h5 class="fw-bold text-dark">{{ $item->judul ?? 'Tanpa Judul' }}</h5>
              <p class="text-muted small mb-0">{{ $item->deskripsi ?? '' }}</p>
            </div>
          </div>
        </div>

        {{-- Modal Popup --}}
        <div class="modal fade" id="imageModal{{ $index }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border-0">
              <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
                <img src="{{ asset('storage/' . $item->gambar) }}" 
                     class="w-100 rounded" 
                     alt="{{ $item->judul ?? 'Galeri' }}">
              </div>
              @if($item->judul || $item->deskripsi)
                <div class="p-3 text-center text-white">
                  <h5 class="fw-bold mb-1">{{ $item->judul ?? '' }}</h5>
                  <p class="small mb-0">{{ $item->deskripsi ?? '' }}</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      @empty
        <p class="text-center text-muted">Belum ada galeri yang tersedia.</p>
      @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
      {{ $galleries->links('pagination::bootstrap-5') }}
    </div>
  </div>
</main>
@endsection
