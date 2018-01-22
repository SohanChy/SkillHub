function showCreateForm(){
    var elem = $("#comment_create_edit");
    elem.load(baseUrl + "/create?type=" + comment_type + "&parent_id=" + comment_parent_id
        );

}

function showReplyForm(commentId){
    var elem = $("#parent-comment-id-"+commentId);
    elem.load(baseUrl + "/create?type=reply&parent_id=" + commentId
    ,
        function(){
            flashAndScrollTo(elem)
        }
        );
}

function showEditForm(id){
   var elem = $("#comment_create_edit");
   elem.load(baseUrl + "/"+id+"/edit"
    ,
        function(){
            flashAndScrollTo(elem)
        }
        );
}

function reloadComments(){
    var elem = $("#comment_view");
    elem.load(baseUrl + "?type=" + comment_type + "&parent_id=" + comment_parent_id
    ,
        function(){
            flashAndScrollTo(elem)
        }
        );
}

function submitComment(){
    console.log("here");
    $(this).html("<img class='.img-responsive' src='/assets/waiting.gif' />");

    var form = $('#comment-form');

    $.post(form.attr('action'), form.serialize(), 'json')
        .fail(function (data) {
            var msg = data.responseJSON.error;
            alert(msg);

        })
        .done(function (message) {
            reloadComments();
            showCreateForm();
        })
}

function flashAndScrollTo(elem){
    $('html, body').animate({
        scrollTop: elem.offset().top - ($( ".mui--appbar-height" ).height() + 100)
    },
        700,
        function(){
            elem.fadeTo(100, 0.3, function () {
                $(this).fadeTo(500, 1.0);
            });
        }
        );


}