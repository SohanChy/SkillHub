@extends('open.layouts.base')
@section('content')
<div class="mui--text-center frontCover">
    <div class="mui-row">
        <div class="mui-col-md-1"></div>
        <div class="mui-col-md-4">

            <div class="frontCoverText">
                <div class="mui-container-fluid mui--text-left mui--align-bottom">
                    <div class="mui--text-subhead"><strong>Learn by taking complete courses online</strong></div>
                    <div class="mui--text-body2">
                        Courses Covering Topics In Detail.<br />
                        Livestreams covering exclusive Talks & Lectures.
                    </div>
                    <button class="mui-btn mui-btn--small mui-btn--primary">Explore Courses</button>
                    <a href="{{url('live-streams')}}">
                        <button class="mui-btn mui-btn--small mui-btn--accent">Live Streams</button>
                    </a>
                    {{--<button class="mui-btn mui-btn--small mui-btn--primary">Take Tests</button>--}}
                </div>
            </div>
        </div>

        <div class="mui-col-md-7">
        </div>

    </div>
</div>


<div class="mui-container-fluid courses-section">

    @foreach($frontPageContents as $title => $courseList)
    <br />
    <div class="mui--text-center">
        <h2>{{$title}} {{--<button class="mui-btn mui-btn--flat">See More</button>--}}</h2><br />
    </div>

    <div>
        <div class="mui-row">
            <div class="mui-col-md-1">
            </div>
            @foreach($courseList as $course)
            @component("mui.course_card_open",['course' => $course])
            @endcomponent
            @endforeach
            <div class="mui-col-md-1">
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
