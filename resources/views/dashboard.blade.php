@extends('layouts.app')
@section('content')
    <header class="py-5 bg-dark border-bottom mb-4">
        <div class="container">
            <div class="text-center my-2"><h2 class="fw-bolder">{{ __('Dashboard') }}</h2></div>
        </div>
    </header>
    <div class="d-flex container justify-content-md-center align-items-center">
        <div class="card text-center" style="width: 60%;">
            <div class="card-header">
                <h4>CRUDs</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('dashboard.posts.index') }}" class="card-link">{{ __('Posts') }}</a>
                <a href="#!" class="card-link disabled">{{ __('Users') }}</a>
                <a href="#!" class="card-link disabled">{{ __('Comments') }}</a>
                
                
            </div>
        </div>
    </div>
    
@endsection