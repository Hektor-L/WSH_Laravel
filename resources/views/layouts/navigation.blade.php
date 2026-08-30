@section('nav')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a href="{{ route('index') }}"><img class="navbar-brand" src="{{ asset('WorkServiceHub-Logo.svg') }}" style="width: 200px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('index') }}">Blog</a></li>
            @if (Route::has('login'))
                @auth
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>{{ Auth::user()->name }}</span>
                            <img width="40px" class="object-fit-cover rounded-circle" src="{{ asset("Default-ProfilePic.svg") }}">
                        </a>
                        <ul class="dropdown-menu" id="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <form method="POST" action="{{ route('logout') }}">
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a></li>
                            </form>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endif
                @endauth
            @endif
            </ul>
        </div>
    </div>
</nav>
@endsection