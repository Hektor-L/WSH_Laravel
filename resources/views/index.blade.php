@extends('layouts.app')
@section('content')
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-dark border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">{{ __('Welcome to') }} WorkServiceHub!</h1>
                    <p class="lead mb-0"> {{ __("A Job related forum to search for a job opening or for workers if you're an employer.") }}</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <a class="btn btn-outline-primary btn-lg" href="{{ route('posts.create') }}">{{ __('Create a new post') }} <i class="bi bi-pencil-square"></i></a>
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title">Featured Post Title</h2>
                            <div class="small text-muted">January 1, 2023</div>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                            <a class="btn btn-primary" href="#!">Read more →</a>
                        </div>
                    </div>
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
                                    <a class="btn btn-primary" href="#!">Read more →</a>
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
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($categories as $index => $group)
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($group as $category)
                                            <li><a href="#!">{{ $category->name }}</a></li>
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