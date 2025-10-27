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

  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-white">
      <i class="fas fa-map-marker-alt me-2 text-danger"></i> Kontak & Lokasi
    </h4>
    <a href="{{ route('admin.settingprofile.kontak.create') }}" class="btn btn-danger fw-semibold shadow-sm">
      <i class="fas fa-plus me-1"></i> Tambah Data
    </a>
  </div>

  {{-- Alert jika belum ada data --}}
  @if(!$kontak)
    <div class="alert alert-warning text-dark fw-semibold shadow-sm border-0 rounded-3">
      <i class="fas fa-exclamation-circle me-2"></i> Belum ada data kontak & lokasi.
    </div>
  @else
    {{-- Card Kontak --}}
    <div class="card bg-dark border-0 shadow-lg rounded-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle text-white mb-0">
            <thead class="bg-secondary bg-opacity-25 text-white">
              <tr>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Jam Operasional</th>
                <th class="text-center">Maps</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-muted">{{ $kontak->alamat }}</td>
                <td><a href="tel:{{ $kontak->telepon }}" class="text-white text-decoration-none">{{ $kontak->telepon }}</a></td>
                <td><a href="mailto:{{ $kontak->email }}" class="text-info text-decoration-none">{{ $kontak->email }}</a></td>
                <td class="fw-semibold">{{ $kontak->jam_operasional }}</td>
                <td class="text-center">
                  @if($kontak->google_maps)
                    <a href="{{ $kontak->google_maps }}" target="_blank" class="btn btn-outline-info btn-sm fw-semibold shadow-sm">
                      <i class="fas fa-map-marked-alt me-1"></i> Lihat Peta
                    </a>
                  @else
                    <span class="text-muted">Tidak ada link</span>
                  @endif
                </td>
                <td class="text-center">
                  <a href="{{ route('admin.settingprofile.kontak.edit', $kontak->id) }}" class="btn btn-warning btn-sm text-dark fw-semibold shadow-sm me-1">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.settingprofile.kontak.destroy', $kontak->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm fw-semibold shadow-sm">
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
