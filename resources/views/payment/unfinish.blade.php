@extends('layouts.frontend')

@section('title', 'Pembayaran Belum Selesai')

@section('content')
<section class="py-5 text-center">
  <div class="container">
    <h2 class="text-warning fw-bold">⚠️ Pembayaran Belum Selesai</h2>
    <p class="text-muted">Silakan selesaikan pembayaran untuk menyelesaikan pesanan kamu.</p>
    <a href="{{ route('reservasi.reguler.index') }}" class="btn btn-secondary mt-3">Kembali ke Halaman Tiket</a>
  </div>
</section>
@endsection
