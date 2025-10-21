@extends('layouts.backend')

@section('title', 'Edit Fasilitas')

@section('content')
<div class="container py-4">
  <h2 class="mb-3">Edit Fasilitas</h2>

  <form action="{{ route('admin.fasilitas.update', $fasilita->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="nama" class="form-label">Nama Fasilitas</label>
      <input type="text" name="nama" id="nama" class="form-control" value="{{ $fasilita->nama }}" required>
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ $fasilita->deskripsi }}</textarea>
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label><br>
      @if($fasilita->gambar)
        <img src="{{ asset('storage/'.$fasilita->gambar) }}" alt="Gambar" width="150" class="mb-2"><br>
      @endif
      <input type="file" name="gambar" id="gambar" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
