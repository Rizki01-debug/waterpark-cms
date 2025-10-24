@extends('layouts.backend')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="container-fluid py-4">
  <div class="card bg-dark text-white border-0 shadow p-4 rounded-4">
    <h4 class="fw-bold mb-4">Edit Event: {{ $event->judul }}</h4>

    <form action="{{ route('admin.blog.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Judul Event</label>
        <input type="text" name="judul" value="{{ old('judul', $event->judul) }}" class="form-control bg-dark text-white" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar / Poster</label>
        @if($event->gambar)
          <div class="mb-2">
            <img src="{{ asset('storage/'.$event->gambar) }}" alt="Gambar" class="rounded" width="100">
          </div>
        @endif
        <input type="file" name="gambar" class="form-control bg-dark text-white">
      </div>

      <div class="mb-3">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" value="{{ old('lokasi', $event->lokasi) }}" class="form-control bg-dark text-white">
      </div>

      <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" value="{{ old('tanggal', $event->tanggal ? $event->tanggal->format('Y-m-d') : '') }}" class="form-control bg-dark text-white">
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select bg-dark text-white">
          <option value="Publish" {{ $event->status == 'Publish' ? 'selected' : '' }}>Publish</option>
          <option value="Draft" {{ $event->status == 'Draft' ? 'selected' : '' }}>Draft</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="penulis" value="{{ old('penulis', $event->penulis) }}" class="form-control bg-dark text-white">
      </div>

      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Update</button>
        <a href="{{ route('admin.blog.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
      </div>
    </form>
  </div>
</div>
@endsection
