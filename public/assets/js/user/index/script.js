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
        '/ajax/user/private',
        {
            check: $('input[name=private]:checked').val()
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        //alert(data);
        if (data == "success") {
            $('#save_private').attr('disabled', 'disabled');
            $('#result_visible').css('display', 'inline-block');

        }
        // else{
        //     alert(data);
        // }
    }
});


// $('.wrapper_projects').on('hover', function(e) {
//     alert('dgfdg');
//
// }, function(e) {
//     $('img.edit_project').css('opacity', '1');
// });
$(function(){
    $('.wrapper_projects').hover(function(){
            $(this).find('img.edit_project').css('opacity', '1');
        },
        function(){
            $(this).find('img.edit_project').css('opacity', '0');
        });
});
