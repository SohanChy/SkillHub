@extends('teacher.layouts.base')

@section('content')
    <div id="content-wrapper">
        <div class="mui--appbar-height"></div>
        <div class="mui-container-fluid">

            @if($stream->exists)
                <h2>Edit Live Stream</h2>
                {!! Form::model($stream, ['method' => 'put','route' => ['teacher.live-streams.update', $stream->id]]) !!}
            @else
                <h2>Create Live Stream</h2>
                {!! Form::model($stream, ['route' => ['teacher.live-streams.store',$stream->id]]) !!}
            @endif

            <div class="mui-panel">
                @component('mui.errors',
                ['errors' => $errors])
                @endcomponent

                @component('mui.textfield',
                ['name' => 'title', 'value' => $stream->name])
                @endcomponent


                    <div class="mui-textfield">
                        {!! Form::text("date_time",null,['id' => "datetimepicker"]) !!}
                        <label>Stream Date & Time</label>
                    </div>

                @component('mui.textfield',
                ['name' => 'description',
                 'value' => $stream->description,
                 'type' => 'textarea'
                 ])
                @endcomponent



                <div class="mui-select">
                    {!!
                    Form::select('finish_status',
                    ["Upcoming","Finished"],
                    null,
                    ['placeholder' => 'Pick a Status...'])
                    !!}
                    <label>Status</label>
                </div>

                <div class="mui--text-right">
                    <button type="submit" class="mui-btn mui-btn--raised mui-btn--primary">Save</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection

@section('scriptsFoot')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('js/datetimepicker/jquery.datetimepicker.min.css') }}" >

    <script src="{{ asset('js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script>
        jQuery('#datetimepicker').datetimepicker({
        });
    </script>
@endsection