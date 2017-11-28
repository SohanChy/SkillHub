@component('mui.card',
            ['title' => $course->title,'text'=>$course->small_description])

    <a class="mui-btn mui-btn--flat mui-btn--accent">Edit</a>
    <a class="mui-btn mui-btn--flat mui-btn--accent">Lessons</a>
    <a class="mui-btn mui-btn--flat mui-btn--accent">Delete</a>
@endcomponent