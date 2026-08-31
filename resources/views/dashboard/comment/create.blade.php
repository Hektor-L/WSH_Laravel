@extends('layouts.app')
@section('content')       
<!-- Page header with logo and tagline-->
<div class="d-flex container justify-content-md-center align-items-center" style="height: 90vh;">
    <div class="card mb-10 row justify-content-md-center p-3" style="width: 400px; height: min-content;">
        <h1 class="text-center">{{ __('Create a Post') }}</h1>
        <form class="mb-4" action="{{ route('dashboard.posts.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <input for="post_id" type="text" name="post_id" id="post_id" class="form-control mb-2" placeholder="User ID">
                </div>
                <div class="col-md-2">
                    <input for="commenter_id" type="text" name="commenter_id" id="commenter_id" class="form-control mb-2" placeholder="User ID">
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <textarea for="text" class="form-control" rows="2" id="text" name="text" placeholder="Describe your topic here!"></textarea>
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