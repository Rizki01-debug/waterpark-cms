<x-guest-layout>
    <!-- Security Header -->
    <div class="text-center mb-4">
        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
            <i class="fas fa-shield-alt text-primary fa-2x"></i>
        </div>
        <h4 class="fw-bold text-dark mb-2">{{ __('Security Verification') }}</h4>
        <p class="text-muted mb-0">
            {{ __('This is a secure area of the application. Please confirm your password to continue.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class="fas fa-lock text-muted"></i>
                </span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password"
                       placeholder="Enter your password">
                <button type="button" class="input-group-text toggle-password" data-target="password">
                    <i class="fas fa-eye text-muted"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block mt-2">
                    <i class="fas fa-exclamation-circle me-1"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg py-2 fw-semibold">
                <i class="fas fa-check-circle me-2"></i>
                {{ __('Confirm & Continue') }}
            </button>
        </div>
    </form>

    <!-- Security Note -->
    <div class="text-center mt-4 pt-3 border-top">
        <small class="text-muted">
            <i class="fas fa-info-circle me-1"></i>
            {{ __('For your security, we need to verify your identity.') }}
        </small>
    </div>
</x-guest-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const toggleButton = document.querySelector('.toggle-password');
    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
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
    }
});
</script>