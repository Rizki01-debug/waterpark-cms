@extends('layouts.backend')

@section('title', 'Edit Penginapan')
@section('page-title', 'Edit Penginapan')
@section('breadcrumb', 'Edit Penginapan')

@section('content')
<div class="container py-4">
  <div class="card border-0 shadow-lg rounded-4 p-4" style="background: rgba(25, 25, 35, 0.9);">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-white mb-0"><i class="fas fa-bed me-2"></i> Edit Penginapan</h4>
      <a href="{{ route('admin.reservasi.penginapan.index') }}" class="btn btn-outline-light fw-bold">
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

    {{-- Form Update --}}
    <form action="{{ route('admin.reservasi.penginapan.update', $penginapan->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Nama Paket --}}
      <div class="mb-3">
        <label class="form-label text-white fw-semibold">Nama Paket</label>
        <input type="text" name="nama_paket" 
               value="{{ old('nama_paket', $penginapan->nama_paket) }}"
               class="form-control bg-dark text-white border-secondary" required
               placeholder="Masukkan nama paket">
      </div>

      {{-- Deskripsi --}}
      <div class="mb-3">
        <label class="form-label text-white fw-semibold">Deskripsi</label>
        <textarea name="deskripsi" class="form-control bg-dark text-white border-secondary" rows="4"
                  placeholder="Masukkan deskripsi">{{ old('deskripsi', $penginapan->deskripsi) }}</textarea>
      </div>

      {{-- Harga & Diskon --}}
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label text-white fw-semibold">Harga</label>
          <input type="number" name="harga" min="0"
                 value="{{ old('harga', $penginapan->harga) }}"
                 class="form-control bg-dark text-white border-secondary" required
                 placeholder="Masukkan harga">
        </div>
        <div class="col-md-6">
          <label class="form-label text-white fw-semibold">Diskon</label>
          <input type="number" name="diskon" min="0"
                 value="{{ old('diskon', $penginapan->diskon) }}"
                 class="form-control bg-dark text-white border-secondary"
                 placeholder="Masukkan diskon (opsional)">
        </div>
      </div>

      {{-- Upload Gambar --}}
      <div class="mb-3 mt-3">
        <label class="form-label text-white fw-semibold">Gambar/Poster</label>
        <input type="file" name="gambar" id="gambarInput"
               class="form-control bg-dark text-white border-secondary">
        <small class="text-muted">Format: JPG, PNG, JPEG (maks. 2MB)</small>

        {{-- Gambar Lama --}}
        @if ($penginapan->gambar)
          <div class="mt-3">
            <p class="text-white-50 mb-2">Gambar Lama:</p>
            <img src="{{ asset('storage/' . $penginapan->gambar) }}" 
                 alt="Gambar Lama" 
                 class="rounded shadow-sm" 
                 style="max-width: 180px;">
          </div>
        @endif

        {{-- Preview Gambar Baru --}}
        <div id="preview" class="mt-3"></div>
      </div>

      {{-- Status --}}
      <div class="mb-4">
        <label class="form-label text-white fw-semibold">Status</label>
        <select name="status" class="form-select bg-dark text-white border-secondary">
          <option value="1" {{ old('status', $penginapan->status) == 1 ? 'selected' : '' }}>Aktif</option>
          <option value="0" {{ old('status', $penginapan->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
        </select>
      </div>

      {{-- Tombol Aksi --}}
      <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-danger fw-bold px-4 hover-shadow-sm">
          <i class="fas fa-save me-1"></i> Perbarui
        </button>
        <a href="{{ route('admin.reservasi.penginapan.index') }}" class="btn btn-outline-light px-4 fw-semibold hover-shadow-sm">
          <i class="fas fa-times me-1"></i> Batal
        </a>
      </div>
    </form>
  </div>
</div>

{{-- Script Preview Gambar Baru --}}
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
