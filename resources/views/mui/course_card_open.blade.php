@if(!isset($course))
    @php $course = \App\Course::inRandomOrder()->first(); @endphp
@endif
<a href="{{url("courses/".$course->id."/".$course->urlSlug())}}">
<div class="{{$colWidth or 'mui-col-md-2'}}">
    <div class="mui-panel bare-card mui-btn--flat mui--z1">
        <img class="img-responsive mui--hidden-xs" src="{{$course->poster_file_id or url("uploads/maths.jpg")}}" alt="">
        <div class="card-content">

            <div class="card-body">
            <div class="mui--text-subhead">
                {{$course->title or "Title Not Provided for Course"}}
            </div>
            @php
            $teacher = $course->teachers()->first();
            @endphp
            <div class="mui--text-body2 mui--text-dark-secondary card-teacher-info">{{@$teacher->name . "," . substr(@$teacher->edu_stat,0,9)}}</div>
            </div>

            <div class="mui-row mui--hidden-xs">
                <div class="card-bottom-divider" style=""></div>
                <div class="mui-col-md-6 mui--text-left mui--text-title">
                    <span class="mui--text-caption mui--text-dark-secondary">
                        {{count($course->lessons)}} Lessons
                    </span>
                </div>
                <div class="mui-col-md-6 mui--text-right">

                    <span class="mui--text-title">
                    {{$course->rating}}<span class="mui--text-caption">/5</span> <span>★</span>
                    </span>

                </div>
            </div>

        </div>
    </div>
</div>
</a>