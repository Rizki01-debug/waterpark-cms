@extends('layouts.backend')

@section('title', 'Pemesanan')

@section('content')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-white">Pemesanan</h4>
    <div class="d-flex gap-2">
      <input type="text" class="form-control form-control-sm" placeholder="Search..." style="width: 200px;">
      <button class="btn btn-primary btn-sm">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div>

  <div class="card bg-dark text-light shadow-sm border-0">
    <div class="card-body table-responsive">
      <table class="table table-dark table-hover align-middle mb-0">
        <thead>
          <tr class="text-secondary">
            <th>#</th>
            <th>Nama Pemesan</th>
            <th>Bukti Pembayaran</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pemesanans as $pemesanan)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $pemesanan->nama_pemesan }}</td>
              <td>
                @if ($pemesanan->bukti_pembayaran)
                  <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                    data-bs-target="#buktiModal{{ $pemesanan->id }}">Lihat</button>

                  <!-- Modal Bukti Pembayaran -->
                  <div class="modal fade" id="buktiModal{{ $pemesanan->id }}" tabindex="-1"
                    aria-labelledby="buktiModalLabel{{ $pemesanan->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content bg-dark text-light border-secondary">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">Bukti Pembayaran - {{ $pemesanan->nama_pemesan }}</h5>
                          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                          <img src="{{ asset('storage/' . $pemesanan->bukti_pembayaran) }}"
                               alt="Bukti Pembayaran"
                               class="img-fluid rounded shadow">
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <span class="text-muted">Belum ada</span>
                @endif
              </td>

              <td>
                @if ($pemesanan->status === 'Konfirmasi')
                  <span class="badge bg-warning text-dark">Konfirmasi</span>
                @elseif ($pemesanan->status === 'Berhasil')
                  <span class="badge bg-success">Berhasil</span>
                @elseif ($pemesanan->status === 'Pending')
                  <span class="badge bg-secondary">Pending</span>
                @else
                  <span class="badge bg-danger">Batal</span>
                @endif
              </td>

              <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                  @if ($pemesanan->status === 'Pending' || $pemesanan->status === 'Konfirmasi')
                    {{-- ✅ Tombol Setujui --}}
                    <form method="POST" action="{{ route('admin.reservasi.pemesanan.updateStatus', $pemesanan->id) }}">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="status" value="Berhasil">
                      <button type="submit" class="btn btn-success btn-sm">
                        <i class="fas fa-check"></i> Setujui
                      </button>
                    </form>

                    {{-- ❌ Tombol Tolak --}}
                    <form method="POST" action="{{ route('admin.reservasi.pemesanan.updateStatus', $pemesanan->id) }}">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="status" value="Batal">
                      <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-times"></i> Tolak
                      </button>
                    </form>
                  @else
                    <button class="btn btn-secondary btn-sm" disabled>
                      <i class="fas fa-lock"></i> Selesai
                    </button>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-muted py-3">
                Belum ada data pemesanan
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
