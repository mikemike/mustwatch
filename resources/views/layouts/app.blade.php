<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description')">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:title" content="@yield('og_title', 'Must Watch - Bookmark movies and TV shows to watch later')">
    <meta property="og:description" content="@yield('og_description', 'Never forget a film or TV show again.  Bookmark them to your list, and keep a record of what you have watched.')">
    <meta property="og:image" content="@yield('og_image', url('/assets/img/logo-og.png'))">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
    <link href="/assets/css/app.css" rel="stylesheet">
    
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#df691a">
    <meta name="theme-color" content="#df691a">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}

        function imgError(image) {
            image.onerror = "";
            image.src = "/assets/img/noimage.png";
            return true;
        }
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-91264631-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>
<body @if(Request::is('/')) class="home" @endif>
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
                        @include('partials.logo')
                        <span>{{ config('app.name') }}</span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    @if (Auth::guest())
                        <li><a href="/">Home</a></li>
                    @else 
                        <li><a href="/list/{{ Auth::user()->username }}">Your List</a></li>
                    @endif
                        <li><a href="/search">Search</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login / Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('account') }}">Account</a></li>
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

        <div class="container">

            @if(session('message'))
                <div class="alert alert-info fadein" role="alert">
                    <p>{{ session('message') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger fadein" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success fadein" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @yield('content')

        </div> <!-- .container -->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a href="/" class="logo-cont">
                            @include('partials.logo')
                            <p>
                                {{ config('app.name') }}
                            </p>
                        </a> <!-- .logo-cont -->
                        
                    </div>
                    <div class="col-md-6">
                        <div>
                            <ul class="list-inline pull-right">
                                <li>
                                    <a href="/search">Search</a>
                                </li>
                                <li>
                                    <a href="/contact">Contact</a>
                                </li>
                                <li>
                                    <a href="/about#faq">FAQ</a>
                                </li>
                                <li>
                                    <a href="/privacy-and-cookies">Privacy &amp; Cookies</a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        
                        <p class="text-right">&copy; {{ config('app.name') }} {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <!-- Scripts -->
    <script src="/assets/js/app.js"></script>

    <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
</body>
</html>
