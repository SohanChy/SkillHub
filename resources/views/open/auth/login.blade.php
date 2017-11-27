@extends('open.layouts.base')

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
                        ['name' => 'mobile'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'password','type' => 'password'])
                        @endcomponent

                        <button type="submit" class="mui-btn mui-btn--raised">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
