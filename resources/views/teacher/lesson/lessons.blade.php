@extends('teacher.layouts.base')
@section('section_name', 'Course')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container">

		<div class="mui-row" >
			<div class="mui-col-sm-10 mui-col-sm-offset-1">
				
				<div class="mui-divider"></div>
				<div class="mui--text-display1">{{ $lesson->short_description }}</div>
				<br/>
				<div class="mui-divider"></div>



				<!-- video listing -->
				<div class="mui-row">                
					@if(!$videos->isEmpty())
					<div class="mui-col-md-8"><div class="mui--text-headline" >Videos added: </div></div>
					@endif					
				</div>
				@if(!$videos->isEmpty())
				@foreach($videos as $video)
				<div class="card-example mui--z1">
					<div class="label">
						<div>
							{{ $video->name }}
						</div>
					</div>
					<div class="card-bottom-divider" style=""></div>
				</div>				
				@endforeach
				@endif


				<!-- document listing -->
				<div class="mui-row">                
					@if(!$documents->isEmpty())
					<div class="mui-col-md-8"><div class="mui--text-headline" >Documents added: </div></div>
					@endif					
				</div>				
				@if(!$documents->isEmpty())
				@foreach($documents as $document)
				<div class="card-example mui--z1">
					<div class="label">
						<div>
							{{ $document->name }}
						</div>
					</div>
					<div class="card-bottom-divider" style=""></div>
				</div>				
				@endforeach
				@endif


			</div>
		</div>


		<br>
		<br>
		
	</div>
</div>
@endsection