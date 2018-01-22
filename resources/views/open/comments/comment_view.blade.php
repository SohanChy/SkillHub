@foreach($comments as $singleComment)
    <div class="mui-container-fluid">
        <div class="mui-row mui-panel comment-panel">
            <div class="mui-col-xs-3">
                <img class="img-pro-pic" src="{{$singleComment->commented->pro_pic_url}}">.
                <div class="mui-divider"></div>
                {{$singleComment->commented->name}} - {{ucfirst($singleComment->commented->role)}}
            </div>
            <div class="mui-col-xs-9">
                <div class="mui--text-right">

                <button class="mui-btn mui-btn--primary" onclick="showReplyForm({{$singleComment->id}})"><i class="fa fa-fw fa-reply"></i> Reply</button>

                @if($user->id == $singleComment->commented->id)
                        <button class="mui-btn mui-btn--accent" onclick="showEditForm({{$singleComment->id}})"><i class="fa fa-fw fa-pencil"></i></button>
                @endif
                </div>
                {{$singleComment->comment}}

            </div>
        </div>

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
                            <div class="mui--text-right">
                                @if($user->id == $singleComment->commented->id)
                                    <button class="mui-btn mui-btn--accent" onclick="showEditForm({{$singleComment->id}})"><i class="fa fa-fw fa-pencil"></i></button>
                                @endif
                            </div>
                            {{$singleComment->comment}}

                        </div>
                    </div>

            @endforeach
        @endif
        </div>

    </div>
@endforeach



