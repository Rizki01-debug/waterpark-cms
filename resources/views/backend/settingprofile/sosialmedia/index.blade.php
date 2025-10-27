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

  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-white">
      <i class="fas fa-share-alt me-2 text-danger"></i> Sosial Media
    </h4>
    <a href="{{ route('admin.settingprofile.sosial.create') }}" class="btn btn-danger fw-semibold shadow-sm">
      <i class="fas fa-plus me-1"></i> Tambah Data
    </a>
  </div>

  {{-- Alert jika belum ada data --}}
  @if(!$social)
    <div class="alert alert-warning text-dark fw-semibold shadow-sm border-0 rounded-3">
      <i class="fas fa-exclamation-circle me-2"></i> Belum ada data sosial media.
    </div>
  @else
    {{-- Card Sosial Media --}}
    <div class="card bg-dark border-0 shadow-lg rounded-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle text-white mb-0">
            <thead class="bg-secondary bg-opacity-25 text-white">
              <tr>
                <th><i class="fab fa-instagram me-1 text-danger"></i> Instagram</th>
                <th><i class="fab fa-facebook me-1 text-primary"></i> Facebook</th>
                <th><i class="fab fa-tiktok me-1 text-light"></i> TikTok</th>
                <th><i class="fab fa-youtube me-1 text-danger"></i> YouTube</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  @if($social->instagram)
                    <a href="{{ $social->instagram }}" target="_blank" class="text-info text-decoration-none">
                      {{ Str::limit($social->instagram, 40) }}
                    </a>
                  @else
                    <span class="text-muted">Tidak ada</span>
                  @endif
                </td>
                <td>
                  @if($social->facebook)
                    <a href="{{ $social->facebook }}" target="_blank" class="text-info text-decoration-none">
                      {{ Str::limit($social->facebook, 40) }}
                    </a>
                  @else
                    <span class="text-muted">Tidak ada</span>
                  @endif
                </td>
                <td>
                  @if($social->tiktok)
                    <a href="{{ $social->tiktok }}" target="_blank" class="text-info text-decoration-none">
                      {{ Str::limit($social->tiktok, 40) }}
                    </a>
                  @else
                    <span class="text-muted">Tidak ada</span>
                  @endif
                </td>
                <td>
                  @if($social->youtube)
                    <a href="{{ $social->youtube }}" target="_blank" class="text-info text-decoration-none">
                      {{ Str::limit($social->youtube, 40) }}
                    </a>
                  @else
                    <span class="text-muted">Tidak ada</span>
                  @endif
                </td>
                <td class="text-center">
                  <a href="{{ route('admin.settingprofile.sosial.edit', $social->id) }}" 
                     class="btn btn-warning btn-sm text-dark fw-semibold shadow-sm me-1">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.settingprofile.sosial.destroy', $social->id) }}" 
                        method="POST" 
                        class="d-inline" 
                        onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm fw-semibold shadow-sm">
                      <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection
