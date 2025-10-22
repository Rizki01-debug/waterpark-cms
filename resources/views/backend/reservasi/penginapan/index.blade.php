@extends('layouts.backend')

@section('title', 'Reservasi Penginapan')
@section('page-title', 'Penginapan')
@section('breadcrumb', 'Penginapan')

@section('content')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-white"><i class="fas fa-bed me-2"></i> Daftar Penginapan</h4>
    <a href="{{ route('admin.reservasi.penginapan.create') }}" class="btn btn-danger fw-semibold shadow-sm">
      <i class="fas fa-plus me-1"></i> Tambah
    </a>
  </div>

  {{-- Alert Success --}}
  @if (session('success'))
    <div class="alert alert-success shadow-sm fw-semibold">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
  @endif

  {{-- Table Container --}}
  <div class="card bg-dark border-0 shadow-sm rounded-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-white mb-0">
          <thead class="bg-secondary bg-opacity-25 text-white">
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
            @forelse ($penginapan as $key => $item)
              <tr class="align-middle">
                <td>{{ $penginapan->firstItem() + $key }}</td>
                <td class="fw-semibold">{{ $item->nama_paket }}</td>
                <td>
                  @if ($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="gambar" width="70" class="rounded shadow-sm">
                  @else
                    <div class="bg-secondary bg-opacity-25 text-center text-muted rounded py-2" style="width:70px;">No Img</div>
                  @endif
                </td>
                <td class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->diskon, 0, ',', '.') }}</td>
                <td>
                  @if ($item->status)
                    <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">Aktif</span>
                  @else
                    <span class="badge bg-secondary px-3 py-2 rounded-pill shadow-sm">Nonaktif</span>
                  @endif
                </td>
                <td class="text-center">
                  <a href="{{ route('admin.reservasi.penginapan.edit', $item->id) }}" class="btn btn-warning btn-sm me-1 text-dark fw-semibold">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.reservasi.penginapan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm fw-semibold">
                      <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center py-5 text-muted">Belum ada data penginapan</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      <div class="mt-3 d-flex justify-content-end">
        {{ $penginapan->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>
@endsection
