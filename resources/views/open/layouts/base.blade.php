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
                <td width="25%" class="mui--text-title">SkillHub
                    <a href="#menu" style="margin-left:15px;">
                        <span class="mui--text-subhead">
                        <i class="mui--text-title fa fa-th" aria-hidden="true"></i> Categories</span>
                    </a>
                </td>
                <td width="5%"></td>
                <td width="40%">
                    <div class="search">
                        <input type="text" class="searchTerm" placeholder=" Search for a course...">
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </td>
                <td width="5%"></td>
                <td width="25%" class="mui--text-right">
                    <ul class="mui-list--inline mui--text-body2">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a class="mui-btn mui-btn--primary mui-btn--small registerButton" href="{{ route('register') }}">Register</a></li>
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
                                        <a href="{{ route("profile.edit","me") }}">
                                            Edit My Profile
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

                    </ul>
                </td>
            </tr>
        </table>
    </div>
</header>

    <div id="content-wrapper" {{--class="mui--text-center"--}}>
        <div class="mui--appbar-height"></div>

        @yield('content')
    </div>


<div id="menu">
    <ul>

        <li>
            <span>Physics</span>
            <ul id="contacts-friends">
                <li class="img">
                    <a href="#/">
                        <img src="https://www.iconexperience.com/_img/o_collection_png/green_dark_grey/512x512/plain/atom2.png" style="background-color: #f66;" />
                        SSC Class 9 Physics Syllabus<br />
                        <small>Abdul Sir</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        SSC Class 10 Physics Syllabus<br />
                        <small>Rahim Sir</small>
                    </a>
                </li>

                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        SSC Class 10 Physics Syllabus<br />
                        <small>Rahim Sir</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        HSC Class 10 Physics Syllabus<br />
                        <small>Rahim Sir</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        HSC Class 10 Physics Syllabus<br />
                        <small>Rahim Sir</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        BSC Class 10 Physics Syllabus<br />
                        <small>Rahim Sir</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        SSC Class 10 Physics Syllabus<br />
                        <small>Rahim Sir</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        SSC Class 10 Physics Syllabus<br />
                        <small>Rahim Sir</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-3-b.png" style="background-color: #66f;" />
                        Carolyn<br />
                        <small>Garcia</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-4-b.png" style="background-color: #ff6;" />
                        Charles<br />
                        <small>Walker</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-5-b.png" style="background-color: #f6f;" />
                        Cheryl<br />
                        <small>Rivera</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-6-b.png" style="background-color: #6ff;" />
                        Harry<br />
                        <small>Stewart</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-1-b.png" style="background-color: #f66;" />
                        Janet<br />
                        <small>Clark</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        Jeffrey<br />
                        <small>White</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-3-b.png" style="background-color: #66f;" />
                        Jeremy<br />
                        <small>Green</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-4-b.png" style="background-color: #ff6;" />
                        Judith<br />
                        <small>Wright</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-5-b.png" style="background-color: #f6f;" />
                        Karen<br />
                        <small>Mitchell</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-6-b.png" style="background-color: #6ff;" />
                        Marie<br />
                        <small>Hill</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-1-b.png" style="background-color: #f66;" />
                        Martin<br />
                        <small>Parker</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        Mary<br />
                        <small>Watson</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-3-b.png" style="background-color: #66f;" />
                        Roy<br />
                        <small>Collins</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-4-b.png" style="background-color: #ff6;" />
                        Sean<br />
                        <small>Jenkins</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-5-b.png" style="background-color: #f6f;" />
                        Shirley<br />
                        <small>Bailey</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-6-b.png" style="background-color: #6ff;" />
                        Susan<br />
                        <small>James</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-1-b.png" style="background-color: #f66;" />
                        Virginia<br />
                        <small>Griffin</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        Willie<br />
                        <small>Bennett</small>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <span>Chemistry</span>
            <ul id="contacts-family">
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-3-b.png" style="background-color: #f66;" />
                        Benjamin<br />
                        <small>Kelly</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-4-b.png" style="background-color: #6f6;" />
                        Brenda<br />
                        <small>Price</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-5-b.png" style="background-color: #66f;" />
                        Eric<br />
                        <small>Hughes</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-6-b.png" style="background-color: #ff6;" />
                        Gloria<br />
                        <small>Jones</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-1-b.png" style="background-color: #f6f;" />
                        Jean<br />
                        <small>Gray</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6ff;" />
                        Kenneth<br />
                        <small>Rogers</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-3-b.png" style="background-color: #f66;" />
                        Mark<br />
                        <small>Bell</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-4-b.png" style="background-color: #6f6;" />
                        Martha<br />
                        <small>King</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-5-b.png" style="background-color: #66f;" />
                        Nicole<br />
                        <small>Murphy</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-6-b.png" style="background-color: #ff6;" />
                        Pamela<br />
                        <small>Campbell</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-1-b.png" style="background-color: #f6f;" />
                        Paula<br />
                        <small>Morris</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6ff;" />
                        Randy<br />
                        <small>Sanders</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-3-b.png" style="background-color: #f66;" />
                        Teresa<br />
                        <small>Powell</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-4-b.png" style="background-color: #6f6;" />
                        Walter<br />
                        <small>Howard</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-5-b.png" style="background-color: #66f;" />
                        Wanda<br />
                        <small>Lee</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-6-b.png" style="background-color: #ff6;" />
                        Wayne<br />
                        <small>Turner</small>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <span>Web Development</span>
            <ul id="contacts-work-colleagues">
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-1-b.png" style="background-color: #f66;" />
                        Anthony<br />
                        <small>Roberts</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        Daniel<br />
                        <small>Gonzalez</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-3-b.png" style="background-color: #66f;" />
                        Deborah<br />
                        <small>Brown</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-4-b.png" style="background-color: #ff6;" />
                        Joan<br />
                        <small>Torres</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-5-b.png" style="background-color: #f6f;" />
                        Johnny<br />
                        <small>Miller</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-6-b.png" style="background-color: #6ff;" />
                        Kelly<br />
                        <small>Russell</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-1-b.png" style="background-color: #f66;" />
                        Kevin<br />
                        <small>Morgan</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="https://raw.githubusercontent.com/stvhwrd/icons/master/atom/Atom-no_shadows-512.png" style="background-color: #6f6;" />
                        Marilyn<br />
                        <small>Robinson</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-3-b.png" style="background-color: #66f;" />
                        Ralph<br />
                        <small>Scott</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-4-b.png" style="background-color: #ff6;" />
                        Rebecca<br />
                        <small>Jackson</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-5-b.png" style="background-color: #f6f;" />
                        Tina<br />
                        <small>Phillips</small>
                    </a>
                </li>
                <li class="img">
                    <a href="#/">
                        <img src="img/profile-6-b.png" style="background-color: #6ff;" />
                        William<br />
                        <small>Barnes</small>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
    <footer>
        <div class="mui-container mui--text-center">
            {{--Made with ♥ by <a href="https://www.muicss.com">MUICSS</a>--}}
        </div>
    </footer>
    <script src="{{ asset('style/muicss/mui.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="http://mmenu.frebsite.nl/mmenu/jquery.mmenu.all.js?v=6.1.8"></script>
    <script src="http://mmenu.frebsite.nl/mhead-plugin/mhead/jquery.mhead.js?v=6.1.8    "></script>

    <script type="text/javascript">
        $(function() {

            $("#menu").mmenu({
                extensions 		: [ "theme-white", "pagedim-black" ],
                dropdown 		: true,
                counters		: true,
                dividers		: {
                    add				: true,
                    addTo			: "[id*='contacts-']",
                    fixed			: true
                },
                searchfield		: {
                    resultsPanel	: false
                },
                sectionIndexer	: {
                    add				: true,
                    addTo			: "[id*='contacts-']"
                },
                navbar			: {
                    title			: "Categories"
                },
                navbars		: [{
                    content: ["searchfield"]
                }, true]
                },
                {
                dropdown: {
                    offset: {
                        button: {
                            y: $( ".mui--appbar-height" ).height() - 25
                        }
                    }
                } });
            $(".mh-head.mm-sticky").mhead({
                scroll: {
                    hide: 200
                }
            });
            $(".mh-head:not(.mm-sticky)").mhead({
                scroll: false
            });


        });
    </script>

</body>
</html>
