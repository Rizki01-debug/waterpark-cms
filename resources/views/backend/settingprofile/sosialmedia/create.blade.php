@extends('layouts.backend')
@section('title', 'Setting Profile Perusahaan - Tambah Sosial Media')
@section('page-title', 'Setting Profile Perusahaan')
@section('breadcrumb', 'Setting / Profile Perusahaan / Tambah Sosial Media')

@section('content')
<div class="container-fluid py-4">

  {{-- Navigation Tabs --}}
  <div class="d-flex mb-4">
    <a href="{{ route('admin.settingprofile.identitas.index') }}" class="btn btn-outline-light fw-semibold shadow-sm me-2">
      <i class="fas fa-id-card me-1"></i> Identitas Dasar
    </a>
    <a href="{{ route('admin.settingprofile.kontak.index') }}" class="btn btn-outline-light fw-semibold shadow-sm me-2">
      <i class="fas fa-map-marker-alt me-1"></i> Kontak & Lokasi
    </a>
    <a href="{{ route('admin.settingprofile.sosial.index') }}" class="btn btn-danger fw-semibold shadow-sm">
      <i class="fas fa-share-alt me-1"></i> Sosial Media
    </a>
  </div>

  {{-- Card Form --}}
  <div class="card bg-dark border-0 shadow-lg rounded-4 p-4">
    <h5 class="text-white fw-semibold mb-4">
      <i class="fas fa-plus-circle me-2"></i> Tambah Sosial Media
    </h5>

    {{-- Form Input --}}
    <form action="{{ route('admin.settingprofile.sosial.store') }}" method="POST">
      @csrf
      @include('backend.settingprofile.sosialmedia.form')

      {{-- Tombol Aksi --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-success fw-semibold shadow-sm px-4">
          <i class="fas fa-save me-1"></i> Simpan
        </button>
        <a href="{{ route('admin.settingprofile.sosial.index') }}" class="btn btn-outline-light fw-semibold shadow-sm px-4">
          <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
