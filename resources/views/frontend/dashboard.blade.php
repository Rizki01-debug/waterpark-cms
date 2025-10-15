@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h2 class="fw-bold">Dashboard Pengguna</h2>
    <p>Selamat datang, {{ auth()->user()->name }} 🎉</p>
</div>
@endsection
