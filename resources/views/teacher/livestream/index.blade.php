@extends('teacher.layouts.base')
@section('section_name', 'Courses')

@section('content')
	<div id="content-wrapper">
		<div class="mui--appbar-height"></div>
		<div class="mui-container-fluid">
			<h3>Your Live Streams</h3>
			@foreach($livestreams as $stream)
				@component("teacher.livestream.stream_card",['stream' => $stream])
				@endcomponent
			@endforeach
		</div>
	</div>
@endsection