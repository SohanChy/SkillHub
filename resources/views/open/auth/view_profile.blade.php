@extends('open.layouts.base')

@section('content')
    <div class="mui-container-fluid">
        <div class="mui-row">
            <div class="mui-col-md-4 mui-col-md-offset-4">

                <div class="mui-panel">
                    <h2 class="mui--text-center">Your Profile</h2>
                    <img class="img-thumb" src="{{$user->pro_pic_url}}" width="100%"><br>
                    <h4>Name:     {{$user->name}}</h4><hr>
                    <h4>Status:   {{$user->role}}</h4><hr>
                    <h4>Email:    {{$user->email}}</h4><hr>
                    <h4>Mobile:   {{$user->mobile}}</h4><hr>
                    <div class="mui--text-right">
                    <a class="mui-btn mui-btn--primary mui-btn--raised" href="{{ route("profile.edit","me") }}">
                        Edit Profile
                    </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection