function modal_box($leader, $user){
    $('#myModal .modal-title').html('Вы уверены, что хотите удалить?');
    $('#myModal').modal('show');
    $("#delete").click(function() {
        status(2, $leader, $user);
    });
}
function send($type = '', $numpage = 1) {
    $.post(
        '/admin/recommends',
        {
            to_recommend: $('#to_recommend').val(),
            type: $type,
            from_recommend: $('#from_recommend').val(),
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
        '/admin/recommends',
        {
            to_recommend: 'all',
            type: $type,
            from_recommend: 'all',
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
function status($checked, $id_lid_recom, $user_id, $exist='0', $direction = ''){
    $.post(
        '/ajax/general/check_status',
        {
            id_lid_recom:  $id_lid_recom,
            user_id:       $user_id,
            exist:         $exist,
            checked:       $checked,
            direction:     $direction,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'recom_update_success') {
            $(".relat_box_leader_" + $user_id + '_' + $id_lid_recom).hide();
        }
    }
}
function recommend() {
    $.post(
        '/ajax/recommends/add',
        {
            data_recommend_user: $('#dataUserDoubles').val(),
            data_recommend_leader: $('#dataLeaderDoubles').val(),
            data_reason: $('#reason_add_recom_admin').val(),
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'leader_recom_success') {
            $('#success_send_data').html('Рекомендация успешно добавлена!');
            $('#success_send_data_ok').css('display', 'none');
            $('#success_send_data_again').css('display', 'inline');
            $( "#dataUserDoubles" ).prop( "disabled", true );
            $( "#dataLeaderDoubles" ).prop( "disabled", true );
        }
        if (data == 'double') {
            $('#success_send_data').html('Данная рекомендация уже существует!');
        }
    }
}
// function users() {
//     $.post(
//         '/ajax/doubles/get_recommends',
//         {
//             data_doubles: $('#dataUserDoubles').val(),
//         },
//         AjaxSuccess
//     );
//
//     function AjaxSuccess(data) {
//         $('#ajax_info_user').html(data);
//         $('#reason_add_recom_admin').css('display', 'inline-block');
//     }
// }
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
//         $('#reason_add_recom_admin').css('display', 'inline-block');
//     }
// }




function get($type) {
    if($type == 'from'){
        $id_recom = $('#dataFromRecommends').val();
    }
    if($type == 'to'){
        $id_recom = $('#dataToRecommends').val();
    }
    $.post(
        '/ajax/recommends/get',
        {
            data_doubles: $id_recom,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if($type == 'from'){
            $('#ajax_info_from').html(data);
        }
        if($type == 'to'){
            $('#ajax_info_to').html(data);
        }
        $('#reason_add_recom_admin').css('display', 'inline-block');
    }
}
