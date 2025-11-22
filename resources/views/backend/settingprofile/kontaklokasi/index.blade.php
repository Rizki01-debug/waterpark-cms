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

    {{-- Jika Belum Ada Data --}}
    @if(!$kontak)
        <div class="alert alert-warning text-dark fw-semibold shadow-sm border-0 rounded-3">
            <i class="fas fa-exclamation-circle me-2"></i> Belum ada data kontak & lokasi.
        </div>

    @else

    {{-- Card Kontak (Vertical Layout) --}}
    <div class="card bg-dark border-0 shadow-lg rounded-4 p-4">

        {{-- Alamat --}}
        <div class="row info-row">
            <div class="col-md-3 text-white-50 fw-semibold">Alamat</div>
            <div class="col-md-9 text-white">
                {{ $kontak->alamat }}
            </div>
        </div>

        {{-- Telepon --}}
        <div class="row info-row">
            <div class="col-md-3 text-white-50 fw-semibold">Telepon</div>
            <div class="col-md-9">
                <a href="tel:{{ $kontak->telepon }}" class="text-white text-decoration-none fw-semibold">
                    {{ $kontak->telepon }}
                </a>
            </div>
        </div>

        {{-- Email --}}
        <div class="row info-row">
            <div class="col-md-3 text-white-50 fw-semibold">Email</div>
            <div class="col-md-9">
                <a href="mailto:{{ $kontak->email }}" class="text-info text-decoration-none fw-semibold">
                    {{ $kontak->email }}
                </a>
            </div>
        </div>

        {{-- Jam Operasional --}}
        <div class="row info-row">
            <div class="col-md-3 text-white-50 fw-semibold">Jam Operasional</div>
            <div class="col-md-9 text-white fw-semibold">
                {{ $kontak->jam_operasional }}
            </div>
        </div>

        {{-- Google Maps --}}
        <div class="row info-row">
            <div class="col-md-3 text-white-50 fw-semibold">Maps</div>
            <div class="col-md-9">
                @if ($kontak->google_maps)
                    <a href="{{ $kontak->google_maps }}" target="_blank"
                       class="btn btn-outline-info btn-sm fw-semibold shadow-sm rounded-pill px-3">
                        <i class="fas fa-map-marked-alt me-1"></i> Lihat Peta
                    </a>
                @else
                    <span class="text-muted fst-italic">Tidak ada link</span>
                @endif
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="text-end mt-3">
            <a href="{{ route('admin.settingprofile.kontak.edit', $kontak->id) }}"
               class="btn btn-warning fw-semibold shadow-sm me-2">
                <i class="fas fa-edit"></i> Edit
            </a>

            <form action="{{ route('admin.settingprofile.kontak.destroy', $kontak->id) }}"
                  method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                @csrf
                @method('DELETE')
                <button class="btn btn-danger fw-semibold shadow-sm">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    @endif
</div>


{{-- CSS Tambahan --}}
<style>
    .info-row {
        border-bottom: 1px solid rgba(255,255,255,0.08);
        padding-bottom: 14px;
        margin-bottom: 14px;
    }
    .info-row:last-child {
        border-bottom: none;
    }
</style>

@endsection
