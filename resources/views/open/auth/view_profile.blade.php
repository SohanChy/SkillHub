@extends('open.layouts.base')

@section('content')
    <div class="mui-container-fluid">
        <div class="mui-row">
            <div class="mui-col-md-4 mui-col-md-offset-4">

                <div class="mui-panel">
                    <h2>Your Profile</h2>
                    <img src="/img/profile/{{$user->pro_pic}}" width="100%"><br>
                    <h4>Name:     {{$user->name}}</h4><hr>
                    <h4>Status:   {{$user->role}}</h4><hr>
                    <h4>Email:    {{$user->email}}</h4><hr>
                    <h4>Mobile:   {{$user->mobile}}</h4><hr>
                    <a href="{{ route("profile.edit","me") }}">
                        Edit Profile</a>
                </div>

            </div>
        </div>
    </div>

@endsection