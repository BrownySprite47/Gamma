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