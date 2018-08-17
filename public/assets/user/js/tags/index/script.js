$(function() {
    $("#widget_empty_1").click(function() {
        $('.tags.mobile_popup_hidden').css('display', 'none');
        $('.mobile_list').css('display', 'inline-block');
        $('#place').val("1");
        $(window).scrollTop(0);
    });

    $("#widget_empty_2").click(function() {
        $('.tags.mobile_popup_hidden').css('display', 'none');
        $('.mobile_list').css('display', 'inline-block');
        $('#place').val("2");
        $(window).scrollTop(0);
    });

    $("#close_widget_list").click(function() {
        $('.tags.mobile_popup_hidden').css('display', 'inline-block');
        $('.mobile_list').css('display', 'none');
        $(window).scrollTop(0);
    });

    $("#foundation .widget.old_tags").click(function() {
        $val = $(this).html();
        $place = $('#place').val();
        if($place == '1') {
            $('#widget_empty_1').before("<div class='widget new_1'></div>");
            $('.widget.new_1').last().html($val);
            $('.tags.mobile_popup_hidden').css('display', 'inline-block');
            $('.mobile_list').css('display', 'none');
            $(window).scrollTop(0);
        }
        if($place == '2') {
            $('#widget_empty_2').before("<div class='widget new_2'></div>");
            $('.widget.new_2').last().html($val);
            $('.tags.mobile_popup_hidden').css('display', 'inline-block');
            $('.mobile_list').css('display', 'none');
            $(window).scrollTop(0);
        }

    });


    $('#bootstrap1, #bootstrap2, #foundation').sortable({
        placeholder: 'placeholder',
        connectWith: '.widget-container',
        handle: '.widget-head',
        cursor: 'move'
    });
}).call(this);

function add() {
    $.post(
        '/ajax/user/tags/add',
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
            '/ajax/user/tags/edit',
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
