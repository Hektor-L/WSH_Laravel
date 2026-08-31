<section>
    <header>
        <h2 class="text-lg">
            {{ __('Profile Information') }}
        </h2>

        <p class="my-1">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-floating @error('name') is-invalid @enderror">
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="block my-2 w-full form-control @error('email') is-invalid @enderror" placeholder="{{ __('Username') }}" autofocus autocomplete="username" />
            <label for="name">{{ __('Username') }}</label>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating @error('email') is-invalid @enderror">
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="block my-2 w-full form-control @error('email') is-invalid @enderror" placeholder="E-mail" autofocus autocomplete="email" />
                <label for="email">E-mail</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm my-2">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-secondary">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="my-2 text-success-emphasis">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-secondary">{{ __('Save') }}</button>

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
