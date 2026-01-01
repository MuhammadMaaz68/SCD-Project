<!-- {{-- 
    Partial: Update Password
    Description: Form to update user password.
--}} -->
<header>
        <h2 class="h4 fw-bold text-dark">
            {{ __('Update Password') }}
        </h2>

        <p class="text-muted small">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="input-group">
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="input-group">
                <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    
    <script>
        function togglePasswordVisibility(inputId, buttonId) {
            const passwordInput = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const icon = button.querySelector('i');
            
            button.addEventListener('click', function () {
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
        }

        togglePasswordVisibility('update_password_current_password', 'toggleCurrentPassword');
        togglePasswordVisibility('update_password_password', 'toggleNewPassword');
    </script>
</section>
