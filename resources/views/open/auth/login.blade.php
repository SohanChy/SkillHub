@extends('open.layouts.base')

@section('content')
<br />
<div class="mui-container-fluid">
    <div class="mui-row">
        <div class="mui-col-md-4 mui-col-md-offset-4">

            <div class="mui-panel">
                <div class="mui--text-title mui--text-center">Please Login or Register First!</div>

                <ul class="mui-tabs__bar mui-tabs__bar--justified">
                    <li class="mui--is-active">
                        <a data-mui-toggle="tab" data-mui-controls="pane-justified-login">Login</a></li>
                    <li><a data-mui-toggle="tab" data-mui-controls="pane-justified-register">Register</a></li>
                </ul>
                <div class="mui-tabs__pane mui--is-active" id="pane-justified-login">
                    <form method="POST" class="mui-form" action="{{ route('login') }}">
                        {{--<legend>Login</legend>--}}
                        {{ csrf_field() }}

                        @component('mui.errors',
                        ['errors' => $errors])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'mobile'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'password','type' => 'password'])
                        @endcomponent

                        <button type="submit" class="mui-btn mui-btn--raised">Submit</button>
                    </form>
                </div>
                <div class="mui-tabs__pane" id="pane-justified-register">
                    <form method="POST" class="mui-form" action="{{ route('register') }}">
                        {{--<legend>Register</legend>--}}
                        {{ csrf_field() }}

                        @component('mui.errors',
                        ['errors' => $errors])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'name'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'mobile'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'email','type' => 'email'])
                        @endcomponent

                        <div class="mui-select">
                            <label for="type">Type:</label>
                            <select id="type" name="type">
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                            </select>
                        </div>

                        @component('mui.textfield',
                        ['name' => 'password','type' => 'password'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'password_confirmation','type' => 'password'])
                        @endcomponent

                        <button type="submit" class="mui-btn mui-btn--raised">Submit</button>
                    </form>
                </div>



            </div>

        </div>
    </div>
</div>
@endsection
