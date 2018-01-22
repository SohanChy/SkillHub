<div class="mui-row mui-panel comment-panel">
    <div class="mui-col-xs-3">
        <img class="img-pro-pic" src="{{$user->pro_pic_url}}">

        <div class="mui--divider-top">
            <div class="mui--text-body2 mui--text-center">{{$user->name}}</div>
            <div class="mui--text-caption mui--text-center">{{ucfirst($user->role)}}</div>
        </div>

    </div>
    <div class="mui-col-xs-9">

        @if($comment->exists)
            <h4 id="commentEditTitle">Edit Comment</h4>
            {!! Form::model($comment, ['id'=>'comment-form','method' => 'put','url' =>  url("/comments/".$comment->id)]) !!}
        @else
            <h4>New Comment</h4>
            {!! Form::model($comment, ['id'=>'comment-form','url' =>  url("/comments")]) !!}

            {{Form::hidden('type', $type)}}
            {{Form::hidden('parent_id', $parent_id)}}
        @endif

        @component("mui.textfield",
        ['name' => 'comment',
        "type"=>"textarea",
        "size"=>"30x3"
        ])
        @endcomponent

            {{ Form::close() }}

            <div class="mui--text-right">
                <button onclick="submitComment()" class="mui-btn mui-btn--primary mui-btn--raised">Submit</button>
            </div>



    </div>




</div>
