@extends('layouts.backend')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')
@section('breadcrumb', 'Blog / Events / Edit')

@section('content')
<div class="container py-4">
  <div class="card border-0 shadow-lg rounded-4 p-4" style="background: rgba(25, 25, 35, 0.9);">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-white mb-0"><i class="fas fa-edit me-2"></i> Edit Event</h4>
      <a href="{{ route('admin.blog.events.index') }}" class="btn btn-outline-light fw-bold">
        <i class="fas fa-arrow-left me-1"></i> Kembali
      </a>
    </div>

    {{-- Validasi Error --}}
    @if ($errors->any())
      <div class="alert alert-danger bg-opacity-75 fw-semibold">
        <ul class="mb-0 ps-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('admin.blog.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Judul Event --}}
      <div class="mb-3">
        <label class="form-label text-white fw-semibold">Judul Event</label>
        <input type="text" name="judul" value="{{ old('judul', $event->judul) }}" class="form-control bg-dark text-white border-secondary" required>
      </div>

      {{-- Deskripsi --}}
<div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi event...">{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
</div>


      {{-- Lokasi & Tanggal --}}
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label text-white fw-semibold">Lokasi</label>
          <input type="text" name="lokasi" value="{{ old('lokasi', $event->lokasi) }}" class="form-control bg-dark text-white border-secondary">
        </div>
        <div class="col-md-6">
          <label class="form-label text-white fw-semibold">Tanggal Event</label>
          <input type="date" name="tanggal" value="{{ old('tanggal', $event->tanggal) }}" class="form-control bg-dark text-white border-secondary">
        </div>
      </div>

      {{-- Upload Gambar --}}
      <div class="mb-3 mt-3">
        <label class="form-label text-white fw-semibold">Gambar Event</label>
        <input type="file" name="gambar" id="gambarInput" class="form-control bg-dark text-white border-secondary">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>

        {{-- Gambar Lama --}}
        @if ($event->gambar)
          <div class="mt-3">
            <p class="text-white-50 small mb-2">Gambar Saat Ini:</p>
            <img src="{{ asset('storage/'.$event->gambar) }}" alt="gambar" width="180" class="rounded shadow-sm">
          </div>
        @endif

        {{-- Preview Gambar Baru --}}
        <div id="preview" class="mt-3"></div>
      </div>

      {{-- Status --}}
      <div class="mb-3">
        <label class="form-label text-white fw-semibold">Status</label>
        <select name="status" class="form-select bg-dark text-white border-secondary">
          <option value="Publish" {{ $event->status == 'Publish' ? 'selected' : '' }}>Publish</option>
          <option value="Draft" {{ $event->status == 'Draft' ? 'selected' : '' }}>Draft</option>
        </select>
      </div>

      {{-- Tombol --}}
      <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-danger fw-bold px-4">
          <i class="fas fa-save me-1"></i> Update
        </button>
        <a href="{{ route('admin.blog.events.index') }}" class="btn btn-outline-light px-4 fw-semibold">
          <i class="fas fa-times me-1"></i> Batal
        </a>
      </div>
    </form>
  </div>
</div>

{{-- Preview Gambar --}}
@push('scripts')
<script>
  document.getElementById('gambarInput').addEventListener('change', function(event) {
    const preview = document.getElementById('preview');
    preview.innerHTML = '';
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('rounded', 'shadow-sm', 'mt-2');
        img.style.maxWidth = '180px';
        preview.appendChild(img);
      }
      reader.readAsDataURL(file);
    }
  });
</script>
@endpush
@endsection
