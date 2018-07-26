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
    beforeSubmit: function () {
        $data = kemoji.getValue(KEmoji.HTML_VALUE);
        $('#comment').val($data);
        return true;
    },
    submitHandler: function (){
        $.ajax({
            type: 'POST',
            url: '/ajax/comments/add',
            data: $('form').serialize(),
            success: function(data) {
                console.log(data);
                //window.location.href = "/user";
            }
        });
    },
    rules: {}
});

$(".form-control").keydown(function(){
    if($.trim($(this).val()) != '' ) {
        $(this).addClass('check_full');
    }else{
        $(this).removeClass('check_full');
    }
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



var kemoji = KEmoji.init('myEmojiField', {
    width: 400,
    height: 166
});
