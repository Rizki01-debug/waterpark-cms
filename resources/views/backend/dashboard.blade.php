@extends('layouts.backend')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="row g-4">
  <!-- Stat Cards -->
  @php
    $stats = [
    [
      'value' => number_format($totalPengunjung), 
      'label' => 'Total Pengunjung', 
      'icon' => 'fas fa-users', 
      'color' => 'primary',
      'url' => route('admin.laporan.index')
    ],
    [
      'value' => $reservasiHariIni, 
      'label' => 'Reservasi Hari Ini', 
      'icon' => 'fas fa-calendar-check', 
      'color' => 'success',
      'url' => route('admin.reservasi.reguler.index')
    ],
    [
      'value' => $pendapatanBulanIni, 
      'label' => 'Pendapatan Bulan Ini', 
      'icon' => 'fas fa-chart-line', 
      'color' => 'warning',
      'url' => route('admin.laporan.index')
    ],
    [
      'value' => $fasilitasAktif, 
      'label' => 'Fasilitas Aktif', 
      'icon' => 'fas fa-umbrella-beach', 
      'color' => 'info',
      'url' => route('admin.fasilitas.index')
    ],
  ];
  @endphp

  @foreach ($stats as $stat)
    <div class="col-xl-3 col-md-6">
      <div class="card-material fade-in-up shadow-sm border-0 rounded-4">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h2 class="stat-number mb-1">{{ $stat['value'] }}</h2>
            <p class="stat-label text-muted mb-0">{{ $stat['label'] }}</p>
          </div>
          <div class="stat-icon bg-gradient-{{ $stat['color'] }} d-flex align-items-center justify-content-center rounded-circle" style="width:50px; height:50px;">
            <i class="{{ $stat['icon'] }} text-white fs-5"></i>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>


<!-- Charts & Activities -->
<div class="row mt-4 g-4">
  <!-- Visitor Chart -->
  <div class="col-lg-8">
    <div class="card-material fade-in-up shadow-sm border-0 rounded-4">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-3">Grafik Pengunjung Bulanan</h5>
        <canvas id="visitorChart" height="250"></canvas>
      </div>
    </div>
  </div>

  <!-- Latest Activities -->
  <div class="col-lg-4">
    <div class="card-material fade-in-up shadow-sm border-0 rounded-4">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-3">Aktivitas Terbaru</h5>
        <div class="activity-list small text-muted">
          <div class="mb-2"><i class="fas fa-ticket-alt me-2 text-primary"></i> Pengunjung baru melakukan reservasi</div>
          <div class="mb-2"><i class="fas fa-wallet me-2 text-success"></i> Pembayaran tiket berhasil</div>
          <div class="mb-2"><i class="fas fa-comment-dots me-2 text-info"></i> Pengunjung meninggalkan ulasan</div>
          <div><i class="fas fa-water me-2 text-warning"></i> Kolam utama dalam perawatan</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const ctx = document.getElementById('visitorChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
      datasets: [{
        label: 'Jumlah Pengunjung',
        data: [1200, 1900, 1500, 2200, 1800, 2500],
        borderColor: '#667eea',
        backgroundColor: 'rgba(102,126,234,0.1)',
        borderWidth: 2,
        tension: 0.4,
        fill: true,
        pointRadius: 4,
        pointHoverRadius: 6
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true, ticks: { color: '#888' } },
        x: { ticks: { color: '#888' } }
      },
      plugins: {
        legend: { display: false },
      }
    }
  });
</script>
@endpush
