@extends('layouts.backend')

@section('title', 'Setting Profile Perusahaan - Sosial Media')
@section('page-title', 'Setting Profile Perusahaan')
@section('breadcrumb', 'Setting / Profile Perusahaan / Sosial Media')

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
    <form action="{{ route('admin.settingprofile.sosial.store') }}" method="POST">
      @csrf

      <h5 class="text-white fw-semibold mb-3">
        <i class="fas fa-hashtag me-2"></i> Sosial Media
      </h5>

      {{-- Facebook --}}
      <div class="mb-3">
        <label class="form-label text-white"><i class="fab fa-facebook me-1 text-primary"></i> Facebook</label>
        <input 
          type="url" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="facebook" 
          placeholder="https://facebook.com/yourpage"
          value="{{ old('facebook', $social->facebook ?? '') }}">
      </div>

      {{-- Instagram --}}
      <div class="mb-3">
        <label class="form-label text-white"><i class="fab fa-instagram me-1 text-pink"></i> Instagram</label>
        <input 
          type="url" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="instagram" 
          placeholder="https://instagram.com/yourpage"
          value="{{ old('instagram', $social->instagram ?? '') }}">
      </div>

      {{-- TikTok --}}
      <div class="mb-3">
        <label class="form-label text-white"><i class="fab fa-tiktok me-1 text-light"></i> TikTok</label>
        <input 
          type="url" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="tiktok" 
          placeholder="https://tiktok.com/@yourpage"
          value="{{ old('tiktok', $social->tiktok ?? '') }}">
      </div>

      {{-- YouTube --}}
      <div class="mb-3">
        <label class="form-label text-white"><i class="fab fa-youtube me-1 text-danger"></i> YouTube</label>
        <input 
          type="url" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="youtube" 
          placeholder="https://youtube.com/yourchannel"
          value="{{ old('youtube', $social->youtube ?? '') }}">
      </div>

      {{-- WhatsApp --}}
      <div class="mb-3">
        <label class="form-label text-white"><i class="fab fa-whatsapp me-1 text-success"></i> WhatsApp</label>
        <input 
          type="url" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="whatsapp" 
          placeholder="https://wa.me/6281234567890"
          value="{{ old('whatsapp', $social->whatsapp ?? '') }}">
      </div>

      {{-- Tombol Aksi --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-success fw-semibold shadow-sm px-4">
          <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>

        <button type="reset" class="btn btn-warning fw-semibold shadow-sm px-4">
          <i class="fas fa-undo me-1"></i> Reset
        </button>

        <form action="{{ route('admin.settingprofile.sosial.destroy') }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus semua link sosial media ini?')">
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
