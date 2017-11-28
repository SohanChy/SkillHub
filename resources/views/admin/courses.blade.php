@extends('admin.layouts.base')

@section('content')
<div id="content-wrapper">
	<div class="mui--appbar-height"></div>
	<div class="mui-container-fluid">
		<div class="mui-panel">
		<table class="mui-table">
			<thead>
				<tr>
					<th>Course name</th>
					<th>Short description</th>
					<th>Date</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($courses as $course)
				<tr>
					<td>{{$course->title}}</td>
					<td>{{$course->small_description}}</td>
					<td>{{$course->created_at}}</td>


					<td>{{\App\StatusHelper::getStatusString($course->admin_status,\App\Course::$adminStatusArr)}}</td>

					<td><a class="mui-btn" href="{{URL::to('admin/approval/' . $course->id)}}">Details</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>

	</div>
</div>
</div>
@endsection