@extends('layouts.frontend')

@section('title', 'Terjadi Kesalahan')

@section('content')
<section class="py-5 text-center">
  <div class="container">
    <h2 class="text-danger fw-bold">❌ Terjadi Kesalahan</h2>
    <p class="text-muted">Maaf, ada masalah dalam proses pembayaran kamu.</p>
    <a href="{{ route('reservasi.reguler.index') }}" class="btn btn-danger mt-3">Coba Lagi</a>
  </div>
</section>
@endsection
