@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <article>
        <header class="py-2 border-bottom mb-4">
            <h1 class="fs-2 fw-bolder">{{ $post->title }}</h1>
            <p class="text-muted fst-italic">{{ __('Posted in the ' . $post->created_at->format('jS \o\f F\, Y h:i:s A') . ', by ' . $post->users->name )}}</p>
            <a class="badge bg-secondary text-decoration-none link-light" href="{{ route('posts.by-category', $category->id) }}">{{ $category->name }}</a>
        </header>
        @if ($post->image_path)
            <figure class="mb-4"><img class="img-fluid rounded" src="{{ asset('storage/'.$post->image_path) }}" style="height: fit-content;" alt="Post Image" /></figure>
        @endif
        <section>
            <p>{{ $post->description }}</p>
        </section>
    </article>
    <p class="fs-4">{{ __('Comments:') }}</p>
    @auth
        <div class="card mb-3">
            <div class="d-flex card-body">
                <div class="flex">
                    @if (Auth::user()->profile_picture_path)
                        <img src="{{ asset('storage/'.Auth::user()->profile_picture_path) }}" alt="Profile Picture" class="object-fit-cover rounded-circle" style="width: max-content; height: 50px;">
                    @else
                        <img src="{{ asset('WorkServiceHub-DefaultProfilePic.svg') }}" alt="Default Profile Picture" class="object-fit-cover rounded-circle" style="width: max-content; height: 50px;">
                    @endif
                </div>
                <form class="ms-3 w-100" action="{{ route('comments.store', [$post->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-floating @error('text') is-invalid @enderror">
                            <textarea for="text" class="form-control mb-3" style="height: 100px" id="text" name="text" placeholder="{{ __('Comment Message') }}">{{ old('text') }}</textarea>
                            <label class="ms-3" for="text">{{ __('Comment Message') }}</label>
                            @error('text')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit">{{ __('Send') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="my-4"><a href="{{ route('register') }}">{{ __('Sign Up') }}</a> {{ __('to comment on this post!') }}</div>
    @endauth
    @if (session('commentList') == '[]')
        <div class="d-flex container justify-content-center align-items-center" style="height: 150px;">{{ __('No Comments found.') }}</div>
    @else
    @foreach ($comments as $comment)
    <div class="card mb-3">
        <div class="d-flex card-body">
            <div class="flex">
                @if ($comment->users->profile_picture_path)
                    <img src="{{ asset('storage/'.$comment->users->profile_picture_path) }}" alt="Profile Picture" class="object-fit-cover rounded-circle" style="width: max-content; height: 50px;">
                @else
                    <img src="{{ asset('WorkServiceHub-DefaultProfilePic.svg') }}" alt="Default Profile Picture" class="object-fit-cover rounded-circle" style="width: max-content; height: 50px;">
                @endif
            </div>
            <div class="ms-3 w-100">
                <p class="fw-bold">{{ $comment->users->name }}</p>
                <p class="mb-2">{{ $comment->text }}</p>
                <p class="mb-0 fw-light">{{ $comment->created_at }} {{ $comment->updated_at != $comment->created_at ? '(Updated at '.$comment->updated_at.')' : '' }}</p>
                <div class="d-flex mt-3">
                    @auth
                        <div class="flex">
                            @if (Auth::user()->profile_picture_path)
                                <img src="{{ asset('storage/'.Auth::user()->profile_picture_path) }}" alt="Profile Picture" class="object-fit-cover rounded-circle" style="width: max-content; height: 50px;">
                            @else
                                <img src="{{ asset('WorkServiceHub-DefaultProfilePic.svg') }}" alt="Default Profile Picture" class="object-fit-cover rounded-circle" style="width: max-content; height: 50px;">
                            @endif
                        </div>
                        <form class="ms-3 w-100" action="{{ route('replies.store', [$comment->id]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-floating @error('text') is-invalid @enderror">
                                    <textarea for="text" class="form-control mb-3" style="height: 100px" id="text" name="text" placeholder="{{ __('Reply Message') }}">{{ old('text') }}</textarea>
                                    <label class="ms-3" for="text">{{ __('Reply Message') }}</label>
                                    @error('text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary" type="submit">{{ __('Send') }}</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="my-4"><a href="{{ route('register') }}">{{ __('Sign Up') }}</a> {{ __('to reply to this comment!') }}</div>
                    @endauth
                </div>
            @if ($comment->childComments->isNotEmpty())
            @foreach ($comment->childComments as $childComment)
                <div class="d-flex mt-3">
                    <div class="flex">
                        @if ($childComment->users->profile_picture_path)
                            <img src="{{ asset('storage/'.$childComment->users->profile_picture_path) }}" alt="Profile Picture" class="object-fit-cover rounded-circle" style="width: max-content; height: 50px;">
                        @else
                            <img src="{{ asset('WorkServiceHub-DefaultProfilePic.svg') }}" alt="Default Profile Picture" class="object-fit-cover rounded-circle" style="width: max-content; height: 50px;">
                        @endif
                    </div>
                    <div class="ms-3">
                        <p class="fw-bold">{{ $childComment->users->name }}</p>
                        <p class="mb-2">{{ $childComment->text }}</p>
                        <p class="mb-0 fw-light">{{ $childComment->created_at }} {{ $childComment->updated_at != $childComment->created_at ? '(Updated at '.$childComment->updated_at.')' : '' }}</p>
                    </div>
                </div>
            @endforeach
            @endif
            </div>
        </div>
    </div>
    @endforeach
    {{ $comments->links() }}
    @endif
</div>
@endsection