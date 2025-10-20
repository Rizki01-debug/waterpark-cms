@extends('layouts.backend')

@section('title', 'Daftar Fasilitas')

@section('content')
<div class="container py-4">
  <div class="card bg-gray-900 border-0 shadow-lg rounded-3 p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="text-white mb-0">Daftar Fasilitas</h4>
      <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-danger fw-bold">+ TAMBAH FASILITAS</a>
    </div>

    @if(session('success'))
      <div class="alert alert-success text-dark fw-semibold">
        {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive">
      <table class="table table-dark table-hover align-middle rounded">
        <thead class="bg-dark text-white">
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($fasilitas as $f)
            <tr>
              <td>{{ $loop->iteration + ($fasilitas->currentPage() - 1) * $fasilitas->perPage() }}</td>
              <td class="fw-semibold text-white">{{ $f->nama ?? '-' }}</td>
              <td>
                @if($f->gambar)
                  <img src="{{ asset('storage/'.$f->gambar) }}" width="80" class="rounded-2 shadow-sm" alt="">
                @else
                  <span class="text-muted">Tidak ada</span>
                @endif
              </td>
              <td>
                @if($f->status)
                  <span class="badge bg-success px-3 py-2">AKTIF</span>
                @else
                  <span class="badge bg-secondary px-3 py-2">NONAKTIF</span>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.fasilitas.edit', $f->id) }}" class="btn btn-warning btn-sm text-dark fw-bold">EDIT</a>
                <form action="{{ route('admin.fasilitas.destroy', $f->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus fasilitas ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm fw-bold">HAPUS</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-muted py-4">Belum ada data fasilitas</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end mt-3">
      {{ $fasilitas->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
