<x-guest-layout>
    <!-- Login Prompt -->
    <div class="text-center mb-4 p-3 bg-light rounded">
        <p class="mb-2">{{ __('Already have an account?') }}</p>
        <a href="{{ route('login') }}" class="btn btn-outline-primary">
            {{ __('Sign in here') }}
        </a>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                   name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                   name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" class="form-control" 
                   name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary w-100">
            {{ __('Create Account') }}
        </button>
    </form>
</x-guest-layout>