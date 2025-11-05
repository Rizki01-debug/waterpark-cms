<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-5">
        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
            <i class="fas fa-key text-success fa-2x"></i>
        </div>
        <h3 class="fw-bold text-dark mb-2">{{ __('Create New Password') }}</h3>
        <p class="text-muted mb-0">
            {{ __('Enter your email and create a new password for your account.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class="fas fa-envelope text-muted"></i>
                </span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                       placeholder="your@email.com">
            </div>
            @error('email')
                <div class="invalid-feedback d-block">
                    <i class="fas fa-exclamation-circle me-1"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-semibold">{{ __('New Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class="fas fa-lock text-muted"></i>
                </span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password"
                       placeholder="Enter new password">
                <button type="button" class="input-group-text toggle-password" data-target="password">
                    <i class="fas fa-eye text-muted"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">
                    <i class="fas fa-exclamation-circle me-1"></i>
                    {{ $message }}
                </div>
            @enderror
            <div class="form-text">Minimum 8 characters with letters and numbers</div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-semibold">{{ __('Confirm New Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class="fas fa-lock text-muted"></i>
                </span>
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                       name="password_confirmation" required autocomplete="new-password"
                       placeholder="Confirm your new password">
                <button type="button" class="input-group-text toggle-password" data-target="password_confirmation">
                    <i class="fas fa-eye text-muted"></i>
                </button>
            </div>
            @error('password_confirmation')
                <div class="invalid-feedback d-block">
                    <i class="fas fa-exclamation-circle me-1"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid gap-3">
            <button type="submit" class="btn btn-success btn-lg py-3 fw-semibold">
                <i class="fas fa-save me-2"></i>
                {{ __('Update Password') }}
            </button>
            
            <div class="text-center pt-2">
                <a href="{{ route('login') }}" class="text-decoration-none text-muted">
                    <i class="fas fa-arrow-left me-1"></i>
                    {{ __('Back to Login') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});
</script>