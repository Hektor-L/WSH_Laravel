@extends('layouts.app')
@section('content')       
<!-- Page header with logo and tagline-->
<header class="py-5 bg-dark border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">{{ __('Dashboard') }}</h1>
            <h3 class="lead mb-0"> {{ __('Comments') }}</h3>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Blog post-->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Post ID</th>
                        <th scope="col">Author</th>
                        <th scope="col">Date of Creation</th>
                        <th scope="col">Date of Update</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <th scope="row">{{ $comment->id }}</th>
                    <td>{{ $comment->post_id }}</td>
                    <td>{{ $comment->users->name }}</td>
                    <td>{{ $comment->created_at }}</td>
                    <td>{{ $comment->updated_at }}</td>
                    <td><a href="{{ route('dashboard.posts.view', $comment->id) }}" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a class="btn btn-outline-danger" role="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $comment->id }}"><i class="bi bi-trash3-fill"></i> Delete</a></td>
                </tr>
                    <div class="modal fade" id="confirmDeleteModal{{ $comment->id }}" tabindex="-1" aria-labelledby="confirmDeleteModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Deletion?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this comment?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{ route('dashboard.posts.delete', $comment->id) }}" role="button" class="btn btn-primary">Confirm</a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
                </tbody>
            </table>
            {{ $comments->links() }}
            <!-- Pagination-->
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <form class="mb-3" method="GET" action="{{ route('dashboard.posts.search') }}">
                        <div class="input-group">
                            <input id="filtro" name="filtro" class="form-control" type="text" placeholder="Search..." value="{{ $filtro ?? '' }}" autofocus>
                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Data base widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Users</a></li>
                                <li><a href="#!">Posts</a></li>
                                <li><a href="#!">Comments</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
       
@endsection