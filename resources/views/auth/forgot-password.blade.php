<x-guest-layout>
    <div class="text-center mb-4">
        <h4 class="fw-bold text-primary">{{ __('Reset Your Password') }}</h4>
        <p class="text-muted mb-0">
            {{ __('Forgot your password? No problem. Just enter your email address and we\'ll email you a password reset link.') }}
        </p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-envelope text-muted"></i>
                </span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autofocus 
                       placeholder="Enter your email address">
            </div>
            @error('email')
                <div class="invalid-feedback d-block">
                    <i class="fas fa-exclamation-circle me-1"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid gap-3">
            <button type="submit" class="btn btn-primary btn-lg py-2">
                <i class="fas fa-paper-plane me-2"></i>
                {{ __('Send Reset Link') }}
            </button>
            
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i>
                    {{ __('Back to Login') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>