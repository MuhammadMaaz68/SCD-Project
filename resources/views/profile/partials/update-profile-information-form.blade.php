<!-- {{-- 
    Partial: Update Profile Information
    Description: Form to update user name and email.
--}} -->
<header>
        <h2 class="h4 fw-bold text-dark">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted small">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="row g-3">
            <div class="col-md-6">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="col-md-6">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 bg-light" :value="old('email', $user->email)" disabled />
                <input type="hidden" name="email" value="{{ $user->email }}">
                <p class="text-muted small mt-1">Email cannot be changed.</p>
            </div>

            <div class="col-md-6">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1" :value="old('phone', $user->phone)" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div class="col-md-6">
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" name="country" type="text" class="mt-1" :value="old('country', $user->country)" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>

            <div class="col-12">
                <x-input-label for="state" :value="__('State')" />
                <x-text-input id="state" name="state" type="text" class="mt-1" :value="old('state', $user->state)" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
</section>
