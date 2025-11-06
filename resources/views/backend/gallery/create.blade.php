@extends('layouts.backend')
@section('title', 'Tambah Galeri')

@section('content')
<h3>Tambah Galeri</h3>

<form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label>Judul</label>
    <input type="text" name="judul" class="form-control">
  </div>
  <div class="mb-3">
    <label>Gambar</label>
    <input type="file" name="gambar" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
  </div>
  <div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" name="status" value="1" checked>
    <label class="form-check-label">Tampilkan</label>
  </div>
  <button class="btn btn-primary">Simpan</button>
  <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
