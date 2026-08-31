@extends('layouts.app')
@section('content')
<!-- Page content-->
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" >
        <h1 class="text-center">{{ __('Edit a Post') }}</h1>
        <form class="mb-4" action="{{ route('dashboard.posts.update', ['id' => $post->id]) }}" method="POST">
            @csrf
            <div class="form-floating">
                <textarea class="form-control" placeholder="Título do Post" id="title" name="title">{{ $post->title }}</textarea>
                <label for="title">Título do Post</label>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input for="poster_id" type="text" name="poster_id" id="poster_id" name="poster_id" class="form-control mb-2" value="{{ $post->poster_id }}" placeholder="User ID">
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Descreva seu tópico aqui!" id="description" name="description" style="height: 100px">{{ $post->description }}</textarea>
                    <label for="description">Descreva seu tópico aqui!</label>
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