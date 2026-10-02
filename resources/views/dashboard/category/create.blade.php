@extends('layouts.app')
@section('content')       
<!-- Page header with logo and tagline-->
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" style="width: 400px; height: min-content;">
        <h1 class="text-center">{{ __('Create a Category') }}</h1>
        <form class="mb-4" action="{{ route('dashboard.categories.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-floating @error('name') is-invalid @enderror">
                    <input type="text" name="name" id="name" class="form-control mb-3" placeholder="{{ __('Category Name') }}" value="{{ old('name') }}">
                    <label class="ms-3" for="name">{{ __('Category Name') }}</label>
                    @error('name')
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