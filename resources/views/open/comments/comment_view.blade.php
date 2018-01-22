@if(count($comments) == 0)
    <div class="mui-container-fluid">
        <div class="mui-row mui-panel">
            No Comments/Reviews Yet.
        </div>
    </div>
@else


@php
    $isCourse = false;
    if($comments->first()->commentable_type == "App\Course"){
        $isCourse = true;
    }
@endphp

@foreach($comments as $singleComment)
    <div class="mui-container-fluid">
        <div class="mui-row mui-panel comment-panel">
            <div class="mui-col-xs-3">
                <img class="img-pro-pic" src="{{$singleComment->commented->pro_pic_url}}">.
                <div class="mui-divider"></div>
                {{$singleComment->commented->name}} - {{ucfirst($singleComment->commented->role)}}
            </div>
            <div class="mui-col-xs-9">
                @if(Auth::check())

                    <div class="mui-row mui--text-right">
                        <div class="mui-col-md-8"></div>
                        @if(!$isCourse)
                        <div class="mui-col-md-2">
                                <button class="mui-btn mui-btn--primary" onclick="showReplyForm({{$singleComment->id}})"><i class="fa fa-fw fa-reply"></i> Reply</button>
                        </div>
                        @endif
                    @if($isCourse)
                        <div class="mui-col-md-2">
                                <div class="mui--text-left">
                            <span class="mui--text-title">
                                {{$singleComment->rate}}<span class="mui--text-subhead">/5</span> <span>★</span>
                            </span>
                                </div>
                        </div>
                        @endif

                        @if($user->id == $singleComment->commented->id)
                        <div class="mui-col-md-2">
                                <button class="mui-btn " onclick="showEditForm({{$singleComment->id}})"><i class="fa fa-fw fa-pencil"></i></button>
                        </div>
                        @endif
                    </div>

                @endif



                {{$singleComment->comment}}


            </div>
        </div>

        @if(!$isCourse)

        @php
            $childComments = \App\Comment::childComments($singleComment->id);
        @endphp

        <div class="mui-container-fluid child-comment">
            <div id="parent-comment-id-{{$singleComment->id}}" >
            </div>
        @if(count($childComments) > 0)
            @foreach($childComments as $singleComment)

                    <div class="mui-row mui-panel comment-panel">
                        <div class="mui-col-xs-3">
                            <img class="img-pro-pic" src="{{$singleComment->commented->pro_pic_url}}">.
                            <div class="mui-divider"></div>
                            {{$singleComment->commented->name}} - {{ucfirst($singleComment->commented->role)}}
                        </div>
                        <div class="mui-col-xs-9">
                            @if(Auth::check())
                            <div class="mui--text-right">
                                @if($user->id == $singleComment->commented->id)
                                    <button class="mui-btn mui-btn--accent" onclick="showEditForm({{$singleComment->id}})"><i class="fa fa-fw fa-pencil"></i></button>
                                @endif
                            </div>
                            @endif
                            {{$singleComment->comment}}

                        </div>
                    </div>

            @endforeach
        @endif
        </div>

        @endif

    </div>
@endforeach

    @endif



