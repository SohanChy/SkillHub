<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Welcome') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="{{ asset('style/muicss/mui.css') }}" rel="stylesheet">
    <link href="{{ asset('style/muicss/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('style/open/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link type="text/css" href="http://mmenu.frebsite.nl/mmenu/jquery.mmenu.all.css?v=6.1.8" rel="stylesheet" />


</head>
<body>

    <header class="mui-appbar mui--z1">
        <div class="mui-container">

            <table>
                <tr class="mui--appbar-height">
                    <td width="25%" class="mui--text-title">
                        <span class=" mui--hidden-sm mui--hidden-xs">SkillHub</span>
                        <a href="#menu" class="mui--text-subhead" style="margin-left:15px;">

                        <i class="mui--text-title fa fa-th" aria-hidden="true"></i>
                            <span class=" mui--hidden-sm mui--hidden-xs">
                            Categories
                            </span>
                        </a>
                    </td>
                    <td class=" mui--hidden-sm mui--hidden-xs">
                        <div class="search">
                            <input type="text" class="searchTerm" placeholder=" Search for a course...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </td>
                    <td width="25%" class="mui--text-right">
                        <ul class="mui-list--inline mui--text-body2">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a class="mui-btn mui-btn--primary mui-btn--small registerButton" href="{{ route('register') }}">Register</a></li>
                            @else
                                @component("open.layouts.logged_in_user_actions")
                                @endcomponent
                            @endif

                        </ul>
                    </td>
                </tr>
            </table>


    </div>
</header>

    <div id="content-wrapper" {{--class="mui--text-center"--}}>
        <div class="mui--appbar-height"></div>
        <br/>
        @yield('content')
    </div>
    @component("open.layouts.category_nav")
    @endcomponent
    <footer>
        <div class="mui-container-fluid">
            <div class="mui-container-fluid">
                <div class="mui-row mui--text-dark-secondary">
                    <div class="mui-col-md-4 mui--text-center">
                        <ul>
                            <li>About</li>
                            <li>Careers</li>
                            <li>Press</li>
                        </ul>
                    </div>
                    <div class="mui-col-md-4 mui--text-center">
                        <ul>
                            <li>About</li>
                            <li>Careers</li>
                            <li>Press</li>
                        </ul>
                    </div>
                    <div class="mui-col-md-4 mui--text-center">
                        <ul>
                            <li>©SkillHub 2017</li>
                        </ul>

                    </div>

                </div>
            </div>

        </div>
    </footer>
    <script src="{{ asset('style/muicss/mui.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="http://mmenu.frebsite.nl/mmenu/jquery.mmenu.all.js?v=6.1.8"></script>
    <script src="http://mmenu.frebsite.nl/mhead-plugin/mhead/jquery.mhead.js?v=6.1.8    "></script>
    <script src="{{ asset('js/nav_menu/nav.js') }}"></script>


</body>
</html>
