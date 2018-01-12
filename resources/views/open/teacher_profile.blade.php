@extends('open.layouts.base')

@section('content')
    <div class="mui-container-fluid" >
        <div class="mui-row">
            <div class="mui-col-md-10 mui-col-md-offset-1">
                <div class="mui-panel" style="text-align: center; background-color: ">
                    <div class="mui-col-md-6 mui-col-md-offset-3" style="background-color: ">
                        <img class="" src="https://www.w3schools.com/bootstrap4/img_avatar3.png" style="width: 40%;">
                        <h2>{{ $teacher_name }}</h2>
                        <h3>Rating: 5/3.5 ★</h3>
                        <h4>Do what you have to do until you can do what you want do</h4>

                    </div>

                    <div class="mui-col-md-12 mui-col-md-offset-0" style="padding-top: 5%;">
                        <h2>Courses taken</h2><br><br>

                        @for($j = 0; $j < 10; $j++)
                            @component("mui.course_card_open",['course' => null])
                            @endcomponent
                        @endfor

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
