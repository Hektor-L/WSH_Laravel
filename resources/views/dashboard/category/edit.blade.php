@extends('layouts.app')
@section('content')
<!-- Page content-->
<div class="d-flex container justify-content-md-center align-items-center">
    @if (session('error'))
        <div class="alert alert-danger mt-3" role="alert">{{ session('error') }}</div>
    @endif
    <div class="card my-5 row justify-content-md-center p-3" style="width: 400px; height: min-content;">
        <h1 class="text-center">{{ __('Edit a Category') }}</h1>
        <form class="mb-4" action="{{ route('dashboard.categories.update', ['id' => $category->id]) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
                <div class="form-floating @error('name') is-invalid @enderror">
                    <input type="text" name="name" id="name" class="form-control mb-3" placeholder="{{ __('Category Name') }}" value="{{ $category->name }}">
                    <label class="ms-3" for="name">{{ __('Category Name') }}</label>
                    @error('name')
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