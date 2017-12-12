@extends('open.layouts.base')

@section('content')
    <div class="mui-container-fluid">
        <div class="mui-row">
            <div class="mui-col-md-4 mui-col-md-offset-4">

                <div class="mui-panel">
                    {!! Form::model($user, ['method' => 'PATCH','route' => ['profile.update',"me"]]) !!}
                        <legend>Edit profile</legend>

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

                        @component('mui.textfield',
                        ['name' => 'previous_password','type' => 'password'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'new_password','type' => 'password'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'new_password_confirmation','type' => 'password'])
                        @endcomponent

                        <button type="submit" class="mui-btn mui-btn--raised">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection