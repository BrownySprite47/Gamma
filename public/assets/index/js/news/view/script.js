$().ready(function () {
    $('.form-control').change(function(){
        if($.trim($(this).val()) != '' ) {
            $(this).addClass('check_full');
            $(this).removeClass('error_empty');
        }else{
            $(this).removeClass('check_full');
        }
    });

    $('.form-control').each(function(i, el){
        if($.trim($(el).val()) != '' ) {
            $(el).addClass('check_full');
        }else{
            $(el).removeClass('check_full');
        }
    });
});
$('form').validate({
    submitHandler: function (){
        $dataCom = $('#comment').val();
        $parentAuthor = $('#parent_author_id').val();
        $parentComment = $('#parent_comment_id').val();
        $.ajax({
            type: 'POST',
            url: '/ajax/index/comments/news/add',
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

$(".form-control").keydown(function(){
    if($.trim($(this).val()) != '' ) {
        $(this).addClass('check_full');
    }else{
        $(this).removeClass('check_full');
    }
});

$( ".add_btn_comment" ).click(function() {
    $data = kemoji.getValue(KEmoji.HTML_VALUE);
    $('#comment').val($data);
    $('form').validate();
});


$(".form-control").hover(function(){
    $(".form-control").css('border', '1px solid #ccc');
    $(this).css('border', '1px solid #3E3EA2');
    $(this).prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
    $(this).parent().prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
}, function(){
    $(".form-control").css('border', '1px solid #ccc');
    $(".form-control").prevAll('label').css('color', '#242424').css('opacity', '0.7');
    $(this).parent().prevAll('label').css('color', '#242424').css('opacity', '0.7');
});

$(document).ready(function(){

    // Находим блок карусели
    var carousel = $("#carousel");

    // Запускаем плагин карусели
    carousel.owlCarousel({
        // Количество отображающихся блоков
        // в зависимости от устройства (ширины экрана)

        // Количество блоков на больших экранах
        items:             5

        // // 5 блоков на компьютерах (экран от 1400px до 901px)
        // itemsDesktop:      [1400, 3],
        //
        // // 3 блока на маленьких компьютерах (экран от 900px до 601px)
        // itemsDesktopSmall: [900, 3],
        //
        // // 2 элемента на планшетах (экран от 600 до 480 пикселей)
        // itemsTablet:       [600, 3],
        //
        // // Настройки для телефона отключены, в этом случае будут
        // // использованы настройки планшета
        // itemsMobile:       false
    });


// Назад
// При клике на "Назад"
    $('#js-prev').click(function () {

        // Запускаем перемотку влево
        carousel.trigger('owl.prev');

        return false;
    });

// Вперед
// При клике на "Вперед"
    $('#js-next').click(function () {

        // Запускаем перемотку вправо
        carousel.trigger('owl.next');

        return false;
    });


});


var kemoji = KEmoji.init('myEmojiField', { });

// $(".sticky_news_comments").stick_in_parent();
