<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/> 
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
            <div class="container">
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    

                    @guest
                        <ul class="navbar-nav ms-auto">
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                        @else
                            <ul class="navbar-nav">
                                <h3 class="navbar-brand">Navigacioni meni</h3>
                                <div class="navbar-nav">
                                    <a type="button" class="nav-link btn bg-success bg-gradient-500" href="/osiguranje">Putno osiguranje</a>
                                    <div class="btn-group">
                                        <a type="button" href="/blog" class="nav-link btn bg-success bg-gradient-500">Blog</a>
                                        <a type="button" class="nav-link btn bg-success bg-gradient-500 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        </a>
                                        <ul class="dropdown-menu bg-success">
                                            <li><a class="text-dark px-3" href="/blog/kreirajBlog">Kreiraj post</a></li>
                                        </ul>
                                    </div> 
                            @if(\Auth::user()->user_type == 'admin')
                                <div class="btn-group dropend">
                                    <a type="button" class="nav-link btn bg-success bg-gradient-500  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Admin panel
                                    </a>
                                    <ul class="dropdown-menu bg-success">
                                        <label class="dropdown-header text-dark p-2"><b>POLISA</b></label>
                                        <li><a href="/adminPanel/polise/prikaz" class="text-dark px-3">Pregled polisa</a></li>
                                        <hr>
                                        <label class="dropdown-header text-dark p-2"><b>BLOG</b></label>
                                        <li><a href="/adminPanel/blog/prikazBlog" class="text-dark px-3">Pregled blogova</a></li>
                                        <!-- <li><a href="/adminPanel/blog/kreirajBlog" class="text-dark px-3">Kreiraj post</a></li> -->
                                        <hr>
                                        <label class="dropdown-header text-dark p-2"><b>KORISNICI</b></label>
                                        <li><a href="#" class="text-dark px-3">Pregled korisnika</a></li>
                                    </ul>
                                </div>  
                            @endif             
                            </div>
                            </ul>
                            <ul class="navbar-nav ms-auto">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </div>
                            </ul>
                    @endguest
                        
                </div>
            </div>
        </nav>
    </div>

    <main class="py-4" id="app2">
        @yield('content')
    </main>


    <div id="app3">
        @yield('footer')
    </div>
   
</body>
</html>
