@extends('layouts.backend')

@section('title', 'Reguler Tiket')
@section('page-title', 'Reguler Tiket')
@section('breadcrumb', 'Reservasi / Reguler Tiket')

@section('content')
<div class="container-fluid py-4">

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('admin.reservasi.reguler.create') }}" class="btn btn-primary">
      <i class="fas fa-plus me-2"></i>Tambah
    </a>
    <form class="d-flex" style="max-width: 250px;">
      <input type="text" class="form-control form-control-sm" placeholder="Search">
      <button class="btn btn-sm btn-dark ms-2"><i class="fas fa-search"></i></button>
    </form>
  </div>

  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <table class="table align-middle table-hover">
        <thead class="table-dark">
          <tr>
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
            <td>{{ $item->nama_paket }}</td>
            <td><img src="{{ asset('storage/'.$item->gambar) }}" width="60"></td>
            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->diskon, 0, ',', '.') }}</td>
            <td>
              <span class="badge bg-{{ $item->status ? 'success' : 'secondary' }}">
                {{ $item->status ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td>
              <a href="{{ route('admin.reservasi.reguler.edit', $item->id) }}" class="btn btn-sm btn-warning">
                Edit
              </a>
              <form action="{{ route('admin.reservasi.reguler.destroy', $item->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus tiket ini?')">Hapus</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center text-muted py-4">Belum ada data tiket reguler.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <div class="d-flex justify-content-center mt-3">
        {{ $tiket->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>
@endsection
