@extends('admin.layouts.base')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid">
        <div class="mui-panel">

            <div class="mui--text-title mui--divider-bottom">Course Title: {{$course->title}}</div>
            <div class="mui--text-dark mui--text-body2 mui--divider-bottom">{{$course->small_description}}</div>
            <div class="mui--text-dark mui--text-body2 mui--divider-bottom">{{$course->full_description}}</div><br/><br/>

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