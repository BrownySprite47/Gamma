$('form').validate({
    submitHandler: function (){
        $dataCom = $('#comment').val();
        $parentAuthor = $('#parent_author_id').val();
        $parentComment = $('#parent_comment_id').val();
        $.ajax({
            type: 'POST',
            url: '/ajax/index/comments/files/add',
            data: $('form').serialize(),
            success: function(data) {

                if($parentComment == ''){
                    $('#comment_box').prepend(data);
                }else{
                    $('.inner_comment_' + $parentComment).after(data);
                }
                $('#editable').html('');
                $('#editable').focus();
                $dataCom = $('#comment').val('');
                $parentAuthor = $('#parent_author_id').val('');
                $parentComment = $('#parent_comment_id').val('');
                $('.no_comments').css('display', 'none');

            }
        });
    },
    rules: {}
});

//
// $(window).scroll(function() {
//     var the_top = jQuery(document).scrollTop();
//     if (the_top > 100) {
//         jQuery('#myEmojiField').addClass('fixed');
//     }
//     else {
//         jQuery('#myEmojiField').removeClass('fixed');
//     }
// });

function insertNodeAtCaret(object, node) {

    $('#editable').html('');
    $id = $(object).attr("id");
    $author_id = $('.author_id_' + $id).val();
    $comment_id = $('.comment_id_' + $id).val();

    $('#parent_author_id').val($author_id);
    $('#parent_comment_id').val($comment_id);

    if (typeof window.getSelection != "undefined") {
        var sel = window.getSelection();
        if (sel.rangeCount) {
            var range = sel.getRangeAt(0);
            range.collapse(false);
            range.insertNode(node);
            range = range.cloneRange();
            range.selectNodeContents(node);
            range.collapse(false);
            sel.removeAllRanges();
            sel.addRange(range);
        }
    } else if (typeof document.selection != "undefined" && document.selection.type != "Control") {
        var html = (node.nodeType == 1) ? node.outerHTML : node.data;
        var id = "marker_" + ("" + Math.random()).slice(2);
        html += '<span id="' + id + '"></span>';
        var textRange = document.selection.createRange();
        textRange.collapse(false);
        textRange.pasteHTML(html);
        var markerSpan = document.getElementById(id);
        textRange.moveToElementText(markerSpan);
        textRange.select();
        markerSpan.parentNode.removeChild(markerSpan);
    }
}

$( ".add_btn_comment" ).click(function() {
    $data = kemoji.getValue(KEmoji.HTML_VALUE);
    $('#comment').val($data);
    $('form').validate();
});

var kemoji = KEmoji.init('myEmojiField', { });

// $(".sticky_news_comments").stick_in_parent();
