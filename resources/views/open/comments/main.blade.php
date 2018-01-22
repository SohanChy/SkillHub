<div id="comment_view">
    @component("open.comments.comment_view",
        ['comments' => $comments,
        'user' => $user
        ])
    @endcomponent
</div>


<script>
    var comment_type = "{{$type}}";
    var comment_parent_id = "{{$parent_id}}";
    var baseUrl = "{{url("comments")}}";
</script>
<script src="{{asset("js/comments/comment.js")}}"></script>

<div id="comment_create_edit">
@component("open.comments.comment_edit",
    ['comment' => $comment,
    'user' => $user,
    "type" => $type,
    "parent_id" => $parent_id
    ])
@endcomponent
</div>