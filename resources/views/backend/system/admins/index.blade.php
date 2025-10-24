@extends('layouts.backend')

@section('title', 'Tambah Admin')
@section('page-title', 'Tambah Admin')

@section('content')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-white">Kelola Admin</h4>
    <a href="{{ route('admin.system.admins.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Tambah
    </a>
  </div>

  <div class="card bg-dark text-white shadow border-0 p-4 rounded-4">
    <table class="table table-dark table-striped align-middle">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Password</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($admins as $admin)
        <tr>
          <td>{{ $admin->name }}</td>
          <td>{{ $admin->email }}</td>
          <td>********</td>
          <td>
            <a href="{{ route('admin.system.admins.edit', $admin->id) }}" class="btn btn-sm btn-success">Edit</a>
            <form action="{{ route('admin.system.admins.destroy', $admin->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus admin ini?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-3">
      {{ $admins->links() }}
    </div>
  </div>
</div>
@endsection
