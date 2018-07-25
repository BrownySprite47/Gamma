function modal_box($id){
    $('#myModal .modal-title').html('Вы уверены, что хотите удалить?');
    $('#myModal').modal('show');
    $("#delete").click(function() {
        status(2, $id);
    });
}
function send($type = '', $numpage = 1) {
    $.post(
        '/admin/tags',
        {
            tag: $('#tag').val(),
            type: $type,
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
        '/admin/tags',
        {
            tag: 'all',
            type: $type,
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
function edit($id, $new='') {
    $.post(
        '/ajax/admin/edit_tag',
        {
            id_tag:   $id,
            name_tag: $('#name_tag_' + $id).val(),
            want_tag: $('#want_tag_' + $id).val(),
            need_tag: $('#need_tag_' + $id).val(),
            new: $new,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'success') {
            if($new == ''){
                $name = $('#name_tag_' + $id).val();
                $want = $('#want_tag_' + $id).val();
                $need = $('#need_tag_' + $id).val();
                $('#name_tag_' + $id + '_name').html($name);
                $('#name_tag_' + $id + '_want').html($want);
                $('#name_tag_' + $id + '_need').html($need);
                $("#tag_" + $id + "_edit").css('display', 'none');
                $("#tag_" + $id).css('display', '');
            }else{
                $("#tag_" + $id + "_edit").css('display', 'none');
                $("#tag_" + $id).css('display', 'none');
            }

        }
    }
}
function status($checked, $id) {
    $.post(
        '/ajax/admin/status_tag',
        {
            id_tag:   $id,
            checked:   $checked,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'success') {
            $("#tag_" + $id).css('display', 'none');
        }
        if (data == 'exist') {
            $('#myModal_error').modal('show');
        }
    }
}