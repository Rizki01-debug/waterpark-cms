@extends('layouts.backend')

@section('title', 'Reguler Tiket')

@section('content')
<div class="container py-4">
  <div class="card bg-gray-900 border-0 shadow-lg rounded-3 p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="text-white mb-0">Daftar Tiket Reguler</h4>
      <a href="{{ route('admin.reservasi.reguler.create') }}" class="btn btn-danger fw-bold">
        + TAMBAH TIKET
      </a>
    </div>

    @if(session('success'))
      <div class="alert alert-success text-dark fw-semibold">
        {{ session('success') }}
      </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
      <form class="d-flex" style="max-width: 250px;">
        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Cari tiket...">
        <button class="btn btn-sm btn-light ms-2"><i class="fas fa-search"></i></button>
      </form>
    </div>

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
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tiket as $item)
            <tr>
              <td>{{ $loop->iteration + ($tiket->currentPage() - 1) * $tiket->perPage() }}</td>
              <td class="fw-semibold text-white">{{ $item->nama_paket }}</td>
              <td>
                @if($item->gambar)
                  <img src="{{ asset('storage/'.$item->gambar) }}" width="70" class="rounded-2 shadow-sm" alt="gambar tiket">
                @else
                  <span class="text-muted">Tidak ada</span>
                @endif
              </td>
              <td>{{ Str::limit($item->deskripsi, 60) }}</td>
              <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($item->diskon, 0, ',', '.') }}</td>
              <td>
                @if($item->status)
                  <span class="badge bg-success px-3 py-2">AKTIF</span>
                @else
                  <span class="badge bg-secondary px-3 py-2">NONAKTIF</span>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.reservasi.reguler.edit', $item->id) }}" class="btn btn-warning btn-sm text-dark fw-bold">
                  EDIT
                </a>
                <form action="{{ route('admin.reservasi.reguler.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus tiket ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm fw-bold">HAPUS</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted py-4">Belum ada data tiket reguler.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end mt-3">
      {{ $tiket->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
