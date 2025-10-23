@extends('layouts.backend')
@section('title', 'News')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-white">News</h4>
        <a href="{{ route('admin.blog.news.create') }}" class="btn btn-primary">Tambah Berita</a>
    </div>

    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Penulis</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $n)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $n->judul }}</td>
                <td>{{ $n->kategori }}</td>
                <td>{!! $n->status == 'Publish' ? '<span class="badge bg-success">Publish</span>' : '<span class="badge bg-secondary">Draft</span>' !!}</td>
                <td>{{ $n->penulis }}</td>
                <td>{{ $n->tanggal ? \Carbon\Carbon::parse($n->tanggal)->format('d M Y') : '-' }}</td>
                <td>
                    <a href="{{ route('admin.blog.news.edit', $n->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.blog.news.destroy', $n->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $news->links() }}
</div>
@endsection
