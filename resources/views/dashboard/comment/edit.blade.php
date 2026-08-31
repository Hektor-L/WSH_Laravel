@extends('layouts.app')
@section('content')
<!-- Page content-->
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" style="width: 400px; height: min-content;">
        <h1 class="text-center">{{ __('Edit a Post') }}</h1>
        <form class="mb-4" action="{{ route('dashboard.posts.update', ['id' => $comment->id]) }}" method="POST">
            @csrf
            <div class="form-floating">
                <textarea class="form-control" placeholder="Comentário" id="text" name="text">{{ $commen->text }}</textarea>
                <label for="title">Título do Post</label>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input for="post_id" type="text" name="post_id" id="post_id" class="form-control mb-2" value="{{ $comment->post_id }}" placeholder="User ID">
                </div>
                <div class="col-md-2">
                    <input for="commenter_id" type="text" name="commenter_id" id="commenter_id" class="form-control mb-2" value="{{ $comment->commenter_id }}" placeholder="User ID">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection