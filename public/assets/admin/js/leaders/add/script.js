// $('.add_file').click(function () {
//     $.post(
//         '/ajax/blocks/add/file',
//         {
//             counter: $('.checkSizeFile').length,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('.content_leader_file').last().after(data);
//         $('.no_files_user').css('display', 'none');
//     }
// });
//
// $('.add_link').click(function () {
//     $.post(
//         '/ajax/blocks/add/link',
//         {
//             counter: $('.checkSizeLink').length,
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('.content_leader_link').last().after(data);
//         $('.no_links_user').css('display', 'none');
//     }
// });
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
            url: '/ajax/admin/leaders/add',
            data: $('form').serialize(),
            success: function(data) {
                window.location.href = "/admin/leaders";
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
function trash($id){
    $($id).remove();
    if ($('.checkSizeLink').length == 1){
        $('.no_links_user').css('display', 'inline-block');
    }
}
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

function up() {
    var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
    if(top > 0) {
        window.scrollBy(0,-100);
        var t = setTimeout('up()',5);
    } else clearTimeout(t);
    return false;
};


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

$('.link_site').change(function(){
    //Если возвращает положительное значение, значит есть. Если ноль - нету.
    if(!($(this).val().indexOf("http") + 1)) {
        $(this).removeClass('check_full');
    }else{
        $(this).addClass('check_full');
    }
});