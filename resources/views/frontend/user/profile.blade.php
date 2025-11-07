@extends('layouts.frontend')
@section('title', 'Profil Saya')

@section('content')
<section class="py-5" style="margin-top: 100px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card border-0 shadow-sm p-4 rounded-4">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- FOTO PROFIL --}}
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('simplecity/img/default-user.png') }}"
                                     alt="User Avatar"
                                     class="rounded-circle border shadow-sm"
                                     width="100" height="100"
                                     style="object-fit: cover;">

                                <label for="avatar" class="position-absolute bottom-0 end-0 bg-danger text-white rounded-circle p-1"
                                       style="cursor:pointer;">
                                    <i class="bi bi-camera-fill"></i>
                                </label>
                                <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                            </div>
                            <h5 class="fw-bold mt-3 text-dark">{{ $user->name }}</h5>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>

                        {{-- FORM PROFIL --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control rounded-pill">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" value="{{ $user->email }}" class="form-control rounded-pill bg-light" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor HP</label>
                            <input type="text" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" class="form-control rounded-pill">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">ID Pengguna</label>
                            <input type="text" value="{{ $user->id }}" class="form-control rounded-pill bg-light" disabled>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button type="reset" class="btn btn-success px-4 rounded-pill">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button type="submit" class="btn btn-danger px-4 rounded-pill">
                                <i class="bi bi-save"></i> Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
