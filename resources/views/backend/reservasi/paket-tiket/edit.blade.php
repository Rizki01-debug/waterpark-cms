@extends('layouts.backend')

@section('title', 'Edit Paket Tiket')

@section('content')
<div class="container py-4">
  <div class="card bg-gray-900 border-0 shadow-lg rounded-3 p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-white mb-0 fw-semibold"><i class="fas fa-tag me-2"></i>Edit Paket Tiket</h4>
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

    {{-- Form Edit --}}
    <form action="{{ route('admin.reservasi.paket.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Nama Paket --}}
      <div class="mb-3">
        <label for="nama_paket" class="form-label text-white">Nama Paket</label>
        <input 
          type="text" 
          name="nama_paket" 
          id="nama_paket" 
          class="form-control bg-dark text-white border-secondary" 
          value="{{ old('nama_paket', $paket->nama_paket) }}" 
          required 
          placeholder="Masukkan nama paket">
      </div>

      {{-- Deskripsi --}}
      <div class="mb-3">
        <label for="deskripsi" class="form-label text-white">Deskripsi</label>
        <textarea 
          name="deskripsi" 
          id="deskripsi" 
          class="form-control bg-dark text-white border-secondary" 
          rows="4" 
          placeholder="Masukkan deskripsi">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
      </div>

      {{-- Harga & Diskon --}}
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="harga" class="form-label text-white">Harga</label>
          <input 
            type="number" 
            name="harga" 
            id="harga" 
            class="form-control bg-dark text-white border-secondary" 
            value="{{ old('harga', $paket->harga) }}" 
            required 
            placeholder="Masukkan harga">
        </div>

        <div class="col-md-6 mb-3">
          <label for="diskon" class="form-label text-white">Diskon</label>
          <input 
            type="number" 
            name="diskon" 
            id="diskon" 
            class="form-control bg-dark text-white border-secondary" 
            value="{{ old('diskon', $paket->diskon) }}" 
            placeholder="Masukkan diskon (opsional)">
        </div>
      </div>

      {{-- Gambar --}}
      <div class="mb-3">
        <label for="gambar" class="form-label text-white">Gambar Saat Ini</label>
        <div class="mb-2">
          @if ($paket->gambar)
            <img src="{{ asset('storage/' . $paket->gambar) }}" alt="gambar" width="140" class="rounded-3 shadow-sm border border-secondary">
          @else
            <p class="text-muted">Tidak ada gambar</p>
          @endif
        </div>
        <input type="file" name="gambar" id="gambar" class="form-control bg-dark text-white border-secondary">
        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
      </div>

      {{-- Status --}}
      <div class="mb-4">
        <label for="status" class="form-label text-white">Status</label>
        <select name="status" id="status" class="form-select bg-dark text-white border-secondary">
          <option value="1" {{ $paket->status ? 'selected' : '' }}>Aktif</option>
          <option value="0" {{ !$paket->status ? 'selected' : '' }}>Nonaktif</option>
        </select>
      </div>

      {{-- Tombol Aksi --}}
      <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-warning fw-bold text-dark px-4">
          <i class="fas fa-save me-1"></i> UPDATE
        </button>
        <a href="{{ route('admin.reservasi.paket.index') }}" class="btn btn-outline-light fw-semibold px-4">
          BATAL
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
