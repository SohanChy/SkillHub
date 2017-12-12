@extends('open.layouts.base')

@section('content')
    <div class="mui-container-fluid">
        <div class="mui-row">
            <div class="mui-col-md-4 mui-col-md-offset-4">

                <div class="mui-panel">
                    <form method="POST" class="mui-form" action="profile">
                        <legend>Edit profile</legend>
                        {{ csrf_field() }}

                        @component('mui.errors',
                        ['errors' => $errors])
                        @endcomponent

                        <label>Name</label><br>
                        <input type="text" name="name" value="<?= $name ?>" style="min-width:100%;"> <br><br>

                        <label>Mobile</label><br>
                        <input type="text" name="mobile" value="<?= $mobile ?>" style="min-width:100%;"><br><br>

                        <label>Email</label><br>
                        <input type="email" name="email" value="<?= $email ?>" style="min-width:100%;"><br><br>



                        <div class="mui-select">
                            <label for="type">Type:</label>
                            <select id="type" name="type">
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                            </select>
                        </div>

                        @component('mui.textfield',
                        ['name' => 'previous_password','type' => 'password'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'new_password','type' => 'password'])
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