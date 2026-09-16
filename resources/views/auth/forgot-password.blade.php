@extends('layouts.app');
@section('content')
    <div class="mb-4 text-sm">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <!-- Email Address -->
        <div class="form-floating @error('email') is-invalid @enderror">
            <input type="email" id="email" name="email" class="block my-2 w-full form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-mail') }}" autofocus autocomplete="email" />
            <label for="email">{{ __('E-mail') }}</label>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-secondary">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
@endsection