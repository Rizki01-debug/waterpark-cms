@extends('layouts.backend')

@section('title', 'Tambah Tiket Reguler')
@section('page-title', 'Tambah Tiket Reguler')
@section('breadcrumb', 'Reservasi / Reguler Tiket / Tambah')

@section('content')
<div class="container py-4">
  <div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">
      <form action="{{ route('admin.reservasi.reguler.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label>Nama Paket</label>
          <input type="text" name="nama_paket" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Diskon</label>
            <input type="number" name="diskon" class="form-control">
          </div>
        </div>
        <div class="mb-3">
          <label>Gambar</label>
          <input type="file" name="gambar" class="form-control">
        </div>
        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-select">
            <option value="1" selected>Aktif</option>
            <option value="0">Nonaktif</option>
          </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.reservasi.reguler.index') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection
