<section>
    <header>
        <h2 class="text-lg">{{ __('Profile Information') }}</h2>

        <p class="my-1">{{ __('Update your account\'s profile information and email address.') }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="row align-items-center mb-3" style="width: fit-content;">
            <div class="col">
                @if ($user->profile_picture_path)
                    <img src="{{ asset('storage/' . $user->profile_picture_path) }}" alt="Profile Picture" class="object-fit-cover rounded-circle" style="width: 150px; height: 150px;">
                @else
                    <img src="{{ asset('WorkServiceHub-DefaultProfilePic.svg') }}" alt="Default Profile Picture" class="object-fit-cover rounded-circle" style="width: 150px; height: 150px;">
                @endif
            </div>
            <h2 class="col">{{ $user->name }}</h2>
        </div>
        <input type="file" name="image" id="image" accept="image/*">
        <div class="form-floating @error('name') is-invalid @enderror">
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="block my-2 w-full form-control @error('email') is-invalid @enderror" placeholder="{{ __('Username') }}" autofocus autocomplete="username" />
            <label for="name">{{ __('Username') }}</label>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating @error('description') is-invalid @enderror">
            <textarea for="description" class="form-control mb-3" style="height: 200px"id="description" name="description" placeholder="{{ __('Post Description') }}">{{ old('description', $user->description) }}</textarea>
            <label for="description">{{ __('Profile Description') }}</label>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating @error('email') is-invalid @enderror">
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="block my-2 w-full form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-mail') }}" autofocus autocomplete="email" />
            <label for="email">{{ __('E-mail') }}</label>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm my-2">{{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-secondary">{{ __('Click here to re-send the verification email.') }}</button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="my-2 text-success-emphasis">{{ __('A new verification link has been sent to your email address.') }}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="form-floating @error('birth_date') is-invalid @enderror">
            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" class="block my-2 w-full form-control @error('birth_date') is-invalid @enderror" placeholder="{{ __('Birth Date') }}" autofocus autocomplete="bday" />
            <label for="birth_date">{{ __('Birth Date') }}</label>
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex items-center gap-4">
            <button class="btn btn-secondary">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <p class="text-success-emphasis">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
