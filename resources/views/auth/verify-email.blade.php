<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-4">
        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
            <i class="fas fa-envelope-circle-check text-warning fa-2x"></i>
        </div>
        <h4 class="fw-bold text-dark mb-3">{{ __('Verify Your Email Address') }}</h4>
    </div>

    <!-- Instruction Text -->
    <div class="alert alert-light border text-center mb-4">
        <p class="mb-0 text-muted">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>
    </div>

    <!-- Success Message -->
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-check-circle me-2 fa-lg"></i>
            <div>
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <form method="POST" action="{{ route('verification.send') }}" class="w-100">
            @csrf
            <button type="submit" class="btn btn-warning w-100 py-2 fw-semibold">
                <i class="fas fa-paper-plane me-2"></i>
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-100">
            @csrf
            <button type="submit" class="btn btn-outline-secondary w-100 py-2">
                <i class="fas fa-sign-out-alt me-2"></i>
                {{ __('Log Out') }}
            </button>
        </form>
    </div>

    <!-- Additional Help -->
    <div class="text-center mt-4 pt-3 border-top">
        <small class="text-muted">
            <i class="fas fa-info-circle me-1"></i>
            {{ __('Check your spam folder if you can\'t find the verification email.') }}
        </small>
    </div>
</x-guest-layout>