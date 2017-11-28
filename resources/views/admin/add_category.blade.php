@extends('admin.layouts.base')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid">
		{!! Form::open(['url' => 'foo/bar']) !!}
		echo Form::label('email', 'E-Mail Address');
		echo Form::email($name, $value = null, $attributes = []);
		
		{!! Form::close() !!}
	</div>
</div>
@endsection