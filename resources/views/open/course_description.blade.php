@extends('open.layouts.base')

@section('content')

@php
$teacher = $course->teachers()->first();
@endphp


<div class="mui-container-fluid" style="margin: 0 15%">
	<div class="mui-row">
		<h2>{{$course->title}}</h2>
	</div>
	<div class="mui-row">
		<div class="mui-col-md-8 nopadding">
			<p>{{trim($course->small_description)}}</p>
		</div>
		<div class="mui-col-md-4">
			<h1 class="pull-right">৳{{$course->price}}</h1>
		</div>
	</div>
	<div class="mui-row">
		<div class="mui--text-body1 mui--text-dark-secondary card-teacher-info nopadding" >By- {{@$teacher->name}}</div>
	</div>
	<br />
	

	<div class="mui-row">
		<div class="vid-main-wrapper clearfix">

			<!-- THE YOUTUBE PLAYER -->
			<div class="vid-container">
				<video poster="/path/to/poster.jpg" controls>
					<source src="" type="video/mp4">	
					</video>
				</div>

				<!-- THE PLAYLIST -->
				<div class="vid-list-container">
					<ol id="vid-list">
						@foreach($course->lessons as $lessons)
						<li>
							@if($loop->iteration == 1)
							<a href="javascript:void();" value="{{ $lessons->video->path }}">
								<div class="desc"><i class="fa fa-play" aria-hidden="true"></i> {{$loop->iteration}}. {{ $lessons->title }}</div>
							</a>
							
							@else
							
							<a href="{{URL::to('courses/'.$course->id.'/lesson/'.$lessons->id)}}" value="{{ $lessons->video->path }}">
								<div class="desc"><i class="fa fa-lock" aria-hidden="true"></i> {{$loop->iteration}}. {{ $lessons->title }}</div>
							</a>
							@endif
						</li>

						@endforeach
						
					</ul>
				</div>

				
			</div>
		</div>

		<ul class="mui-tabs__bar">
			<li class="mui--is-active"><a data-mui-toggle="tab" data-mui-controls="pane-default-1">About</a></li>
			<li><a data-mui-toggle="tab" data-mui-controls="pane-default-2">Community</a></li>
			<li><a data-mui-toggle="tab" data-mui-controls="pane-default-3">Teachers</a></li>
			<li><a data-mui-toggle="tab" data-mui-controls="pane-default-4">Course Syllebus</a></li>
		</ul>


		<div class="mui-tabs__pane mui--is-active" id="pane-default-1">

			<div class="mui-row" style="margin-top:30px">
				<div class="mui-col-md-8">
					<div class="mui-col-md-8">
						<h4><strong>About the course</strong></h4>
					</div>
					<div class="mui-col-md-4">
						<button type="" class="mui-btn mui-btn--primary">Join <i class="fa fa-arrow-down" aria-hidden="true"></i></button>
					</div>
				</div>
				<div class="mui-col-md-4">
					<div class="mui-col-md-4">
						<i class="fa fa-user-o fa-2x" aria-hidden="true">220</i>
						<p>Enrolled</p>
					</div>

					<div class="mui-col-md-4">
						<i class="fa fa-book fa-2x" aria-hidden="true">{{$course->lessons->count()}}</i>
						<p>Lessons</p>
					</div>

					<div class="mui-col-md-4">
						<i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true">100</i>
						<p>Reviews</p>
					</div>
				</div>
			</div>
			

			<div class="mui-row" >
				<div class="mui-col-md-8">
					<div class="mui-col-md-8">
						<h4><strong>Overview</strong></h4>
					</div>
				</div>
			</div>

			<div class="mui-row" >
				<div class="mui-col-md-10">
					<div class="mui-col-md-12">
						<p>
							{{$course->small_description}}
						</p><br/>
						
					<!-- <img src="https://imagejournal.org/wp-content/uploads/bb-plugin/cache/23466317216_b99485ba14_o-panorama.jpg" alt="" height="300px" width="600px">
					<br/><br/>
				-->
				<p>
					{{$course->full_description}}
				</p>
			</div>
		</div>
	</div>



</div>
<div class="mui-tabs__pane" id="pane-default-2">
	<div class="mui-row"  style="margin-top:30px">
		<div class="mui-col-md-8">
			<div class="mui-col-md-8">
				<h4><strong>Community</strong></h4>
			</div>
		</div>
	</div>

	<div class="mui-row" >
		<div class="mui-col-md-10">
			<div class="mui-col-md-12">
				<p>
					the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way. When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then
				</p>

				<p>
					Far far away, behind the word mountains, far ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control aboutfrom the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
				</p><br/>
				Far far away, behind the word mountains, far ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control aboutfrom the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
			</p>
		</div>
	</div>
</div>


</div>
<div class="mui-tabs__pane" id="pane-default-4">

	<div class="mui-row"  style="margin-top:30px"></div>

	<div class="mui-row" >
		<div class="mui-col-md-10">
			<div class="mui-col-md-12">
				@foreach($course->lessons as $lesson)
				<div class="mui-panel">
					<h3>{{ $loop->iteration }}. {{$lesson->title}}</h3>
					<p>{{$lesson->short_description}}</p>
				</div>
				
				@endforeach
			</div>
		</div>
	</div>					
</div>


<div class="mui-tabs__pane" id="pane-default-3">
	<div class="mui-row"  style="margin-top:30px"></div>

	<div class="mui-row" >
		<div class="mui-col-md-10">
			<div class="mui-col-md-4">
				<img src="https://imagejournal.org/wp-content/uploads/bb-plugin/cache/23466317216_b99485ba14_o-panorama.jpg" alt="" height="200px" width="200px">
			</div>
			<div class="mui-col-md-8">
				
				<h2>
					{{@$teacher->name}}	
				</h2>
				<div class="mui--text-body2 mui--text-dark-secondary card-teacher-info">{{@$teacher->edu_stat}}</div>
				<p>{{$teacher->bio}}</p>
			</div>
		</div>
	</div>
	
	<div class="mui-row" >
		<div class="mui-col-md-12">
			<div class="mui-col-md-12">
				<br />
				<div class="mui--text-center">
					<h2>More Courses from same teacher</h2><br />
				</div>

				<div>
					<div class="mui-row">
						@for($j = 0; $j < 6; $j++)
						@component("mui.course_card_open",['course' => $teacher->courses])
						@endcomponent
						@endfor
						<div class="mui-col-md-1">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>





<div class="mui-row" >
	<div class="mui-col-md-12">
		<div class="mui-col-md-12">
			<br />
			<div class="mui--text-center">
				<h2>Similer Courses <button class="mui-btn mui-btn--flat">See More</button></h2><br />
			</div>

			<div>
				<div class="mui-row">
					@for($j = 0; $j < 6; $j++)
					@component("mui.course_card_open",['course' => null])
					@endcomponent
					@endfor
					<div class="mui-col-md-1">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



</div>

<link rel="stylesheet" href="https://cdn.plyr.io/2.0.18/plyr.css">
<script src="https://cdn.plyr.io/2.0.18/plyr.js"></script>


<script>
	plyr.setup();
</script>



@endsection()