<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/076ff25479.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<style>
    .navbar-text {
        color: white;
        font-size: 25px;
    }
    footer a, footer p {
        color: white;
    }
    body a {
        font-size: 18px;
    }
</style>

<script>
    $('.nav-item').on('click',function(e) {
        if ( this.hash !== ""){
            e.preventDefault();
            const anchor = this.hash;

            $('html, body').animate({
                scrollTop: $(anchor).offset().top
            }, 800, function(){
                window.location.hash = anchor;
            });
        }
    });
</script>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                
                <a href="#"><i class="navbar-brand fas fa-code"></i><span class="navbar-text text-white">Mr. Mo</span></a>

                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                  
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <a class="nav-item nav-link text-white ml-auto" href="{{ url('/') }}">Home</a>
                        <a class="text-white nav-item nav-link text-white ml-auto" href="{{ url('/blog') }}">Blog</a>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item ml-auto">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ml-auto">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            <a class="text-white nav-item nav-link ml-auto" href="#ContactInfo">Contact</a>
                        @else
                            <li class="nav-item ml-auto dropdown">
                                <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" style="background-color: rgba(50, 50, 50, 0.9);" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @if ($_SERVER['REQUEST_URI'] == '' || $_SERVER['REQUEST_URI'] == '/blog')
            <div>
                @include('layouts.footer')
            </div>
        @endif
    </div>

</body>
</html>
