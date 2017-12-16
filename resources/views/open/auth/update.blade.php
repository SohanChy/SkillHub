@extends('open.layouts.base')

@section('content')
    <div class="mui-container-fluid">
        <div class="mui-row">
            <div class="mui-col-md-4 mui-col-md-offset-4">

                <div class="mui-panel">

                    <form method="post" action="/profile" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <img src="/img/profile/{{$user->pro_pic}}" width="100%"><br><br>
                        <input type="file" name="file"><br><br>


                        <label>Name</label><br>
                        <input type="text" name="name" value="<?= $user->name ?>" style="min-width:100%;"> <br><br>

                        <label>Mobile</label><br>
                        <input type="text" name="mobile" value="<?= $user->mobile ?>" style="min-width:100%;"><br><br>

                        <label>Email</label><br>
                        <input type="email" name="email" value="<?= $user->email ?>" style="min-width:100%;"><br><br>

                        @component('mui.textfield',
                        ['name' => 'previous_password','type' => 'password'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'new_password','type' => 'password'])
                        @endcomponent

                        @component('mui.textfield',
                        ['name' => 'new_password_confirmation','type' => 'password'])
                        @endcomponent
                        <input type="submit" name="" value="upload">


                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection