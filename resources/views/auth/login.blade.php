<!-- {{-- 
    View: Login Page
    Description: Authenticates users into the system.
    Features:
    - Email/Password login
    - Password visibility toggle
    - Google Social Login
    - Recaptcha integration
--}} -->
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />

            <div class="input-group">
                <x-text-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye"></i>
                </button>
            </div>

            <script>
                document.getElementById('togglePassword').addEventListener('click', function (e) {
                    const passwordInput = document.getElementById('password');
                    const icon = this.querySelector('i');
                    
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    }
                });
            </script>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label text-secondary small">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="mb-3">
            {!! NoCaptcha::display() !!}
            <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="text-decoration-none text-dark small me-auto" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <hr class="my-4">
        
        <div class="text-center">
            <a href="{{ route('auth.google.redirect') }}" class="btn btn-danger w-100">
                <i class="fab fa-google me-2"></i> Login with Google
            </a>
        </div>
    </form>
    {!! NoCaptcha::renderJs() !!}
</x-guest-layout>
