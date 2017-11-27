@extends('layouts.app')

@section('content')
    <div class="mui-container-fluid">
        <div class="mui-row">
            <div class="mui-col-md-4 mui-col-md-offset-4">

                <div class="mui-panel">
                    <form method="POST" class="mui-form" action="{{ route('login') }}">
                        <legend>Login</legend>
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

@endsection
