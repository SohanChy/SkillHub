@component('mui.card',
['text'=>$lesson->short_description])

<a href="{{route('teacher.lesson.edit', $lesson->id)}}" class="mui-btn mui-btn--flat mui-btn--accent">Edit</a>

<a href="{{ URL::to('/teacher/lesson/'. $lesson->id) }}" class="mui-btn mui-btn--flat mui-btn--accent">Details</a>

@endcomponent