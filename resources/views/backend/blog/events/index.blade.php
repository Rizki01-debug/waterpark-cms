@extends('layouts.backend')

@section('title', 'Events')
@section('page-title', 'Events')
@section('breadcrumb', 'Blog / Events')

@section('content')
<div class="container-fluid py-4">

  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-white"><i class="fas fa-calendar-alt me-2"></i> Daftar Event</h4>
    <a href="{{ route('admin.blog.events.create') }}" class="btn btn-danger fw-semibold shadow-sm">
      <i class="fas fa-plus me-1"></i> Tambah
    </a>
  </div>

  {{-- Alert Sukses --}}
  @if (session('success'))
    <div class="alert alert-success shadow-sm fw-semibold">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
  @endif

  {{-- Card Container --}}
  <div class="card bg-dark border-0 shadow-sm rounded-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-white mb-0">
          <thead class="bg-secondary bg-opacity-25 text-white">
            <tr>
              <th>#</th>
              <th>Judul</th>
              <th>Gambar</th>
              <th>Lokasi</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Penulis</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($events as $key => $event)
              <tr class="align-middle">
                <td>{{ $events->firstItem() + $key }}</td>
                <td class="fw-semibold">{{ $event->judul }}</td>
                <td>
                  @if ($event->gambar)
                    <img src="{{ asset('storage/'.$event->gambar) }}" alt="gambar" width="70" class="rounded shadow-sm">
                  @else
                    <div class="bg-secondary bg-opacity-25 text-center text-muted rounded py-2" style="width:70px;">No Img</div>
                  @endif
                </td>
                <td class="text-info fw-semibold">{{ $event->lokasi }}</td>
                <td class="text-white-50">
                  {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}
                </td>
                <td>
                  @if ($event->status == 'Publish')
                    <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">Publish</span>
                  @else
                    <span class="badge bg-secondary px-3 py-2 rounded-pill shadow-sm">Draft</span>
                  @endif
                </td>
                <td class="text-white-50">{{ $event->penulis }}</td>
                <td class="text-center">
                  <a href="{{ route('admin.blog.events.edit', $event->id) }}" class="btn btn-warning btn-sm me-1 text-dark fw-semibold">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.blog.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus event ini?')">
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
                <td colspan="8" class="text-center py-5 text-muted">
                  Belum ada data event
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      <div class="mt-3 d-flex justify-content-end">
        {{ $events->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>
@endsection
