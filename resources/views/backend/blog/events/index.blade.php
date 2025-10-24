@extends('layouts.backend')

@section('title', 'Events')
@section('page-title', 'Events')

@section('content')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-white">Daftar Event</h4>
    <a href="{{ route('admin.blog.events.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
  </div>

  <div class="card bg-dark text-white border-0 shadow p-4">
    <table class="table table-dark table-striped align-middle">
      <thead>
        <tr>
          <th>Judul</th>
          <th>Gambar</th>
          <th>Lokasi</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Penulis</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($events as $event)
        <tr>
          <td>{{ $event->judul }}</td>
          <td>
            @if($event->gambar)
              <img src="{{ asset('storage/'.$event->gambar) }}" width="80" class="rounded">
            @endif
          </td>
          <td>{{ $event->lokasi }}</td>
          <td>{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}</td>
          <td>
            <span class="badge {{ $event->status == 'Publish' ? 'bg-success' : 'bg-secondary' }}">
              {{ $event->status }}
            </span>
          </td>
          <td>{{ $event->penulis }}</td>
          <td>
            <a href="{{ route('admin.blog.events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.blog.events.destroy', $event->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus event ini?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-3">
      {{ $events->links() }}
    </div>
  </div>
</div>
@endsection
