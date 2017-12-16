@extends('open.layouts.base')

@section('content')
    <div class="mui--text-center frontCover">
        <div class="mui-row">
            <div class="mui-col-md-1"></div>
            <div class="mui-col-md-8">

                    <div class="frontCoverText">
                        <div class="mui-container-fluid mui--text-left mui--align-bottom">
                            <div class="mui--text-subhead"><strong>Learn by taking complete courses online</strong></div>
                            <div class="mui--text-body2">
                                No more Bananas, only mangoes.<br />
                                No more Bananas, only mangoes.
                            </div>
                            <button class="mui-btn mui-btn--small mui-btn--primary">Explore Courses</button>
                            <button class="mui-btn mui-btn--small mui-btn--primary">Take Tests</button>
                        </div>
                    </div>
            </div>

            <div class="mui-col-md-8">
            </div>

        </div>
    </div>


    <div class="mui-container-fluid courses-section">

        @for($i = 0; $i < 5; $i++)
        <br />
        <div class="mui--text-center">
            <h2>Top Courses</h2><br />
        </div>

        <div>
            <div class="mui-row">
                <div class="mui-col-md-1">
                </div>
                @for($j = 0; $j < 5; $j++)
                    @component("mui.course_card_open",['course' => null])
                    @endcomponent
                @endfor
                <div class="mui-col-md-1">
                </div>
            </div>
        </div>
        @endfor

    </div>
@endsection
