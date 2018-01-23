@extends('open.layouts.base')

@section('content')
<div class="mui--text-center mui-container-fluid">


	@foreach($categories as $category)
	<div class="mui-row mui--text-center">

		<div class="mui-row">
			
			@foreach($category->courses as $course)
			@component("mui.course_card_open",['course' => $course])
			@endcomponent
			@endforeach
			
		</div>

	</div>
	@endforeach

</div>
@endsection
