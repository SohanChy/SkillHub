@component('mui.card',
['title' => $course->title,'text'=>$course->small_description])

<button class="mui-btn mui-btn--flat" disabled>STATUS: {{\App\StatusHelper::getStatusString($course->admin_status,\App\Course::$adminStatusArr)}}</button>




<a href="{{route("teacher.courses.edit",$course->id)}}"
	class="mui-btn mui-btn--flat mui-btn--primary">Edit</a>
	<a href="{{ URL::to('/teacher/courses/'. $course->id) }}" class="mui-btn mui-btn--flat mui-btn--primary">Lessons</a>
	<a href="##" class="mui-btn mui-btn--flat mui-btn--primary">Students</a>

	@endcomponent