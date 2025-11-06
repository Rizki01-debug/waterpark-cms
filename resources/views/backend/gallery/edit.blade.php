@extends('layouts.backend')
@section('title', 'Edit Galeri')

@section('content')
<h3>Edit Galeri</h3>

<form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Judul</label>
    <input type="text" name="judul" class="form-control" value="{{ $gallery->judul }}">
  </div>
  <div class="mb-3">
    <label>Gambar Saat Ini</label><br>
    <img src="{{ asset('storage/' . $gallery->gambar) }}" width="150" class="rounded mb-2">
    <input type="file" name="gambar" class="form-control">
  </div>
  <div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="deskripsi" class="form-control" rows="3">{{ $gallery->deskripsi }}</textarea>
  </div>
  <div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" name="status" value="1" {{ $gallery->status ? 'checked' : '' }}>
    <label class="form-check-label">Tampilkan</label>
  </div>
  <button class="btn btn-primary">Perbarui</button>
  <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
