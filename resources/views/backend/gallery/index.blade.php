@extends('layouts.backend')
@section('title', 'Galeri')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h3>Daftar Galeri</h3>
  <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">+ Tambah Gambar</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped align-middle">
  <thead class="table-dark">
    <tr>
      <th>No</th>
      <th>Gambar</th>
      <th>Judul</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($galleries as $i => $g)
      <tr>
        <td>{{ $i + $galleries->firstItem() }}</td>
        <td><img src="{{ asset('storage/' . $g->gambar) }}" width="80" class="rounded"></td>
        <td>{{ $g->judul ?? '-' }}</td>
        <td>
          <span class="badge {{ $g->status ? 'bg-success' : 'bg-secondary' }}">
            {{ $g->status ? 'Aktif' : 'Nonaktif' }}
          </span>
        </td>
        <td>
          <a href="{{ route('admin.gallery.edit', $g->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('admin.gallery.destroy', $g->id) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button onclick="return confirm('Hapus gambar ini?')" class="btn btn-danger btn-sm">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{ $galleries->links() }}
@endsection
