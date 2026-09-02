@extends('layouts.app')
@section('content')
<header class="py-5 bg-dark border-bottom mb-4">
    <p class="fs-2">{{ $post->title }}</p>
    <p class="fw-light">{{ __('Posted in the' . $post->created_at->format('jS \o\f F\, Y\. h:i:s A T')) }}, by {{ $post->users->name }}</p>
</header>
<div>
    <p>{{ $post->description }}</p>
    <p class="fs-4">{{ __('Comments:') }}</p>
    @foreach ($comments as $comment)
    <div class="card mb-3 w-75">
        <div class="card-header">
            <a class="row align-items-center">
                <img height="50" width="50" class="col-auto object-fit-cover rounded-circle" src="{{ asset("Default-ProfilePic.svg") }}">
                <p class="col-auto fw-medium">{{ $comment->users->name }}</p>
            </a>
        </div>
        <div class="card-body ms-5">
            <p class="mb-2">{{ $comment->text }}</p>
            <p class="mb-0 fw-light">{{ $comment->created_at }}</p>
        </div>
    </div>
    @endforeach
    {{ $comments->links() }}
</div>
@endsection