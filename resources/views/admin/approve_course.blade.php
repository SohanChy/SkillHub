@extends('admin.layouts.base')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid">
        <div class="mui-panel">

            <div class="mui--text-title mui--divider-bottom"><h2>Course Title:</h2> {{$course->title}}</div><br/><br/>
            <div class="mui--text-dark mui--text-body2 mui--divider-bottom"><h2>Short description:</h2>{{$course->small_description}}</div><br/><br/>
            <div class="mui--text-dark mui--text-body2 mui--divider-bottom"><h2>Full description:</h2>{!! $course->full_description !!}</div><br/><br/>

            <div class="mui-row" >
                <div class="mui-col-md-10">
                    @if(!$course->lessons->isEmpty())
                    @foreach(@$course->lessons as $lesson)
                    <div class="mui-panel">
                        <h3>{{ $loop->iteration }}. {{@$lesson->title}}</h3>
                        <p>{{@$lesson->short_description}}</p>
                    </div>
                    
                    @endforeach
                    @else
                    <div class="mui--text-dark mui--text-body2 mui--divider-bottom"><h2>No lessons to show!</h2></div><br/><br/>
                    @endif
                </div>
            </div> 


            {!! Form::model($course, ['method' => 'PATCH', 'route' => ['admin.approval.update', $course->id]]) !!}

            <div class="mui-row">
                <div class="mui-col-md-4">
                    @component('mui.select',
                    ['name' => 'admin_status', 'list' => $decisionList,'label' => 'Approval Status'])
                    @endcomponent
                </div>
            </div>



            <div class="mui-row">
                <div class="mui-col-md-4">
                    <div class="mui--text-left">
                        <button type="submit" class="mui-btn mui-btn--raised mui-btn--primary">Save</button>
                    </div>
                </div>
            </div>

            
            {!! Form::close() !!}

        </div>
    </div>
</div>
</div>
@endsection