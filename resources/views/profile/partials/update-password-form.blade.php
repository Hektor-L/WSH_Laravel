<section>
    <header>
        <h2 class="text-lg">{{ __('Update Password') }}</h2>

        <p class="my-1">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="form-floating @error('current_password', 'updatePassword') is-invalid @enderror">
            <input type="password" id="current_password" name="current_password" class="block my-2 w-full form-control
            @error('current_password', 'updatePassword') is-invalid @enderror"placeholder="{{ __('Current Password') }}" autofocus autocomplete="current-password" />
            <label for="current_password">{{ __('Current Password') }}</label>
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating @error('password', 'updatePassword') is-invalid @enderror">
            <input type="password" id="password" name="password" class="block my-2 w-full form-control
            @error('password', 'updatePassword') is-invalid @enderror" placeholder="{{ __('New Password') }}" autofocus autocomplete="new-password" />
            <label for="password">{{ __('New Password') }}</label>
            @error('password', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating @error('password_confirmation', 'updatePassword') is-invalid @enderror">
            <input type="password" id="password_confirmation" name="password_confirmation" class="block my-2 w-full form-control
            @error('password_confirmation', 'updatePassword') is-invalid @enderror" placeholder="{{ __('Confirm Password') }}" autofocus autocomplete="new-password" />
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            @error('password_confirmation', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex items-center gap-4">
            <button class="btn btn-secondary">{{ __('Save') }}</button>
            @if (session('status') === 'password-updated')
                <p class="text-success-emphasis">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
