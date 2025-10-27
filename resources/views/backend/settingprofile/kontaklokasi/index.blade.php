@extends('layouts.backend')

@section('title', 'Setting Profile Perusahaan - Kontak & Lokasi')
@section('page-title', 'Setting Profile Perusahaan')
@section('breadcrumb', 'Setting / Profile Perusahaan / Kontak & Lokasi')

@section('content')
<div class="container-fluid py-4">

  {{-- Navigation Tabs --}}
  <div class="d-flex mb-4">
    <a href="{{ route('admin.settingprofile.identitas.index') }}" class="btn btn-outline-light fw-semibold shadow-sm me-2">
      <i class="fas fa-id-card me-1"></i> Identitas Dasar
    </a>
    <a href="{{ route('admin.settingprofile.kontak.index') }}" class="btn btn-danger fw-semibold shadow-sm me-2">
      <i class="fas fa-map-marker-alt me-1"></i> Kontak & Lokasi
    </a>
    <a href="{{ route('admin.settingprofile.sosial.index') }}" class="btn btn-outline-light fw-semibold shadow-sm">
      <i class="fas fa-share-alt me-1"></i> Sosial Media
    </a>
  </div>

  {{-- Card Form --}}
  <div class="card bg-dark border-0 shadow-lg rounded-4 p-4">
    <form action="{{ route('admin.settingprofile.kontak.store') }}" method="POST">
      @csrf

      <h5 class="text-white fw-semibold mb-3">
        <i class="fas fa-phone-alt me-2"></i> Kontak & Lokasi
      </h5>

      {{-- Alamat --}}
      <div class="mb-3">
        <label class="form-label text-white">Alamat Lengkap</label>
        <textarea 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="alamat" 
          rows="3"
          placeholder="Masukkan alamat lengkap perusahaan">{{ old('alamat', $contact->alamat ?? '') }}</textarea>
      </div>

      {{-- Nomor Telepon --}}
      <div class="mb-3">
        <label class="form-label text-white">Nomor Telepon</label>
        <input 
          type="text" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="telepon"
          placeholder="Contoh: 0812-3456-7890"
          value="{{ old('telepon', $contact->telepon ?? '') }}">
      </div>

      {{-- Email --}}
      <div class="mb-3">
        <label class="form-label text-white">Email</label>
        <input 
          type="email" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="email"
          placeholder="Contoh: info@embunpelangi.com"
          value="{{ old('email', $contact->email ?? '') }}">
      </div>

      {{-- Google Maps --}}
      <div class="mb-3">
        <label class="form-label text-white">Link Google Maps</label>
        <input 
          type="text" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="google_maps"
          placeholder="Tempelkan link lokasi Google Maps"
          value="{{ old('google_maps', $contact->google_maps ?? '') }}">
      </div>

      {{-- Jam Operasional --}}
      <div class="mb-3">
        <label class="form-label text-white">Jam Operasional</label>
        <input 
          type="text" 
          class="form-control bg-dark text-white border-secondary shadow-sm" 
          name="jam_operasional"
          placeholder="Contoh: Setiap Hari 08.00 - 17.00 WIB"
          value="{{ old('jam_operasional', $contact->jam_operasional ?? '') }}">
      </div>

      {{-- Tombol Aksi --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-success fw-semibold shadow-sm px-4">
          <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>

        <button type="reset" class="btn btn-warning fw-semibold shadow-sm px-4">
          <i class="fas fa-undo me-1"></i> Reset
        </button>

        <form action="{{ route('admin.settingprofile.kontak.destroy') }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
