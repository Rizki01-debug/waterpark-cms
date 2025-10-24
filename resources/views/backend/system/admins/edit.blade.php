@extends('layouts.backend')

@section('title', 'Edit Admin')
@section('page-title', 'Edit Admin')

@section('content')
<div class="container-fluid py-4">
  <div class="card bg-dark text-white shadow border-0 p-4 rounded-4">
    <h4 class="fw-bold mb-4">Edit Admin: {{ $admin->name }}</h4>

    <form action="{{ route('admin.system.admins.update', $admin->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" value="{{ $admin->name }}" class="form-control bg-dark text-white" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ $admin->email }}" class="form-control bg-dark text-white" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password Baru (Opsional)</label>
        <input type="password" name="password" class="form-control bg-dark text-white">
      </div>

      <div class="mt-3 d-flex gap-2">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.system.admins.index') }}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
  </div>
</div>
@endsection
