@extends('layouts.app')
@section('content')       
<!-- Page header with logo and tagline-->
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" style="width: 65%; height: min-content;">
        <h1 class="text-center">{{ __('Create a Post') }}</h1>
        <form class="mb-3" action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-floating @error('title') is-invalid @enderror">
                    <input type="text" name="title" id="title" class="form-control mb-3" placeholder="Post Title" value="{{ old('title') }}">
                    <label class="ms-3" for="category_id">{{ __('Post Title') }}</label>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input for="poster_id" type="text" name="poster_id" id="poster_id" class="form-control mb-3" value="{{ old('id', $user->id) }}" hidden>
                </div>
            </div>
            <div class="row">
                <div class="form-floating @error('description') is-invalid @enderror">
                    <textarea for="description" class="form-control mb-3" style="height: 150px"id="description" name="description" placeholder="Post Description">{{ old('description') }}</textarea>
                    <label class="ms-3" for="description">{{ __('Post Description') }}</label>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating @error('category_id') is-invalid @enderror">
                    <select for="category_id" class="form-select mb-3" name="category_id" id="category_id">
                        <option selected>{{ __('Select the post category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                        @endforeach
                    </select>
                    <label class="ms-3" for="category_id">{{ __('Category ID') }}</label>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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