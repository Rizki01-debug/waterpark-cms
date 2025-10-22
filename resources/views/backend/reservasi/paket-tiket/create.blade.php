@extends('layouts.backend')

@section('title', 'Tambah Paket Tiket')

@section('content')
<div class="container py-4">
  <div class="card bg-gray-900 border-0 shadow-lg rounded-3 p-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-white mb-0 fw-semibold"><i class="fas fa-tag me-2"></i>Tambah Paket Tiket</h4>
      <a href="{{ route('admin.reservasi.paket.index') }}" class="btn btn-secondary fw-bold">
        <i class="fas fa-arrow-left me-1"></i> KEMBALI
      </a>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
      <div class="alert alert-danger text-dark fw-semibold">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Tambah --}}
    <form action="{{ route('admin.reservasi.paket.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Nama Paket --}}
      <div class="mb-3">
        <label for="nama_paket" class="form-label text-white">Nama Paket</label>
        <input type="text" name="nama_paket" id="nama_paket" class="form-control bg-dark text-white border-secondary" placeholder="Masukkan nama paket" required>
      </div>

      {{-- Deskripsi --}}
      <div class="mb-3">
        <label for="deskripsi" class="form-label text-white">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control bg-dark text-white border-secondary" rows="4" placeholder="Masukkan deskripsi"></textarea>
      </div>

      {{-- Harga & Diskon --}}
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="harga" class="form-label text-white">Harga</label>
          <input type="number" name="harga" id="harga" class="form-control bg-dark text-white border-secondary" placeholder="Masukkan harga" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="diskon" class="form-label text-white">Diskon</label>
          <input type="number" name="diskon" id="diskon" class="form-control bg-dark text-white border-secondary" placeholder="Masukkan diskon (opsional)">
        </div>
      </div>

      {{-- Gambar --}}
      <div class="mb-3">
        <label for="gambar" class="form-label text-white">Gambar / Poster</label>
        <input type="file" name="gambar" id="gambar" class="form-control bg-dark text-white border-secondary">
        <small class="text-muted">Format: JPG, JPEG, PNG (maks. 2MB)</small>
      </div>

      {{-- Status --}}
      <div class="mb-4">
        <label for="status" class="form-label text-white">Status</label>
        <select name="status" id="status" class="form-select bg-dark text-white border-secondary">
          <option value="1" selected>Aktif</option>
          <option value="0">Nonaktif</option>
        </select>
      </div>

      {{-- Tombol Aksi --}}
      <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-danger fw-bold px-4">
          <i class="fas fa-save me-1"></i> SIMPAN
        </button>
        <a href="{{ route('admin.reservasi.paket.index') }}" class="btn btn-outline-light fw-semibold px-4">
          BATAL
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
