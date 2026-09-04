@extends('layouts.app')
@section('content')
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" style="width: 400px; height: min-content;">
        <h1 class="text-center">Register</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name -->
            <div class="form-floating @error('name') is-invalid @enderror">
                <input type="text" id="name" name="name" class="block my-2 w-full form-control @error('name') is-invalid @enderror" placeholder="{{ __('Username') }}" autofocus autocomplete="username" />
                <label for="name">{{ __('Username') }}</label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Email Address -->
            <div class="form-floating @error('email') is-invalid @enderror">
                <input type="text" id="email" name="email" class="block my-2 w-full form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-mail') }}" autofocus autocomplete="email" />
                <label for="email">{{ __('E-mail') }}</label>
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
            <!-- Password confirmation -->
            <div class="form-floating @error('password_confirmation') is-invalid @enderror">
                <input type="password" id="password_confirmation" name="password_confirmation" class="block my-2 w-full form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Confirm Password') }}" autofocus autocomplete="new-password" />
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- User Type -->
            <div class="form-floating @error('type') is-invalid @enderror">
                <select class="form-select" name="type" id="type">
                    <option disabled selected>Choose your user type</option>
                    <option value="common">{{ __('Common') }}</option>
                    <option value="worker">{{ __('Worker') }}</option>
                    <option value="employer">{{ __('Employer') }}</option>
                </select>
                <label for="type">{{ __('User type') }}</label>
                @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="d-flex items-center justify-content-between mt-3">
                <a class="" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <button class="btn btn-primary ms-3">{{ __('Register') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection