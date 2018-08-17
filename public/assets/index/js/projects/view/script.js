$(".admin_links.delete").click(function() {
    $id_proj = $('#id_proj').val();
    $.post(
        '/ajax/index/projects/delete',
        {
            id_proj: $id_proj
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $(".admin_links.delete").html('Удалено').css('color', 'red');
    }
});

$(".admin_links.recovery").click(function() {
    $id_proj = $('#id_proj').val();
    $.post(
        '/ajax/index/projects/recovery',
        {
            id_proj: $id_proj
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $(".admin_links.recovery").html('Восстановлено').css('color', 'green');
    }
});
