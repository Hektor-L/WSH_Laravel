@extends('layouts.app')
@section('content')
<!-- Page content-->
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" style="width: 400px; height: min-content;">
        <h1 class="text-center">{{ __('Edit a Comment') }}</h1>
        <form class="mb-4" action="{{ route('dashboard.comments.update', ['id' => $comment->id]) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
                <div class="form-floating @error('post_id') is-invalid @enderror">
                    <select for="post_id" class="form-select mb-3" name="post_id" id="post_id">
                        <option selected>{{ __('Select a post') }}</option>
                        @foreach ($posts as $post)
                            <option value="{{ $post->id }}" {{ $comment->post_id == $post->id ? 'selected' : '' }}>{{ $post->title }}</option>
                        @endforeach
                    </select>
                    <label class="ms-3" for="post_id">{{ __('Post') }}</label>
                    @error('post_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating @error('commenter_id') is-invalid @enderror">
                    <select for="commenter_id" class="form-select mb-3" name="commenter_id" id="commenter_id">
                        <option selected>{{ __('Select an user who will comment') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $comment->commenter_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <label class="ms-3" for="commenter_id">{{ __('Commenter') }}</label>
                    @error('commenter_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-floating @error('text') is-invalid @enderror">
                    <textarea for="text" class="form-control mb-3" style="height: 150px"id="text" name="text" placeholder="{{ __('Comment Message') }}">{{ $comment->text }}</textarea>
                    <label class="ms-3" for="text">{{ __('Comment Message') }}</label>
                    @error('text')
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