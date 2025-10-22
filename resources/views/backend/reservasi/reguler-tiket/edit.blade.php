@extends('layouts.backend')

@section('title', 'Edit Tiket Reguler')
@section('page-title', 'Edit Tiket Reguler')
@section('breadcrumb', 'Reservasi / Reguler Tiket / Edit')

@section('content')
<div class="container py-4">
  <div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">
      <form action="{{ route('admin.reservasi.reguler.update', $tiket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label>Nama Paket</label>
          <input type="text" name="nama_paket" class="form-control" value="{{ $tiket->nama_paket }}" required>
        </div>
        <div class="mb-3">
          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4">{{ $tiket->deskripsi }}</textarea>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $tiket->harga }}" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Diskon</label>
            <input type="number" name="diskon" class="form-control" value="{{ $tiket->diskon }}">
          </div>
        </div>
        <div class="mb-3">
          <label>Gambar</label>
          @if($tiket->gambar)
            <img src="{{ asset('storage/'.$tiket->gambar) }}" width="100" class="d-block mb-2">
          @endif
          <input type="file" name="gambar" class="form-control">
        </div>
        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-select">
            <option value="1" {{ $tiket->status ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !$tiket->status ? 'selected' : '' }}>Nonaktif</option>
          </select>
        </div>
        <button class="btn btn-warning">Update</button>
        <a href="{{ route('admin.reservasi.reguler.index') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection
