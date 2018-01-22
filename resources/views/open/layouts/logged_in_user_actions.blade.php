<ul class="mui-list--inline">
  <!--   <li>
        <div class="mui-dropdown">
            <button class="mui-btn mui-btn--small mui-btn--primary" data-mui-toggle="dropdown">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <span class="mui-caret"></span>
            </button>
            <ul class="mui-dropdown__menu mui-dropdown__menu--right">
                <li><a href="#">Course Noti 1</a></li>
                <li><a href="#">Course Noti 2</a></li>
                <li>
                    <div class="mui-panel mui--text-dark mui-btn--flat">
                        <i class="fa fa-globe"></i> Card noti works!
                    </div>
                </li>
                <li><a href="#">Course Noti 4</a></li>
                <li><a href="#">Course Noti 5</a></li>
            </ul>
        </div>
    </li> -->
    <div class="mui-dropdown">
        <button class="mui-btn mui-btn--small mui-btn--primary" data-mui-toggle="dropdown">
            {{ explode(" ", Auth::user()->name)[0] }} <span class="caret"></span>
            <span class="mui-caret"></span>
        </button>
        <ul class="mui-dropdown__menu mui-dropdown__menu--right">
            <li>
                <a href="{{ url(App\User::redirectRoleLogic()) }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route("profile.show","me") }}">
                    My Profile
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

</ul>