@extends('layouts.backend')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
  <h2 class="fw-bold mb-4">Dashboard</h2>

  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card bg-body text-center p-4">
        <i class="bi bi-person fs-1 text-primary"></i>
        <h4 class="mt-3">pengunjung </h4>
        <p class="text-secondary">Jumlah Pengunjung Web</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-body text-center p-4">
        <i class="bi bi-cash fs-1 text-success"></i>
        <h4 class="mt-3">tiket</h4>
        <p class="text-secondary">Total Jumlah Tiket Terjual</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-body text-center p-4">
        <i class="bi bi-bag fs-1 text-info"></i>
        <h4 class="mt-3">booking </h4>
        <p class="text-secondary">Total Jumlah Booking Hotel</p>
      </div>
    </div>
  </div>

  {{-- Area chart (nanti pakai Chart.js) --}}
  <div class="card bg-body p-4">
    <canvas id="chartPendapatan"></canvas>
  </div>
</div>
@endsection
