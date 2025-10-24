@extends('layouts.backend')

@section('title', 'Tambah Event')
@section('page-title', 'Tambah Event')

@section('content')
<div class="container-fluid py-4">
  <div class="card bg-dark text-white border-0 shadow p-4 rounded-4">
    <h4 class="fw-bold mb-4">Tambah Event Baru</h4>

    <form action="{{ route('admin.blog.events.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label">Judul Event</label>
        <input type="text" name="judul" class="form-control bg-dark text-white" placeholder="Masukkan judul event" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar / Poster</label>
        <input type="file" name="gambar" class="form-control bg-dark text-white">
      </div>

      <div class="mb-3">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" class="form-control bg-dark text-white" placeholder="Contoh: Waterpark Center">
      </div>

      <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control bg-dark text-white">
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select bg-dark text-white">
          <option value="Publish">Publish</option>
          <option value="Draft">Draft</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="penulis" class="form-control bg-dark text-white" placeholder="Nama penulis">
      </div>

      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan</button>
        <a href="{{ route('admin.blog.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
      </div>
    </form>
  </div>
</div>
@endsection
