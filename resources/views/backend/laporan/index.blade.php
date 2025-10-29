@extends('layouts.backend')
@section('title', 'Laporan')
@section('page-title', 'Laporan')

@section('content')
<div class="container-fluid py-4">

  {{-- ================= FILTER & EXPORT ================= --}}
  <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">

    {{-- FORM FILTER --}}
    <form action="{{ route('admin.admin.laporan.index') }}" method="GET" class="row g-3 align-items-end flex-grow-1 me-3">

      {{-- Kategori --}}
      <div class="col-md-3">
        <label for="kategori" class="form-label text-white fw-semibold">Kategori</label>
        <select name="kategori" id="kategori" class="form-select bg-dark text-white border-secondary">
          <option value="">Semua</option>
          <option value="tiket" {{ request('kategori') == 'tiket' ? 'selected' : '' }}>Tiket</option>
          <option value="penginapan" {{ request('kategori') == 'penginapan' ? 'selected' : '' }}>Penginapan</option>
        </select>
      </div>

      {{-- Dari Tanggal --}}
      <div class="col-md-3">
        <label for="start_date" class="form-label text-white fw-semibold">Dari Tanggal</label>
        <input type="date" name="start_date" id="start_date"
               value="{{ request('start_date', \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')) }}"
               class="form-control bg-dark text-white border-secondary">
      </div>

      {{-- Sampai Tanggal --}}
      <div class="col-md-3">
        <label for="end_date" class="form-label text-white fw-semibold">Sampai Tanggal</label>
        <input type="date" name="end_date" id="end_date"
               value="{{ request('end_date', \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')) }}"
               class="form-control bg-dark text-white border-secondary">
      </div>

      {{-- Status --}}
      <div class="col-md-2">
        <label for="status" class="form-label text-white fw-semibold">Status</label>
        <select name="status" id="status" class="form-select bg-dark text-white border-secondary">
          <option value="">Semua</option>
          <option value="Konfirmasi" {{ request('status') == 'Konfirmasi' ? 'selected' : '' }}>Konfirmasi</option>
          <option value="Berhasil" {{ request('status') == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
          <option value="Batal" {{ request('status') == 'Batal' ? 'selected' : '' }}>Batal</option>
        </select>
      </div>

      {{-- Tombol Filter --}}
      <div class="col-md-1 d-flex align-items-end">
        <button type="submit" class="btn btn-danger fw-semibold w-100 py-2">
          <i class="fas fa-search me-1"></i> Tampilkan
        </button>
      </div>
    </form>

    {{-- TOMBOL EXPORT --}}
    <div class="dropdown mt-3 mt-md-0">
      <button class="btn btn-outline-light fw-semibold dropdown-toggle py-2 px-3" data-bs-toggle="dropdown">
        <i class="fas fa-download me-1"></i> Export
      </button>
      <ul class="dropdown-menu dropdown-menu-dark">
        <li>
          <a class="dropdown-item"
             href="{{ route('admin.admin.laporan.export.pdf', [
                'kategori' => request('kategori'),
                'start_date' => request('start_date'),
                'end_date' => request('end_date'),
                'status' => request('status')
             ]) }}">
            <i class="fas fa-file-pdf me-2 text-danger"></i> Export PDF
          </a>
        </li>
        <li>
          <a class="dropdown-item"
             href="{{ route('admin.admin.laporan.export.excel', [
                'kategori' => request('kategori'),
                'start_date' => request('start_date'),
                'end_date' => request('end_date'),
                'status' => request('status')
             ]) }}">
            <i class="fas fa-file-excel me-2 text-success"></i> Export Excel
          </a>
        </li>
      </ul>
    </div>
  </div>

  {{-- ================= STATISTIK ================= --}}
  <div class="row g-3 mb-4">
    @php
      $cards = [
        ['label' => 'Profit', 'value' => 'Rp ' . number_format($totalProfit, 0, ',', '.'), 'icon' => 'fa-wallet', 'color' => 'success'],
        ['label' => 'Tiket Terjual', 'value' => $totalTiket, 'icon' => 'fa-ticket-alt', 'color' => 'info'],
        ['label' => 'Penginapan', 'value' => $totalPenginapan, 'icon' => 'fa-bed', 'color' => 'warning'],
        ['label' => 'Pengunjung', 'value' => $totalPengunjung, 'icon' => 'fa-users', 'color' => 'primary'],
      ];
    @endphp

    @foreach ($cards as $card)
      <div class="col-md-3">
        <div class="card bg-dark border-0 shadow-sm rounded-4 p-3">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-white-50 mb-1">{{ $card['label'] }}</h6>
              <h4 class="fw-bold text-white mb-0">{{ $card['value'] }}</h4>
            </div>
            <div class="bg-{{ $card['color'] }} bg-opacity-25 p-2 rounded-3">
              <i class="fas {{ $card['icon'] }} text-{{ $card['color'] }} fs-5"></i>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- ================= GRAFIK & TRANSAKSI ================= --}}
  <div class="row">
    {{-- Grafik Profit --}}
    <div class="col-md-6 mb-4">
      <div class="card bg-dark border-0 shadow-lg rounded-4 p-3">
        <h6 class="text-white fw-semibold mb-3">
          <i class="fas fa-chart-line me-2 text-info"></i> Grafik Profit
        </h6>
        <canvas id="profitChart" height="180"></canvas>
      </div>
    </div>

    {{-- Detail Transaksi --}}
    <div class="col-md-6 mb-4">
      <div class="card bg-dark border-0 shadow-lg rounded-4 p-3">
        <h6 class="text-white fw-semibold mb-3">
          <i class="fas fa-list me-2 text-warning"></i> Detail Transaksi
        </h6>
        <div class="table-responsive">
          <table class="table table-dark table-hover align-middle mb-0">
            <thead class="bg-secondary bg-opacity-25">
              <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Jenis</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($transaksi as $i => $t)
                <tr>
                  <td>{{ $i + 1 }}</td>
                  <td>{{ $t->nama_pemesan }}</td>
                  <td>{{ ucfirst($t->jenis) }}</td>
                  <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                  <td>
                    @if($t->status == 'Berhasil')
                      <span class="badge bg-success px-3 py-2">Berhasil</span>
                    @elseif($t->status == 'Batal')
                      <span class="badge bg-danger px-3 py-2">Batal</span>
                    @else
                      <span class="badge bg-warning text-dark px-3 py-2">Konfirmasi</span>
                    @endif
                  </td>
                  <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d-m-Y') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted py-4">Tidak ada transaksi dalam periode ini.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

{{-- ================= SCRIPT GRAFIK ================= --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('profitChart').getContext('2d');
  const chartData = @json($chartData);
  const labels = chartData.map(d => d.tanggal);
  const data = chartData.map(d => d.total_profit);

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Profit Harian',
        data: data,
        borderColor: '#4f9aff',
        backgroundColor: 'rgba(79, 154, 255, 0.2)',
        fill: true,
        tension: 0.3,
        pointBackgroundColor: '#4f9aff',
        pointRadius: 4
      }]
    },
    options: {
      scales: {
        x: { ticks: { color: '#fff' } },
        y: { ticks: { color: '#fff' } }
      },
      plugins: { legend: { labels: { color: '#fff' } } }
    }
  });
</script>
@endpush
@endsection
