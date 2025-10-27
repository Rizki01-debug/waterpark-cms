@extends('layouts.backend')
@section('title', 'Setting Profile Perusahaan - Identitas Dasar')
@section('page-title', 'Setting Profile Perusahaan')
@section('breadcrumb', 'Setting / Profile Perusahaan / Identitas Dasar')

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

  {{-- Header Section --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-white fw-bold"><i class="fas fa-building me-2"></i> Identitas Dasar</h4>
    <a href="{{ route('admin.settingprofile.identitas.create') }}" class="btn btn-danger fw-semibold shadow-sm">
      <i class="fas fa-plus me-1"></i> Tambah Data
    </a>
  </div>

  {{-- Table Card --}}
  <div class="card bg-dark border-0 shadow-lg rounded-4 p-3">
    <div class="table-responsive">
      <table class="table table-hover align-middle text-white mb-0">
        <thead class="bg-secondary bg-opacity-25 text-white">
          <tr>
            <th>Nama</th>
            <th>Tagline</th>
            <th>Tanggal Berdiri</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($profiles as $profile)
            <tr>
              <td class="fw-semibold">{{ $profile->nama }}</td>
              <td class="text-muted">{{ $profile->tagline ?? '-' }}</td>
              <td>{{ $profile->tanggal_berdiri ? date('d M Y', strtotime($profile->tanggal_berdiri)) : '-' }}</td>
              <td class="text-center">
                <a href="{{ route('admin.settingprofile.identitas.edit', $profile->id) }}" class="btn btn-warning btn-sm text-dark fw-semibold shadow-sm me-1">
                  <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.settingprofile.identitas.destroy', $profile->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm fw-semibold shadow-sm">
                    <i class="fas fa-trash-alt"></i> Hapus
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted py-5">Belum ada data identitas perusahaan</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end mt-3">
      {{ $profiles->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
