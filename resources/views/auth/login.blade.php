@extends('layouts.app')
@section('content')
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" style="width: 400px; height: min-content;">
        <h1 class="text-center">Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
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
                <input type="password" id="password" name="password" class="block my-2 w-full form-control @error('password') is-invalid @enderror" placeholder="Password" autofocus autocomplete="current-password" />
                <label for="password">Password</label>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
            <!-- Remember Me -->

            <div class="block my-3">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="d-flex items-center justify-content-between mt-3">
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <button class="btn btn-primary ms-3">{{ __('Log in') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection