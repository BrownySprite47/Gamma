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
$('form').validate({
    submitHandler: function (){
        $.ajax({
            type: 'POST',
            url: '/ajax/admin/recommends/add',
            data: $('form').serialize(),
            success: function(data) {
                console.log(data);
                  // window.location.href = "/user/recommends";
            }
        });
    },
    rules: {
        telephone: {
            number:true
        },
        email: {
            email: true,
        },

    }
});

$('.form_date').datetimepicker({
    language:  'ru',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
