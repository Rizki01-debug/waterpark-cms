@extends('layouts.backend')

@section('title', 'Setting Profile Perusahaan')
@section('page-title', 'Setting Profile Perusahaan')
@section('breadcrumb', 'Setting / Profile Perusahaan')

@section('content')
<div class="container-fluid py-4">

  {{-- Navigation Tabs --}}
  <div class="d-flex mb-4">
    <a href="{{ route('admin.settingprofile.identitas.index') }}" class="btn btn-danger fw-semibold shadow-sm me-2">
      <i class="fas fa-id-card me-1"></i> Identitas Dasar
    </a>
    <a href="{{ route('admin.settingprofile.kontak.index') }}" class="btn btn-outline-light fw-semibold shadow-sm me-2">
      <i class="fas fa-map-marker-alt me-1"></i> Kontak & Lokasi
    </a>
    <a href="{{ route('admin.settingprofile.sosial.index') }}" class="btn btn-outline-light fw-semibold shadow-sm">
      <i class="fas fa-share-alt me-1"></i> Sosial Media
    </a>
  </div>

  {{-- Card Form --}}
  <div class="card bg-dark border-0 shadow-lg rounded-4 p-4">
    <form action="{{ route('admin.settingprofile.identitas.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <h5 class="text-white fw-semibold mb-3"><i class="fas fa-building me-2"></i> Identitas Dasar</h5>

      {{-- Nama Waterpark --}}
      <div class="mb-3">
        <label class="form-label text-white">Nama Waterpark</label>
        <input 
          type="text" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="nama"
          placeholder="Masukkan nama perusahaan / waterpark"
          value="{{ old('nama', $profile->nama ?? '') }}">
      </div>

      {{-- Tagline --}}
      <div class="mb-3">
        <label class="form-label text-white">Tagline / Motto</label>
        <input 
          type="text" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="tagline"
          placeholder="Masukkan tagline atau moto perusahaan"
          value="{{ old('tagline', $profile->tagline ?? '') }}">
      </div>

      {{-- Deskripsi --}}
      <div class="mb-3">
        <label class="form-label text-white">Deskripsi / Tentang Kami</label>
        <textarea 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="deskripsi" 
          rows="4"
          placeholder="Tuliskan deskripsi singkat tentang perusahaan">{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
      </div>

      {{-- Upload Gambar --}}
      <div class="row mb-3">
        <div class="col-md-4">
          <label class="form-label text-white">Logo Nav</label>
          <input type="file" class="form-control bg-dark text-white border-secondary shadow-sm" name="logo_nav">
          @if (!empty($profile->logo_nav))
            <img src="{{ asset('storage/'.$profile->logo_nav) }}" alt="Logo Nav" width="80" class="mt-2 rounded shadow-sm border border-secondary">
          @endif
        </div>
        <div class="col-md-4">
          <label class="form-label text-white">Logo Footer</label>
          <input type="file" class="form-control bg-dark text-white border-secondary shadow-sm" name="logo_footer">
          @if (!empty($profile->logo_footer))
            <img src="{{ asset('storage/'.$profile->logo_footer) }}" alt="Logo Footer" width="80" class="mt-2 rounded shadow-sm border border-secondary">
          @endif
        </div>
        <div class="col-md-4">
          <label class="form-label text-white">Favicon</label>
          <input type="file" class="form-control bg-dark text-white border-secondary shadow-sm" name="favicon">
          @if (!empty($profile->favicon))
            <img src="{{ asset('storage/'.$profile->favicon) }}" alt="Favicon" width="40" class="mt-2 rounded shadow-sm border border-secondary">
          @endif
        </div>
      </div>

      {{-- Tanggal Berdiri --}}
      <div class="mb-3">
        <label class="form-label text-white">Tanggal Berdiri</label>
        <input 
          type="date" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="tanggal_berdiri"
          value="{{ old('tanggal_berdiri', $profile->tanggal_berdiri ?? '') }}">
      </div>

      {{-- Tombol Aksi --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-success fw-semibold shadow-sm px-4">
          <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
        <button type="reset" class="btn btn-warning fw-semibold shadow-sm px-4">
          <i class="fas fa-undo me-1"></i> Reset
        </button>

        <form action="{{ route('admin.settingprofile.identitas.destroy') }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger fw-semibold shadow-sm px-4">
            <i class="fas fa-trash-alt me-1"></i> Hapus
          </button>
        </form>
      </div>
    </form>
  </div>
</div>
@endsection
