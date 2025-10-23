@extends('layouts.backend')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')

@section('content')
<div class="container py-4">
  <div class="card border-0 shadow-lg rounded-4 p-4 bg-dark text-white">
    <h4 class="fw-bold mb-3">Edit Berita</h4>
    <form action="{{ route('admin.blog.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Judul Berita</label>
        <input type="text" name="judul" class="form-control bg-dark text-white border-secondary" value="{{ old('judul', $news->judul) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" rows="4" class="form-control bg-dark text-white border-secondary">{{ old('deskripsi', $news->deskripsi) }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar / Poster</label>
        <input type="file" name="gambar" class="form-control bg-dark text-white border-secondary">
        @if($news->gambar)
        <div class="mt-2">
          <img src="{{ asset('storage/' . $news->gambar) }}" alt="Poster" width="120" class="rounded shadow-sm">
        </div>
        @endif
      </div>

      <div class="row mb-3">
        <div class="col-md-4">
          <label class="form-label">Kategori</label>
          <input type="text" name="kategori" class="form-control bg-dark text-white border-secondary" value="{{ old('kategori', $news->kategori) }}">
        </div>

        <div class="col-md-4">
          <label class="form-label">Penulis</label>
          <input type="text" name="penulis" class="form-control bg-dark text-white border-secondary" value="{{ old('penulis', $news->penulis) }}">
        </div>

        <div class="col-md-4">
          <label class="form-label">Status</label>
          <select name="status" class="form-select bg-dark text-white border-secondary">
            <option value="Publish" {{ $news->status == 'Publish' ? 'selected' : '' }}>Publish</option>
            <option value="Draft" {{ $news->status == 'Draft' ? 'selected' : '' }}>Draft</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Tanggal Publikasi</label>
        <input type="date" name="tanggal" class="form-control bg-dark text-white border-secondary" value="{{ old('tanggal', $news->tanggal) }}">
      </div>

      <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('admin.blog.news.index') }}" class="btn btn-secondary me-2">Batal</a>
        <button type="submit" class="btn btn-success">Perbarui</button>
      </div>
    </form>
  </div>
</div>
@endsection
