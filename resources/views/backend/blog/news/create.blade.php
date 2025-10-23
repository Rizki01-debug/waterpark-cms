@extends('layouts.backend')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita')

@section('content')
<div class="container py-4">
  <div class="card border-0 shadow-lg rounded-4 p-4 bg-dark text-white">
    <h4 class="fw-bold mb-3">Tambah Berita</h4>
    <form action="{{ route('admin.blog.news.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label">Judul Berita</label>
        <input type="text" name="judul" class="form-control bg-dark text-white border-secondary" placeholder="Masukkan judul berita" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" rows="4" class="form-control bg-dark text-white border-secondary" placeholder="Tuliskan isi berita..."></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar / Poster</label>
        <input type="file" name="gambar" class="form-control bg-dark text-white border-secondary">
      </div>

      <div class="row mb-3">
        <div class="col-md-4">
          <label class="form-label">Kategori</label>
          <input type="text" name="kategori" class="form-control bg-dark text-white border-secondary" placeholder="Misal: Pengumuman">
        </div>

        <div class="col-md-4">
          <label class="form-label">Penulis</label>
          <input type="text" name="penulis" class="form-control bg-dark text-white border-secondary" placeholder="Nama penulis">
        </div>

        <div class="col-md-4">
          <label class="form-label">Status</label>
          <select name="status" class="form-select bg-dark text-white border-secondary">
            <option value="Publish">Publish</option>
            <option value="Draft">Draft</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Tanggal Publikasi</label>
        <input type="date" name="tanggal" class="form-control bg-dark text-white border-secondary">
      </div>

      <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('admin.blog.news.index') }}" class="btn btn-secondary me-2">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
