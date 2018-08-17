$('.open-modal').click(function(){
    $('#myModal').modal('show');
});
$(".see_more a ").click(function() {
    $('.wrap_leaders_connect').css('display', 'block');
    $('.see_more a').css('display', 'none');

});
$("#connect_to_leader").click(function() {
    if ($('.edit_profile').css('display') == 'block'){
        $('.edit_profile').css('display', 'none');
    }else{
        $('.edit_profile').css('display', 'inline-block');
    }
});
function socialClickLog(){
    $.post(
        '/ajax/logs/social_click_log',
        {
            user: true
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        //$('#content-main').html(data);
    }
}

$(".admin_links.delete").click(function() {
    $id_lid = $('#id_lid').val();
    $.post(
        '/ajax/index/leaders/delete',
        {
            id_lid: $id_lid
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $(".admin_links.delete").html('Удалено').css('color', 'red');
    }
});

$(".admin_links.recovery").click(function() {
    $id_lid = $('#id_lid').val();
    $.post(
        '/ajax/index/leaders/recovery',
        {
            id_lid: $id_lid
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $(".admin_links.recovery").html('Восстановлено').css('color', 'green');
    }
});
