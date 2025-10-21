@extends('layouts.backend')

@section('title', 'Tambah Fasilitas')

@section('content')
<div class="container py-4">
  <div class="card bg-gray-900 border-0 shadow-lg rounded-3 p-4">
    <h4 class="text-white mb-4">Tambah Fasilitas</h4>

    {{-- Tampilkan pesan error validasi --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Tambah --}}
    <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Nama --}}
      <div class="mb-3">
        <label for="nama" class="form-label text-white">Nama Fasilitas</label>
        <input type="text" name="nama" id="nama"
               value="{{ old('nama') }}"
               class="form-control bg-dark text-white border-secondary"
               placeholder="Contoh: Kolam Renang Anak" required>
      </div>

      {{-- Deskripsi --}}
      <div class="mb-3">
        <label for="deskripsi" class="form-label text-white">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi"
                  class="form-control bg-dark text-white border-secondary"
                  rows="4" placeholder="Tuliskan deskripsi singkat fasilitas..." required>{{ old('deskripsi') }}</textarea>
      </div>

      {{-- Gambar --}}
      <div class="mb-3">
        <label for="gambar" class="form-label text-white">Gambar</label>
        <input type="file" name="gambar" id="gambar" class="form-control bg-dark text-white border-secondary">
        <small class="text-muted">Format: JPG, JPEG, PNG (maksimal 2MB)</small>
      </div>

      {{-- Tombol --}}
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-danger fw-bold px-4">Simpan</button>
        <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary fw-bold px-4">Kembali</a>
      </div>
    </form>
  </div>
</div>
@endsection
