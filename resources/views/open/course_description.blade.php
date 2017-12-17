@extends('open.layouts.base')

@section('content')

<div class="mui-container-fluid" style="margin: 0 15%">
	<div class="mui-row">
		<h2>UI/UX & Web Design using Adobe XD 2018</h2>
		<p>Daniel Scott,Adobe Certified Trainer & UI/UX Expert</p>
	</div>
	<div class="mui-row">
		<div class="vid-main-wrapper clearfix">

			<!-- THE YOUTUBE PLAYER -->
			<div class="vid-container">
				<iframe id="vid_frame" src="https://www.youtube.com/embed/cOSEOYi9JS4?rel=0&showinfo=0&autohide=1" frameborder="0" width="560" height="315"></iframe>
			</div>

			<!-- THE PLAYLIST -->
			<div class="vid-list-container">
				<ol id="vid-list">
					@for($i =1; $i<10; $i++)
					<li>
						@if($i == 1)
						<a href="javascript:void();" onClick="document.getElementById('vid_frame').src='https://youtube.com/embed/cOSEOYi9JS4?autoplay=1&rel=0&showinfo=0&autohide=1'">
							<div class="desc"><i class="fa fa-play" aria-hidden="true"></i> {{$i}}. WeatherBeater™ Product Video</div>
						</a>
						
						@else
						
						<a href="javascript:void();" onClick="document.getElementById('vid_frame').src='https://youtube.com/embed/cOSEOYi9JS4?autoplay=1&rel=0&showinfo=0&autohide=1'">
							<div class="desc"><i class="fa fa-lock" aria-hidden="true"></i> {{$i}}. WeatherBeater™ Product Video</div>
						</a>
						@endif
					</li>

					@endfor
					
				</ul>
			</div>

			
		</div>
	</div>

	<ul class="mui-tabs__bar">
		<li class="mui--is-active"><a data-mui-toggle="tab" data-mui-controls="pane-default-1">About</a></li>
		<li><a data-mui-toggle="tab" data-mui-controls="pane-default-2">Community</a></li>
		<li><a data-mui-toggle="tab" data-mui-controls="pane-default-3">Class projects</a></li>
		<li><a data-mui-toggle="tab" data-mui-controls="pane-default-4">All projects</a></li>
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
					<i class="fa fa-user-o fa-2x" aria-hidden="true">221</i>
					<p>Enrolled</p>
				</div>

				<div class="mui-col-md-4">
					<i class="fa fa-book fa-2x" aria-hidden="true">0</i>
					<p>Projects</p>
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
						the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way. When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then
					</p>

					<p>
						Far far away, behind the word mountains, far ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control aboutfrom the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
					</p><br/>
					
					<img src="https://imagejournal.org/wp-content/uploads/bb-plugin/cache/23466317216_b99485ba14_o-panorama.jpg" alt="" height="300px" width="600px">
					<br/><br/>
					<p>
						Far far away, behind the word mountains, far ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control aboutfrom the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
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
<div class="mui-tabs__pane" id="pane-default-3">

	<div class="mui-row"  style="margin-top:30px">
		<div class="mui-col-md-8">
			<div class="mui-col-md-8">
				<h4><strong>Class projects</strong></h4>
			</div>
		</div>
	</div>

	<div class="mui-row" >
		<div class="mui-col-md-10">
			<div class="mui-col-md-12">
				<img src="https://imagejournal.org/wp-content/uploads/bb-plugin/cache/23466317216_b99485ba14_o-panorama.jpg" alt="" height="300px" width="600px">
				
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
	<div class="mui-row"  style="margin-top:30px">
		<div class="mui-col-md-8">
			<div class="mui-col-md-8">
				<h4><strong>Class projects</strong></h4>
			</div>
		</div>
	</div>

	<div class="mui-row" >
		<div class="mui-col-md-10">
			<div class="mui-col-md-12">
				<img src="https://imagejournal.org/wp-content/uploads/bb-plugin/cache/23466317216_b99485ba14_o-panorama.jpg" alt="" height="300px" width="600px">
				
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

</div></div>


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



@endsection()