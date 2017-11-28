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
    <link href="{{ asset('style/muicss/mui.css') }}" rel="stylesheet">
    <link href="{{ asset('style/open/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

    <header class="mui-appbar mui--z1">
        <div class="mui-container">
            <table>
                <tr class="mui--appbar-height">
                    <td class="mui--text-title">Brand.io</td>
                    <td class="mui--text-right">
                        <ul class="mui-list--inline mui--text-body2">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                                <div class="mui-dropdown">
                                    <button class="mui-btn mui-btn--primary" data-mui-toggle="dropdown">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                        <span class="mui-caret"></span>
                                    </button>
                                    <ul class="mui-dropdown__menu">
                                        <li>
                                            <a href="{{ url(App\User::redirectRoleLogic()) }}">
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            <li><a href="#">Courses</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">About</a></li>

                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    </header>

    <div id="content-wrapper" {{--class="mui--text-center"--}}>
        <div class="mui--appbar-height"></div>
        <br />
        @yield('content')

    </div>


    <footer>
        <div class="mui-container mui--text-center">
            {{--Made with ♥ by <a href="https://www.muicss.com">MUICSS</a>--}}
        </div>
    </footer>
    <script src="{{ asset('style/muicss/mui.js') }}"></script>


</body>
</html>
