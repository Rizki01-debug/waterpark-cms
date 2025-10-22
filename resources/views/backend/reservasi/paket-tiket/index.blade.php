@extends('layouts.backend')

@section('title', 'Paket Tiket')

@section('content')
<div class="container py-4">
  <div class="card bg-gray-900 border-0 shadow-lg rounded-3 p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-white fw-semibold mb-0">Daftar Paket Tiket</h4>
      <a href="{{ route('admin.reservasi.paket.create') }}" class="btn btn-danger fw-bold px-4">
        <i class="fas fa-plus me-1"></i> TAMBAH PAKET
      </a>
    </div>

    {{-- Alert sukses --}}
    @if (session('success'))
      <div class="alert alert-success text-dark fw-semibold shadow-sm border-0">
        {{ session('success') }}
      </div>
    @endif

    {{-- Search bar --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
      <form class="d-flex" style="max-width: 280px;">
        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Cari paket...">
        <button class="btn btn-sm btn-outline-light ms-2">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>

    {{-- Tabel data --}}
    <div class="table-responsive">
      <table class="table table-dark table-hover align-middle rounded">
        <thead class="bg-dark text-white">
          <tr>
            <th>#</th>
            <th>Nama Paket</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($paket as $key => $item)
            <tr>
              <td>{{ $paket->firstItem() + $key }}</td>
              <td class="fw-semibold text-white">{{ $item->nama_paket }}</td>
              <td>
                @if ($item->gambar)
                  <img src="{{ asset('storage/' . $item->gambar) }}" alt="gambar" width="75" class="rounded-2 shadow-sm border border-secondary">
                @else
                  <span class="text-muted">Tidak ada</span>
                @endif
              </td>
              <td>{{ Str::limit($item->deskripsi, 60) }}</td>
              <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($item->diskon, 0, ',', '.') }}</td>
              <td>
                @if ($item->status)
                  <span class="badge bg-success px-3 py-2">AKTIF</span>
                @else
                  <span class="badge bg-secondary px-3 py-2">NONAKTIF</span>
                @endif
              </td>
              <td class="text-center">
                <a href="{{ route('admin.reservasi.paket.edit', $item->id) }}" 
                   class="btn btn-warning btn-sm text-dark fw-bold me-1 px-3">
                  <i class="fas fa-edit me-1"></i> EDIT
                </a>
                <form action="{{ route('admin.reservasi.paket.destroy', $item->id) }}" 
                      method="POST" class="d-inline" 
                      onsubmit="return confirm('Yakin hapus paket ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm fw-bold px-3">
                    <i class="fas fa-trash-alt me-1"></i> HAPUS
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted py-4">Belum ada data paket tiket</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end mt-3">
      {{ $paket->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
