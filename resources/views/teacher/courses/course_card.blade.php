@component('mui.card',
['title' => $course->title,'text'=>$course->small_description])

<a href="{{route('teacher.courses.edit', $course->id)}}" class="mui-btn mui-btn--flat mui-btn--accent">Edit</a>

<a href="{{ URL::to('/teacher/courses/'. $course->id) }}" class="mui-btn mui-btn--flat mui-btn--accent">Lessons</a>

@endcomponent