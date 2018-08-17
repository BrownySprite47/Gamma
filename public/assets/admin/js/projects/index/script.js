function modal_box($id){
    $('#myModal .modal-title').html('Вы уверены, что хотите удалить?');
    $('#myModal').modal('show');
    $("#delete").click(function() {
        status(2, $id);
    });
}
function send($type, $numpage) {

    if($type == undefined){ $type = ''; }
    if($numpage == undefined){ $numpage = 1; }

    $.post(
        '/admin/projects',
        {
            project: $('#project').val(),
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

function clear_filter($type) {

    if($type == undefined){ $type = ''; }

    $.post(
        '/admin/projects',
        {
            project: 'all',
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
function status($checked, $id_proj){
    $.post(
        '/ajax/index/status/change/projects',
        {
            id_proj: $id_proj,
            checked: $checked,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'project_update_success') {
            $(".relat_box_project_" + $id_proj).hide();
        }
    }
}