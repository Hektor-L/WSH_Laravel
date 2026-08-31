@extends('layouts.app')
@section('content')       
<!-- Page header with logo and tagline-->
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" style="width: 400px; height: min-content;">
        <h1 class="text-center">{{ __('Create a Post') }}</h1>
        <form class="mb-4" action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input for="title" type="text" name="title" id="title" class="form-control mb-2" placeholder="Título do Post">
                </div>
                <div class="col-md-2">
                    <input for="poster_id" type="text" name="poster_id" id="poster_id" class="form-control mb-2" placeholder="User ID" hidden>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <textarea for="description" class="form-control" rows="2" id="description" name="description" placeholder="Describe your topic here!"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit">Criar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection