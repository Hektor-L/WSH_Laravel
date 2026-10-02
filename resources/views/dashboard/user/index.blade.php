@extends('layouts.app')
@section('content')       
<!-- Page header with logo and tagline-->
<header class="py-5 border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">{{ __('Dashboard') }}</h1>
            <h3 class="lead"> {{ __('Users') }}</h3>
            <a class="btn btn-outline-primary btn-lg" href="{{ route('dashboard.users.create') }}" style="width: 70%; min-width: max-content;">{{ __('Create a new User') }} <i class="bi bi-pencil-square"></i></a>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Blog post-->
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th scope="col">{{ __('ID') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Type') }}</th>
                        <th scope="col">{{ __('Birth Date') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->type }}</td>
                    <td>{{ $user->birth_date }}</td>
                    <td><a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a class="btn btn-outline-danger" role="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $user->id }}"><i class="bi bi-trash3-fill"></i> Delete</a></td>
                </tr>
                    <div class="modal fade" id="confirmDeleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="confirmDeleteModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Confirm Deletion?') }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ __('Are you sure you want to delete this user?') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                    <form action="{{ route('dashboard.users.delete', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
            <!-- Pagination-->
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">{{ __('Search') }}</div>
                <div class="card-body">
                    <form class="mb-3" method="POST" action="{{ route('dashboard.users.search') }}">
                        @method('PUT')
                        <div class="input-group">
                            <input id="filtro" name="filtro" class="form-control" type="text" placeholder="{{ __('Search...') }}" value="{{ $filtro ?? '' }}" autofocus>
                            <button class="btn btn-primary" type="submit">{{ __('Search') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Data base widget-->
            <div class="card mb-4">
                <div class="card-header">Tables</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="{{ route('dashboard.users.index') }}">Users</a></li>
                                <li><a href="{{ route('dashboard.posts.index') }}">Posts</a></li>
                                <li><a href="{{ route('dashboard.comments.index') }}">Comments</a></li>
                                <li><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
       
@endsection