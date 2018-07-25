function modal_box($leader, $user){
    $('#myModal .modal-title').html('Вы уверены, что хотите удалить?');
    $('#myModal').modal('show');
    $("#delete").click(function() {
        status(2, $leader, $user);
    });
}
function send($type = '', $numpage = 1) {
    $.post(
        '/admin/doubles',
        {
            condition: $('#condition_filter').val(),
            type: $type,
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
        '/admin/doubles',
        {
            condition: 'all',
            type: $type,
            count_on_page: '10',
            numpage: '1',
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}
function status($checked, $id, $id_user, $type = ''){
    $.post(
        '/ajax/doubles/check_status_double',
        {
            id: $id,
            checked: $checked,
            type: $type,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'leader_double_success') {
            $(".relat_box_leader_" + $id_user).hide();
        }
    }
}
function connect() {
    $.post(
        '/ajax/doubles/add',
        {
            data_doubles_user: $('#dataUserDoubles').val(),
            data_doubles_leader: $('#dataLeaderDoubles').val(),
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'leader_double_success') {
            $('#success_send_data').html('Профили успешно привязаны!');
            $('#success_send_data_ok').css('display', 'none');
            $('#success_send_data_again').css('display', 'inline-block');
            $( "#dataUserDoubles" ).prop( "disabled", true );
            $( "#dataLeaderDoubles" ).prop( "disabled", true );

        }
    }
}
function get($type) {
    if($type == 'user'){
        $id_doubles = $('#dataUserDoubles').val();
    }
    if($type == 'leader'){
        $id_doubles = $('#dataLeaderDoubles').val();
    }
    $.post(
        '/ajax/doubles/get',
        {
            data_doubles: $id_doubles,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if($type == 'user'){
            $('#ajax_info_user').html(data);
        }
        if($type == 'leader'){
            $('#ajax_info_leader').html(data);
        }
    }
}
//
// function leaders() {
//     $.post(
//         '/ajax/doubles/get_doubles',
//         {
//             data_doubles: $('#dataLeaderDoubles').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#ajax_info_leader').html(data);
//     }
// }
