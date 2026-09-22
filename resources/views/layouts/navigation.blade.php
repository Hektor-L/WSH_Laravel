@section('nav')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a href="{{ route('index') }}"><img class="navbar-brand" src="{{ asset('WorkServiceHub-Logo.svg') }}" style="width: 200px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="{{ route('index') }}">{{ __('Home') }}</a></li>
            <div style="width: 100px;" class="d-flex justify-content-around align-items-center">
                <input type="radio" class="btn-check" name="mode" id="LightMode" autocomplete="off">
                <label class="btn btn-outline-secondary" for="LightMode"><i class="bi bi-sun" id="LightIcon"></i></label>
                <input type="radio" class="btn-check" name="mode" id="DarkMode" autocomplete="off">
                <label class="btn btn-outline-secondary" for="DarkMode"><i class="bi bi-moon-stars" id="DarkIcon"></i></label>
            </div>
                @auth
                    <li class="nav-item dropdown ps-2">
                        <a role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img width="40px" class="object-fit-cover rounded-circle" src="{{ asset("WorkServiceHub-DefaultProfilePic.svg") }}">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" id="navbarDropdown">
                            <li><span class="dropdown-header">{{ Auth::user()->name }}</span></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><div class="dropdown-item d-flex justify-content-around align-items-center">
                                </div></li>
                            <form method="POST" action="{{ route('logout') }}">
                                <li><a class="dropdown-item danger" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a></li>
                            </form>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a></li>
                @endauth
            </ul>
        </div>
    </div>
    <script>
        const lightMode = document.getElementById('LightMode');
        const darkMode = document.getElementById('DarkMode');
        const lightIcon = document.getElementById('LightIcon');
        const darkIcon = document.getElementById('DarkIcon');

        lightMode.addEventListener('click', () => {
            document.body.setAttribute('data-bs-theme', 'light');
            lightIcon.classList.remove('bi-sun');
            lightIcon.classList.add('bi-sun-fill');
            darkIcon.classList.remove('bi-moon-stars-fill');
            darkIcon.classList.add('bi-moon-stars');
            sessionStorage.setItem('theme', 'light');
        });

        darkMode.addEventListener('click', () => {
            document.body.setAttribute('data-bs-theme', 'dark');
            darkIcon.classList.remove('bi-moon-stars');
            darkIcon.classList.add('bi-moon-stars-fill');
            lightIcon.classList.remove('bi-sun-fill');
            lightIcon.classList.add('bi-sun');
            sessionStorage.setItem('theme', 'dark');
        });
        sessionStorage.getItem('theme') === 'light' ? lightMode.setAttribute('checked', '') : darkMode.setAttribute('checked', '');
        sessionStorage.getItem('theme') === 'light' ? lightIcon.classList.remove('bi-sun') : darkIcon.classList.remove('bi-moon-stars');
        sessionStorage.getItem('theme') === 'light' ? lightIcon.classList.add('bi-sun-fill') : darkIcon.classList.add('bi-moon-stars-fill');
    </script>
</nav>
@endsection