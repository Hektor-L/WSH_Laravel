<section>
    <header>
        <h2 class="text-lg">
            {{ __('Update Password') }}
        </h2>

        <p class="my-1">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="form-floating @error('password') is-invalid @enderror">
            <input type="password" id="update_password_current_password" name="update_password_current_password" class="block my-2 w-full form-control
            @error('update_password_current_password') is-invalid @enderror"placeholder="{{ __('Current Password') }}" autofocus autocomplete="current-password" />
            <label for="password">{{ __('Current Password') }}</label>
            @error('update_password_current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating @error('update_password_password') is-invalid @enderror">
            <input type="password" id="update_password_password" name="update_password_password" class="block my-2 w-full form-control
            @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('New Password') }}" autofocus autocomplete="new-password" />
            <label for="update_password_password">{{ __('New Password') }}</label>
            @error('update_password_password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating @error('update_password_password_confirmation') is-invalid @enderror">
            <input type="password" id="update_password_password_confirmation" name="update_password_password_confirmation" class="block my-2 w-full form-control
            @error('update_password_password_confirmation') is-invalid @enderror" placeholder="{{ __('Confirm Password') }}" autofocus autocomplete="new-password" />
            <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
            @error('update_password_password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex items-center gap-4">
            <button class="btn btn-secondary">{{ __('Save') }}</button>
            @if (session('status') === 'password-updated')
                <p>{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
