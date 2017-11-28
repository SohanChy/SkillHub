<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title or 'Teacher Dashboard' }}</title>

    <!-- Styles -->
    <link href="{{ asset('style/muicss/mui.css') }}" rel="stylesheet">
    <link href="{{ asset('style/muicss/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('style/muicss/dashboard/style.css') }}" rel="stylesheet"><link href="{{ asset('style/muicss/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<div id="sidedrawer" class="mui--no-user-select">
    <div id="sidedrawer-brand" class="mui--appbar-line-height">
        <span class="mui--text-title">Teacher</span>
    </div>
    <div class="mui-divider"></div>
    <ul>
        <li>
            <strong><i class="fa fa-fw fa-graduation-cap"></i> My Courses</strong>
            <ul>
                <li><a href="{{route('teacher.courses.create')}}"><i class="fa fa-fw fa-pencil"></i> Create</a></li>
                <li><a href="{{route('teacher.courses.index')}}?publish_status=published"><i class="fa fa-fw fa-graduation-cap"></i> Published</a></li>
                <li><a href="{{route('teacher.courses.index')}}?publish_status=draft"><i class="fa fa-fw fa-pencil-square"></i> Drafts</a></li>
            </ul>
        </li>
        <li>
            <strong>Category 2</strong>
            <ul>
                <li><a href="#">Item 1</a></li>
                <li><a href="#">Item 2</a></li>
                <li><a href="#">Item 3</a></li>
            </ul>
        </li>
        <li>
            <strong>Category 3</strong>
            <ul>
                <li><a href="#">Item 1</a></li>
                <li><a href="#">Item 2</a></li>
                <li><a href="#">Item 3</a></li>
            </ul>
        </li>
    </ul>
</div>

<header id="header">

    <div class="mui-appbar mui--appbar-line-height">
        <div class="mui-container-fluid">

            <div class="mui-row">
                <div class="mui-col-xs-7">
                    <a class="sidedrawer-toggle mui--visible-xs-inline-block mui--visible-sm-inline-block js-show-sidedrawer">☰</a>
                    <a class="sidedrawer-toggle mui--hidden-xs mui--hidden-sm js-hide-sidedrawer">☰</a>
                    <span class="mui--text-title">@yield('section_name')</span>
                </div>
                <div class="mui-col-xs-5 mui--text-right">

                    <ul class="mui-list--inline">
                        <li><a href="#" class="mui--text-light">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </a></li>
                        <li>
                            <div class="mui-dropdown">
                                <button class="mui-btn mui-btn--primary" data-mui-toggle="dropdown">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                    <span class="mui-caret"></span>
                                </button>
                                <ul class="mui-dropdown__menu">
                                    <li><a href="#">Course Noti 1</a></li>
                                    <li><a href="#">Course Noti 2</a></li>
                                    <li>
                                        <div class="mui-panel mui--text-dark">
                                            <i class="fa fa-globe"></i> Card noti works!
                                        </div>
                                    </li>
                                    <li><a href="#">Course Noti 4</a></li>
                                    <li><a href="#">Course Noti 5</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>


                </div>

            </div>

        </div>
    </div>

</header>

@yield("content")

<footer id="footer">
    <div class="mui-container-fluid">
        <br>
        {{--Made with ♥ by <a href="https://www.muicss.com">MUI</a>--}}
    </div>
</footer>


<script src="{{ asset('style/muicss/mui.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="{{ asset('style/muicss/dashboard/script.js') }}"></script>

</body>
</html>
