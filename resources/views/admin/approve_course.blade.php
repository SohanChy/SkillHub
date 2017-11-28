@extends('admin.layouts.base')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid"><br/>
		<div class="mui--text-display1">Course Title: {{$course->title}}</div>
		<div class="mui--text-dark mui--text-headline">{{$course->small_description}}</div>
		<div class="mui--text-dark mui--text-body2">{{$course->full_description}}</div><br/><br/>
		
		{!! Form::model($course, ['method' => 'PATCH', 'route' => ['admin.approval.update', $course->id]]) !!}
		
		<div class="mui-row">
			<div class="mui-col-md-4">
				<div class="mui-select">
					{!!
					Form::select('dicisionList',
					$dicisionList,
					null,
					['placeholder' => 'Choose..'])
					!!}
					<label>Approval dicision </label>
				</div>
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
@endsection