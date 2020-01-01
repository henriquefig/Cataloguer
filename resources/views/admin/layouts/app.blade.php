<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('imgs/favicon.ico') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Admin Area || '. Auth::user()->name }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('js/ajax_handler.js') }}" defer></script>
    <script src="{{ asset('js/init_events.js') }}" defer></script>
    <script src="{{ asset('js/fileinput.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/util.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery-ui.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap-select.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/awesome-bootstrap-checkbox.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('flag-icon-css-master/css/flag-icon.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="loading-spinner" style='display:none'>
        <div id="spinner"></div>
    </div> 
    <div id='notification' class='notification'>

    <i onclick='$(this).parent().hide()' class='fa fa-times' style='float:right;color:#c52121;'></i>
    <div align='center'>
        <i class="fa fa-check text-success"></i><span></span>
    </div>
    </div>

    <div id="app">
       <nav class="navbar navbar-expand-md navbar-light navbar-laravel" id='header'>
            <div class="container" >
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class='nav-item'>
                                  <a class="nav-link" href="{{ route('home') }}"> {{__('Welcome') }} {{ Auth::user()->name }}&nbsp;&nbsp;</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class='fa fa-bars'></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style='width: 100%;'>
                                        <a class='text-muted dropdown-item' href='#' onclick='newcatalog()'>{{ __('Import a catalog') }}</a>
                                        <a class='text-muted dropdown-item' href='#' onclick='mapping()'>{{ __('Catalog mapping') }}</a>
                                        <a class='text-muted dropdown-item' href='#' onclick='listcatalog()'>{{ __('My catalog entries') }}</a>
                                        <div class="dropdown-divider"></div>
                                        <a class='text-muted dropdown-item' href='#' onclick='page_layout()'>{{ __('Catalog layout') }}</a>
                                        <a class='text-muted dropdown-item' href='#' onclick='layouter()'>{{ __('Products\' layout') }}</a>
                                       <div class="dropdown-divider"></div>
                                        <a class='text-muted dropdown-item' href='#' onclick='publish()'>{{ __('My published catalog') }}</a>
                                        <a target='_blank' class='text-muted dropdown-item' href='{{str_replace("home","exported?u_id=".Auth::id(),Request::url())}}'>{{ __('Catalog public link') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 justify-content-center">
            <div class="col-md-12" id='product_zone'>       
                @yield('content')
            </div>
        </main>
         <nav class='sticky' id='footer'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                            <!-- Remove inline CSS -->
                             <label style='font-size: 14px;font-weight: normal;'>  &copy;2019 Henrique Figueiredo,&nbsp;{{ __('All Rights Reserved')  }}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="mailto:nf.henrique@gmail.com" >nf.henrique@gmail.com</a>
                            </label>
                         </div>
                        <div class='col-md-3'></div>

                </div>
            </div> 
        </nav>
    </div>
</body>
</html>
