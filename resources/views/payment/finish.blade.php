@extends('layouts.frontend')

@section('title', 'Pembayaran Berhasil')

@section('content')
<section class="py-5 text-center">
  <div class="container">
    <h2 class="text-success fw-bold">🎉 Pembayaran Berhasil!</h2>
    <p class="text-muted">Terima kasih, transaksi kamu sudah kami terima.</p>
    <a href="{{ route('user.pemesanan.index') }}" class="btn btn-primary mt-3">Lihat Pemesanan Saya</a>
  </div>
</section>
@endsection
