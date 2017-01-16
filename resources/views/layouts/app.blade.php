<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="/assets/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {{ json_encode([
            'csrfToken' => csrf_token(),
        ]) }}
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="app">
        <nav id="main-nav" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <header class="jumbo">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="header-content">
                            <div class="header-content-inner">
                                <h1>{{ config('app.name') }} helps you keep track of all the movies and TV you want to watch</h1>
                                <a href="{{ url('/register') }}" class="btn btn-outline btn-xl page-scroll">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        
                    </div>
                </div>
            </div>
        </header>

        <section id="download" class="download bg-primary text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="section-heading">Discover what all the buzz is about!</h2>
                        <p>Our app is available on any mobile device! Download now to get started!</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="features">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-heading">
                            <h2>Unlimited Features, Unlimited Fun</h2>
                            <p class="text-muted">Check out what you can do with this app theme!</p>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="device-container">
                            <div class="device-mockup iphone6_plus portrait white">
                                <div class="device">
                                    <div class="screen">
                                        <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                                        <img src="img/demo-screen-1.jpg" class="img-responsive" alt=""> </div>
                                    <div class="button">
                                        <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-screen-smartphone text-primary"></i>
                                        <h3>Device Mockups</h3>
                                        <p class="text-muted">Ready to use HTML/CSS device mockups, no Photoshop required!</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-camera text-primary"></i>
                                        <h3>Flexible Use</h3>
                                        <p class="text-muted">Put an image, video, animation, or anything else in the screen!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-present text-primary"></i>
                                        <h3>Free to Use</h3>
                                        <p class="text-muted">As always, this theme is free to download and use for any purpose!</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-lock-open text-primary"></i>
                                        <h3>Open Source</h3>
                                        <p class="text-muted">Since this theme is MIT licensed, you can use it commercially!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="cta-content">
                <div class="container">
                    <h2>Stop waiting.<br>Start building.</h2>
                    <a href="#contact" class="btn btn-outline btn-xl page-scroll">Let's Get Started!</a>
                </div>
            </div>
            <div class="overlay"></div>
        </section>

        <section id="contact" class="contact bg-primary">
            <div class="container">
                <h2>We <i class="fa fa-heart"></i> new friends!</h2>
                <ul class="list-inline list-social">
                    <li class="social-twitter">
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="social-facebook">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="social-google-plus">
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                    </li>
                </ul>
            </div>
        </section>

        <footer>
            <div class="container">
                <p>&copy; 2016 Start Bootstrap. All Rights Reserved.</p>
                <ul class="list-inline">
                    <li>
                        <a href="#">Privacy</a>
                    </li>
                    <li>
                        <a href="#">Terms</a>
                    </li>
                    <li>
                        <a href="#">FAQ</a>
                    </li>
                </ul>
            </div>
        </footer>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/assets/js/app.js"></script>
</body>
</html>
