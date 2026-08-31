@extends('layouts.app')
@section('content')
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-dark border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">{{ __('Welcome to') }} WorkServiceHub!</h1>
                    <p class="lead mb-3"> {{ __("A Job related forum to search for a job opening or for workers if you're an employer.") }}</p>
                    @auth
                        <a class="btn btn-outline-primary btn-lg" href="{{ route('posts.create') }}" style="width: 70%; min-width: max-content;">{{ __('Create a new post') }} <i class="bi bi-pencil-square"></i></a>
                    @endauth
                        
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                        @foreach ($posts as $post)
                        <?php
                        $description = $post->description;
                            if(strlen($description) > 200) {
                                $description = substr($description, 0, 200);
                                $description = substr($description, 0, strrpos($description, ' ')) . '...';
                            }
                        ?>
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h2 class="card-title h4">{{ $post->title }}</h2>
                                    <div class="small text-muted">{{ __($post->created_at->format('jS \o\f F\, Y\. h:i:s A T')) }}</div>
                                    <p class="card-text">{{ $description }}</p>
                                    <a class="btn btn-primary" href="{{ route('posts.view', ['id' => $post->id]) }}">Read more →</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Pagination-->
                    {{ $posts->links() }}
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($categories as $index => $group)
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($group as $category)
                                            <li><a href="{{ route('posts.by-category', $category->id) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection