// function send($id) {
//
//     $.post(
//         '/ajax/recommends/update',
//         {
//             familya: $('#familya').val(),
//             name: $('#name').val(),
//             city: $('#city').val(),
//             project: $('#project').val(),
//             email: $('#email').val(),
//             social: $('#social').val(),
//             reason: $('#reason').val(),
//             id_lid: $id,
//             leaders_photo: $('.leaders_photo').attr('src'),
//         },
//         AjaxSuccess
//     );
//     function AjaxSuccess(data) {
//         if(data == "empty"){
//             $('#myModal3').modal('show');
//         }
//         if (data == "success_user") {
//             //$('#result_public').html("Рекомендация успешно обновлена!");
//             $('#myModal').modal('show');
//             $('#add_lid_btn').remove();
//             $('#tags').css('display', 'inline');
//             $('#next_recommend').css('display', 'inline');
//         }
//
//         // else{
//         //     $('#result_public').html(data);
//         // }
//
//
//     }
// }

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
            url: '/ajax/recommends/edit',
            data: $('form').serialize(),
            success: function(data) {
                console.log(data);
                //window.location.href = "/user";
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