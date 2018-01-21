@extends('open.layouts.base')

@section('content')
    <div class="mui--text-center mui-container-fluid">


            <div class="mui-row mui--text-center">
                @foreach($streams as $stream)
                    <div class="mui-col-md-4">
                    @component('mui.card',
['title' => $stream->title . " by ". $stream->teacher->name,'text'=>$stream->description])

                        <button class="mui-btn">{{$stream->timeUntilString()}}</button>
                        <button class="mui-btn mui-btn--primary">Watch</button>


                    @endcomponent
                    </div>
                @endforeach

            </div>

    </div>
@endsection
