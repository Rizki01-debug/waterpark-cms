@extends('layouts.backend')

@section('title', 'News')
@section('page-title', 'News')
@section('breadcrumb', 'Blog / News')

@section('content')
<div class="container-fluid py-4">

  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-white"><i class="fas fa-newspaper me-2"></i> Daftar Berita</h4>
    <a href="{{ route('admin.blog.news.create') }}" class="btn btn-danger fw-semibold shadow-sm">
      <i class="fas fa-plus me-1"></i> Tambah
    </a>
  </div>

  {{-- Alert Sukses --}}
  @if (session('success'))
    <div class="alert alert-success shadow-sm fw-semibold">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
  @endif

  {{-- Card Tabel --}}
  <div class="card bg-dark border-0 shadow-sm rounded-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-white mb-0">
          <thead class="bg-secondary bg-opacity-25 text-white">
            <tr>
              <th>#</th>
              <th>Judul</th>
              <th>Kategori</th>
              <th>Status</th>
              <th>Penulis</th>
              <th>Tanggal</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($news as $key => $n)
              <tr class="align-middle">
                <td>{{ $news->firstItem() + $key }}</td>
                <td class="fw-semibold">{{ $n->judul }}</td>
                <td><span class="text-info fw-semibold">{{ $n->kategori }}</span></td>
                <td>
                  @if ($n->status == 'Publish')
                    <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">Publish</span>
                  @else
                    <span class="badge bg-secondary px-3 py-2 rounded-pill shadow-sm">Draft</span>
                  @endif
                </td>
                <td class="text-white-50">{{ $n->penulis }}</td>
                <td class="text-white-50">
                  {{ $n->tanggal ? \Carbon\Carbon::parse($n->tanggal)->format('d M Y') : '-' }}
                </td>
                <td class="text-center">
                  <a href="{{ route('admin.blog.news.edit', $n->id) }}" 
                     class="btn btn-warning btn-sm me-1 text-dark fw-semibold">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.blog.news.destroy', $n->id) }}" 
                        method="POST" class="d-inline" 
                        onsubmit="return confirm('Hapus berita ini?')">
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
                <td colspan="7" class="text-center py-5 text-muted">
                  Belum ada data berita
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      <div class="mt-3 d-flex justify-content-end">
        {{ $news->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>
@endsection
