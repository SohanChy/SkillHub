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
    <link href="{{ asset('style/muicss/dashboard/style.css') }}" rel="stylesheet">
    <link href="{{ asset('style/teacher/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield("styleHead")

</head>
<body>

<div id="sidedrawer" class="sidedrawer mui--no-user-select">
    <div id="sidedrawer-brand" class="mui--appbar-line-height">
        <a class="mui--text-title mui--text-dark" href="{{url('/')}}">SkillHub</a>
    </div>
    <div class="mui-divider"></div>
    <ul>
        <li>
            <strong><i class="fa fa-fw fa-graduation-cap"></i> My Courses</strong>
            <ul>
                <li><a href="{{route('teacher.courses.index')}}?publish_status=published"><i class="fa fa-fw fa-graduation-cap"></i> Published</a></li>
                <li><a href="{{route('teacher.courses.index')}}?publish_status=draft"><i class="fa fa-fw fa-pencil-square"></i> Drafts</a></li>

            </ul>
        </li>

        <li>
            <strong><a href="{{route('teacher.courses.create')}}"><i class="fa fa-fw fa-pencil"></i> Create Course</a></strong>
        </li>

        <li>
            <strong><i class="fa fa-fw fa-television"></i> My Live Streams</strong>
            <ul>
                <li><a href="{{route('teacher.live-streams.index')}}?finish_status=0"><i class="fa fa-fw    fa-fighter-jet"></i> Upcoming</a></li>
                <li><a href="{{route('teacher.live-streams.index')}}?finish_status=1"><i class="fa fa-fw fa-fast-forward"></i> Archive</a></li>
            </ul>
        </li>

        <li>
            <strong><a href="{{route('teacher.live-streams.create')}}"><i class="fa fa-fw fa-pencil"></i> Create Live Stream</a></strong>
        </li>

    </ul>
</div>

    <header id="header">

        <div class="mui-appbar mui--appbar-line-height">
            <div class="mui-container-fluid">

                <div class="mui-row">
                    <div class="mui-col-xs-8">
                        <a class="sidedrawer-toggle mui--visible-xs-inline-block mui--visible-sm-inline-block js-show-sidedrawer">☰</a>
                        <a class="sidedrawer-toggle  mui--hidden-sm mui--hidden-xs js-hide-sidedrawer">☰</a>
                        <span class="mui--text-title">@yield('section_name')</span>
                    </div>
                    <div class="mui-col-xs-4 mui--text-right">

                                @component("open.layouts.logged_in_user_actions")
                                @endcomponent

                    </div>
                    {{--<div class="mui-col-md-1">--}}
                    {{--</div>--}}

                </div>

            </div>
        </div>

    </header>

    @yield("content")

{{--<footer id="footer">--}}
    {{--<div class="mui-container-fluid">--}}
        {{--<br>--}}
        {{--Made with ♥ by <a href="https://www.muicss.com">MUI</a>--}}
    {{--</div>--}}
{{--</footer>--}}


    <script src="{{ asset('style/muicss/mui.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script src="{{ asset('style/muicss/dashboard/script.js') }}"></script>

    @yield("scriptsFoot")

</body>
</html>
