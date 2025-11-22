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
            <i class="fas fa-share-alt text-danger me-2"></i> Sosial Media
        </h4>

        <a href="{{ route('admin.settingprofile.sosial.create') }}" class="btn btn-danger fw-semibold shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Data
        </a>
    </div>

    {{-- Jika data belum ada --}}
    @if(!$social)
        <div class="alert alert-warning text-dark fw-semibold shadow-sm border-0 rounded-3">
            <i class="fas fa-exclamation-circle me-2"></i> Belum ada data sosial media.
        </div>

    @else

    {{-- Card Sosial Media --}}
    <div class="card bg-dark border-0 shadow-lg rounded-4 p-4">

        {{-- Instagram --}}
        <div class="row social-row">
            <div class="col-md-3 text-white-50 fw-semibold">
                <i class="fab fa-instagram text-danger me-1"></i> Instagram
            </div>
            <div class="col-md-9">
                @if($social->instagram)
                    <a href="{{ $social->instagram }}" target="_blank" class="text-info text-decoration-none fw-semibold">
                        {{ $social->instagram }}
                    </a>
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </div>
        </div>

        {{-- Facebook --}}
        <div class="row social-row">
            <div class="col-md-3 text-white-50 fw-semibold">
                <i class="fab fa-facebook text-primary me-1"></i> Facebook
            </div>
            <div class="col-md-9">
                @if($social->facebook)
                    <a href="{{ $social->facebook }}" target="_blank" class="text-info text-decoration-none fw-semibold">
                        {{ $social->facebook }}
                    </a>
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </div>
        </div>

        {{-- TikTok --}}
        <div class="row social-row">
            <div class="col-md-3 text-white-50 fw-semibold">
                <i class="fab fa-tiktok text-white me-1"></i> TikTok
            </div>
            <div class="col-md-9">
                @if($social->tiktok)
                    <a href="{{ $social->tiktok }}" target="_blank" class="text-info text-decoration-none fw-semibold">
                        {{ $social->tiktok }}
                    </a>
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </div>
        </div>

        {{-- YouTube --}}
        <div class="row social-row">
            <div class="col-md-3 text-white-50 fw-semibold">
                <i class="fab fa-youtube text-danger me-1"></i> YouTube
            </div>
            <div class="col-md-9">
                @if($social->youtube)
                    <a href="{{ $social->youtube }}" target="_blank" class="text-info text-decoration-none fw-semibold">
                        {{ $social->youtube }}
                    </a>
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="text-end mt-4">
            <a href="{{ route('admin.settingprofile.sosial.edit', $social->id) }}"
               class="btn btn-warning fw-semibold text-dark shadow-sm me-2">
                <i class="fas fa-edit"></i> Edit
            </a>

            <form action="{{ route('admin.settingprofile.sosial.destroy', $social->id) }}"
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

{{-- CSS --}}
<style>
    .social-row {
        padding-bottom: 14px;
        margin-bottom: 14px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    .social-row:last-child {
        border-bottom: none;
    }
</style>

@endsection
