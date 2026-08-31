@extends('layouts.app')
@section('content')
    <header class="py-5 bg-dark border-bottom mb-4">
        <div class="container">
            <div class="text-center my-2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
        </div>
    </header>
    <div class="card text-center">
        <div class="card-header">
            <h4>CRUDs</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('dashboard.posts.index') }}" class="card-link">Posts</a>
            <a href="" class="card-link">Users</a>
            <a href="{{ route('dashboard.comments.index') }}" class="card-link">Comments</a>
            
            
        </div>
    </div>
    
@endsection