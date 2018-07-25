$('form').validate({
    submitHandler: function (){
        $.ajax({
            type: 'POST',
            url: '/ajax/news/edit/index',
            data: $('form').serialize(),
            success: function(data) {
                $('#result_public').css('display', 'inline-block');
                $('.save_btn').attr('disabled', 'disabled');
                $('.save_btn').css('background', '#EBBD21');
            }
        });
    }
});

$().ready(function () {
    $('form').validate();
    $(".valid_url").each(function (item) {
        $(this).rules("add", {
            url: true,
        });
    });
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
