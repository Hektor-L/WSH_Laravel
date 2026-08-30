@extends('layouts.app')
@section('content')
<x-guest-layout>
    <div class="mb-4">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-floating @error('password') is-invalid @enderror">
            <input type="password" id="password" name="password" class="block my-2 w-full form-control @error('password') is-invalid @enderror" placeholder="Password" autofocus autocomplete="current-password" />
            <label for="password">Password</label>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </div>
        <div class="flex justify-end mt-4">
            <button class="btn btn-primary">{{ __('Confirm') }}</button>
        </div>
    </form>
</x-guest-layout>
@endsection