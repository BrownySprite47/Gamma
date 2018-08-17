$(".add_to_comunity").click(function() {
    $('#content-main').addClass("mobil");
});
$(".modal-backdrop, #myModal").click(function() {
    $('#content-main').removeClass("mobil");
});


$('.checkbox').on('click', function(e){
    var idList = $(this).attr('id');
    if ($('.label_' + idList).prop( "checked" )) {
        $('.label_' + idList).prop('checked', "");
    }else{
        $('.label_' + idList).prop('checked', "checked");
    }
    $('#save_private').removeAttr('disabled');
});

$('.filter_checkbox').on('click', function(e) {
    var idList = $(this).attr('id');
    if ($('.label_' + idList).prop("checked")) {
        $('.label_' + idList).prop('checked', "");
    } else {
        $('.label_' + idList).prop('checked', "checked");
    }
    $('#save_private').removeAttr('disabled');
});

$('#save_private').on('click', function(e) {
    $.post(
        '/ajax/user/index/private',
        {
            check: $('input[name=private]:checked').val()
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == "success") {
            $('#save_private').attr('disabled', 'disabled');
            $('#result_visible').css('display', 'inline-block');
        }
    }
});

$(function(){
    $('.wrapper_projects').hover(function(){
            $(this).find('img.edit_project').css('opacity', '1');
        },
        function(){
            $(this).find('img.edit_project').css('opacity', '0');
        });
});
