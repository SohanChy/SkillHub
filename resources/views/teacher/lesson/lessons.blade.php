@extends('teacher.layouts.base')
@section('section_name', 'Course')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	
	<div class="mui-container-fluid">
		
		<h3>{{$lesson->title}}</h1>
			<div class="mui-panel">
				<h4><strong>Lesson Description:</strong></h4>
				<p>{{$lesson->short_description}}</p>
				
				<h4><strong>Containing video:</strong></h4>

				<div class="mui-row">
					<div class="vid-main-wrapper clearfix">
						<!-- THE YOUTUBE PLAYER -->
						<div class="vid-container-teacher" >
							
							<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
							controls preload="auto" height="315" width="560">
							<source src="{{URL::to('/teacher/get-video/'.$lesson->video_file_id)}}"/>
							</video>

						</div>
					</div>
				</div>

				<!-- THE YOUTUBE PLAYER -->
				<h5><strong>Lesson text:</strong></h5>
				{!! html_entity_decode($lesson->lesson_text) !!}
				
				<h5><strong>Attachments:</strong></h5>
				@foreach($documents as $document)
				{{$document->name}}<br>										
				@endforeach
			</div>

		</div>


		


	</div>


	<script>
		/*JS FOR SCROLLING THE ROW OF THUMBNAILS*/ 
		$(document).ready(function () {
		$('.vid-item').each(function(index){
		$(this).on('click', function(){
		var current_index = index+1;
		$('.vid-item .thumb').removeClass('active');
		$('.vid-item:nth-child('+current_index+') .thumb').addClass('active');
	});
});
});
</script>

</div>
@endsection