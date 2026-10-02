@extends('layouts.app')
@section('content')       
<!-- Page header with logo and tagline-->
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" style="width: 75%; height: min-content;">
        <h1 class="text-center">{{ __('Create a User') }}</h1>
        <form class="mb-3" action="{{ route('dashboard.users.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-floating col @error('name') is-invalid @enderror">
                    <input type="text" name="name" id="name" class="form-control mb-3" placeholder="{{ __('Username') }}" value="{{ old('name') }}">
                    <label class="ms-3" for="name">{{ __('Username') }}</label>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating col @error('email') is-invalid @enderror">
                    <input type="email" name="email" id="email" class="form-control mb-3" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                    <label class="ms-3" for="email">{{ __('Email') }}</label>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-floating col @error('password') is-invalid @enderror">
                    <input type="password" name="password" id="password" class="form-control mb-3" placeholder="{{ __('Password') }}" value="{{ old('password') }}">
                    <label class="ms-3" for="password">{{ __('Password') }}</label>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating col @error('type') is-invalid @enderror">
                    <select for="type" class="form-select mb-3" name="type" id="type">
                        <option selected>{{ __('Select User Type') }}</option>
                        <option value="common">{{ __('Common') }}</option>
                        <option value="worker">{{ __('Worker') }}</option>
                        <option value="employer">{{ __('Employer') }}</option>
                        <option value="staff">{{ __('Staff') }}</option>
                    </select>
                    <label class="ms-3" for="type">{{ __('User Type') }}</label>
                    @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-floating col @error('birth_date') is-invalid @enderror">
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" class="block my-2 w-full form-control @error('birth_date') is-invalid @enderror" placeholder="{{ __('Birth Date') }}" autofocus autocomplete="bday" />
                    <label for="birth_date">{{ __('Birth Date') }}</label>
                    @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-floating col @error('description') is-invalid @enderror">
                    <textarea for="description" class="form-control mb-3" style="height: 150px"id="description" name="description" placeholder="{{ __('Description') }}">{{ old('description') }}</textarea>
                    <label class="ms-3" for="description">{{ __('Description') }}</label>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit">{{ __('Create') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection