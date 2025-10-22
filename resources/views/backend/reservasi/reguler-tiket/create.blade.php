@extends('layouts.backend')

@section('title', 'Tambah Tiket Reguler')

@section('content')
<div class="container py-4">
  <div class="card bg-gray-900 border-0 shadow-lg rounded-3 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-white mb-0"><i class="fas fa-ticket me-2"></i>Tambah Tiket Reguler</h4>
      <a href="{{ route('admin.reservasi.reguler.index') }}" class="btn btn-secondary fw-bold">
        <i class="fas fa-arrow-left me-1"></i> KEMBALI
      </a>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger text-dark fw-semibold">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.reservasi.reguler.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Nama Paket --}}
      <div class="mb-3">
        <label class="form-label text-white">Nama Paket</label>
        <input type="text" name="nama_paket" class="form-control bg-dark text-white border-secondary" required placeholder="Masukkan nama paket">
      </div>

      {{-- Deskripsi --}}
      <div class="mb-3">
        <label class="form-label text-white">Deskripsi</label>
        <textarea name="deskripsi" class="form-control bg-dark text-white border-secondary" rows="4" placeholder="Masukkan deskripsi"></textarea>
      </div>

      {{-- Harga & Diskon --}}
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label text-white">Harga</label>
          <input type="number" name="harga" class="form-control bg-dark text-white border-secondary" required placeholder="Masukkan harga">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label text-white">Diskon</label>
          <input type="number" name="diskon" class="form-control bg-dark text-white border-secondary" placeholder="Masukkan diskon (opsional)">
        </div>
      </div>

      {{-- Upload Gambar --}}
      <div class="mb-3">
        <label class="form-label text-white">Gambar</label>
        <input type="file" name="gambar" class="form-control bg-dark text-white border-secondary">
        <small class="text-muted">Format: jpg, png, jpeg (maks. 2MB)</small>
      </div>

      {{-- Status --}}
      <div class="mb-4">
        <label class="form-label text-white">Status</label>
        <select name="status" class="form-select bg-dark text-white border-secondary">
          <option value="1" selected>Aktif</option>
          <option value="0">Nonaktif</option>
        </select>
      </div>

      {{-- Tombol Aksi --}}
      <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-danger fw-bold px-4">
          <i class="fas fa-save me-1"></i> SIMPAN
        </button>
        <a href="{{ route('admin.reservasi.reguler.index') }}" class="btn btn-outline-light px-4 fw-semibold">
          BATAL
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
