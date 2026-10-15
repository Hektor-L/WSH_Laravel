@extends('layouts.app')
@section('content')
<!-- Page content-->
@if (session('error'))
    <div class="alert alert-danger mt-3" role="alert">{{ session('error') }}</div>
@endif
<div class="d-flex container justify-content-md-center align-items-center">
    <div class="card my-5 row justify-content-md-center p-3" >
        <h1 class="text-center">{{ __('Edit a Post') }}</h1>
        <form class="mb-4" action="{{ route('dashboard.posts.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="form-floating @error('title') is-invalid @enderror">
                    <input type="text" name="title" id="title" class="form-control mb-3" placeholder="{{ __('Post Title') }}" value="{{ $post->title }}">
                    <label class="ms-3" for="category_id">{{ __('Post Title') }}</label>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating @error('poster_id') is-invalid @enderror">
                    <select for="poster_id" class="form-select mb-3" name="poster_id" id="poster_id">
                        <option selected>{{ __('Select an user who will post') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $post->poster_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <label class="ms-3" for="category_id">{{ __('Poster') }}</label>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-floating @error('description') is-invalid @enderror">
                    <textarea for="description" class="form-control mb-3" style="height: 150px"id="description" name="description" placeholder="{{ __('Post Description') }}">{{ $post->description }}</textarea>
                    <label class="ms-3" for="description">{{ __('Post Description') }}</label>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating @error('category_id') is-invalid @enderror">
                    <select for="category_id" class="form-select mb-3" name="category_id" id="category_id">
                        <option selected>{{ __('Select the post category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ __($category->name) }}</option>
                        @endforeach
                    </select>
                    <label class="ms-3" for="category_id">{{ __('Category ID') }}</label>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div>
                        <input class="mb-3" type="file" name="image" id="image" accept="image/*">
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