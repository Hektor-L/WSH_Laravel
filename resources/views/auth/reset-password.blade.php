@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form-floating @error('email') is-invalid @enderror">
            <input type="email" id="email" name="email" class="block my-2 w-full form-control @error('email') is-invalid @enderror" placeholder="E-mail" autofocus autocomplete="email" />
            <label for="email">E-mail</label>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-floating @error('password') is-invalid @enderror">
            <input type="password" id="password" name="password" class="block my-2 w-full form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" autofocus autocomplete="new-password" />
            <label for="password">{{ __('Password') }}</label>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-floating @error('password_confirmation') is-invalid @enderror">
            <input type="password" id="password_confirmation" name="password_confirmation" class="block my-2 w-full form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Confirm Password') }}" autofocus autocomplete="new-password" />
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-primary ms-3">{{ __('Reset Password') }}</button>
        </div>
    </form>
@endsection
