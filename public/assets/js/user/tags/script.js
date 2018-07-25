$(function() {
    $('#bootstrap1, #bootstrap2, #foundation').sortable({
        placeholder: 'placeholder',
        connectWith: '.widget-container',
        handle: '.widget-head',
        cursor: 'move'
    });
}).call(this);

function add() {
    $.post(
        '/ajax/tags/add_user_tag',
        {
            name_tag: $('#addUserTagId').val(),
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'success') {
            $('#result_status_new_tag').css('display', 'inline-block');
            $('.add_input_tag_img').css('display', 'inline-block');
            $('#addUserTagId').val('');
        }
    }
}

function send(){
    var $data = {};
    $data['tag_i_can'] = {};
    $data['tag_i_want'] = {};
    $data['none'] = {};
    $('#bootstrap1').find ('input').each(function() {
        $data['tag_i_can'][this.name] = $(this).val();
    });
    $('#bootstrap2').find ('input').each(function() {
        $data['tag_i_want'][this.name] = $(this).val();
    });
    $('#foundation').find ('input').each(function() {
        $data['none'][this.name] = $(this).val();
    });
    ajax($data);
    function ajax(dataTag){
        $.post(
            '/ajax/tags/user_tags',
            {
                tags: dataTag,
            },
            AjaxSuccess
        );
        function AjaxSuccess(data) {
            if (data == 'success') {
                location.reload();
            }
        }
    }
}