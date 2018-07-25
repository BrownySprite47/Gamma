function modal_box($id){
    $('#myModal .modal-title').html('Вы уверены, что хотите удалить?');
    $('#myModal').modal('show');
    $("#delete").click(function() {
        status(2, $id);
    });
}
function send($type = '', $numpage = 1) {
    $.post(
        '/admin/leaders',
        {
            leader: $('#leader').val(),
            type: $type,
            status: $('#status_filter').val(),
            condition: $('#condition_filter').val(),
            count_on_page: $('#count_on_page').val(),
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}
function clear_filter($type = '') {
    $.post(
        '/admin/leaders',
        {
            leader: 'all',
            type: $type,
            status: 'all',
            condition: 'all',
            count_on_page: '10',
            numpage: '1',
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}
function status($checked, $id_lid){
    $.post(
        '/ajax/general/check_status',
        {
            id_lid: $id_lid,
            checked: $checked,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'leader_update_success') {
            $(".relat_box_leader_" + $id_lid).hide();
        }
    }
}

