@extends('layouts.backend')
@section('title', 'Daftar Email Newsletter')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
  <div class="card-body">
    <h5 class="fw-bold mb-3">Daftar Email Newsletter</h5>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped align-middle">
      <thead class="table-warning">
        <tr>
          <th>#</th>
          <th>Email</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($emails as $index => $email)
          <tr>
            <td>{{ $emails->firstItem() + $index }}</td>
            <td>{{ $email->email }}</td>
            <td>{{ $email->created_at->format('d M Y H:i') }}</td>
            <td>
              <form action="{{ route('admin.newsletter.destroy', $email->id) }}" method="POST">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus email ini?')">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center text-muted">Belum ada email yang berlangganan.</td></tr>
        @endforelse
      </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
      {{ $emails->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
