@extends('layouts.app')
@section('content')
<!-- Page content-->
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" >
        <h1 class="text-center">{{ __('Edit a User') }}</h1>
        <form class="mb-4" action="{{ route('dashboard.users.update', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
                <div class="form-floating col @error('name') is-invalid @enderror">
                    <input type="text" name="name" id="name" class="form-control mb-3" placeholder="{{ __('Username') }}" value="{{ old('name', $user->name) }}">
                    <label class="ms-3" for="name">{{ __('Username') }}</label>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating col @error('email') is-invalid @enderror">
                    <input type="email" name="email" id="email" class="form-control mb-3" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}">
                    <label class="ms-3" for="email">{{ __('Email') }}</label>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-floating col @error('type') is-invalid @enderror">
                    <select for="type" class="form-select mb-3" name="type" id="type">
                        <option value="common" {{ $user->type ==  'common' ? 'selected' : '' }}>{{ __('Common') }} </option>
                        <option value="worker" {{ $user->type ==  'worker' ? 'selected' : '' }}>{{ __('Worker') }}</option>
                        <option value="employer" {{ $user->type ==  'employer' ? 'selected' : '' }}>{{ __('Employer') }}</option>
                        <option value="staff" {{ $user->type ==  'staff' ? 'selected' : '' }}>{{ __('Staff') }}</option>
                    </select>
                    <label class="ms-3" for="type">{{ __('User Type') }}</label>
                    @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-floating col @error('birth_date') is-invalid @enderror">
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" class="block my-2 w-full form-control @error('birth_date') is-invalid @enderror" placeholder="{{ __('Birth Date') }}" autofocus autocomplete="bday" />
                    <label class="ms-3" for="birth_date">{{ __('Birth Date') }}</label>
                    @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-floating col @error('description') is-invalid @enderror">
                    <textarea for="description" class="form-control mb-3" style="height: 150px"id="description" name="description" placeholder="{{ __('Description') }}">{{ old('description', $user->description) }}</textarea>
                    <label class="ms-3" for="description">{{ __('Description') }}</label>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection