@extends('layouts.backend')

@section('title', 'Akun User')
@section('page-title', 'Akun User')
@section('breadcrumb', 'Akun User')

@section('content')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="text-white fw-bold">Akun User</h4>
    <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
      <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Search...">
      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
    </form>
  </div>

  <div class="card border-0 shadow-lg rounded-4">
    <div class="card-body">
      <table class="table table-dark table-hover align-middle">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>ID Akun</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->id }}</td>
            <td>
              <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm {{ $user->status === 'Aktif' ? 'btn-success' : 'btn-warning' }}">
                  {{ $user->status }}
                </button>
              </form>
            </td>
            <td class="text-center">
              <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center text-muted">Tidak ada data user.</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      <div class="mt-3">
        {{ $users->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
