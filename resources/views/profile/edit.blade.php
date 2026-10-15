@extends('layouts.app')
@section('content')
@if (session('error'))
    <div class="alert my-3 alert-danger" role="alert">{{ session('error') }}</div>
@endif
@if (session('msg'))
    <div class="alert my-3 alert-success" role="alert">{{ session('msg') }}</div>
@endif
    <header class="py-5 border-bottom mb-4">
        <div class="container">
            <h2 class="text-center my-2">{{ __('Profile') }}</h2>
        </div>
    </header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 ">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection