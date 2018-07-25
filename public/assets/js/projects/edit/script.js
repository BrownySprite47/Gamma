$().ready(function () {
    $('form').validate();
    $(".valid_url").each(function (item) {
        $(this).rules("add", {
            url: true,
        });
    });
    $('.form-control').change(function(){
        if($.trim($(this).val()) != '' ) {
            $(this).addClass('check_full');
            $(this).removeClass('error_empty');
        }else{
            $(this).removeClass('check_full');
        }
    });

    $('.form-control').each(function(i, el){
        if($.trim($(el).val()) != '' ) {
            $(el).addClass('check_full');
        }else{
            $(el).removeClass('check_full');
        }
    });
});

$(".form-control").keydown(function(){
    if($.trim($(this).val()) != '' ) {
        $(this).addClass('check_full');
        // $(this).removeClass('error_empty');
        // $(this).prev('span').css('display', 'none');
        // $(this).prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
        // $(this).parent().prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
        // $(this).css('border', '1px solid #3E3EA2');
    }else{
        $(this).removeClass('check_full');
    }
});

$(".form-control").hover(function(){
    $(".form-control").css('border', '1px solid #ccc');
    $(this).css('border', '1px solid #3E3EA2');
    $(this).prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
    $(this).parent().prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
}, function(){
    $(".form-control").css('border', '1px solid #ccc');
    $(".form-control").prevAll('label').css('color', '#242424').css('opacity', '0.7');
    $(this).parent().prevAll('label').css('color', '#242424').css('opacity', '0.7');
});


$(".btn.dropdown-toggle").hover(function(){
    alert('sgdfg');
    $(".bootstrap-select").css('border', '1px solid #ccc');
    $(this).css('border', '1px solid #3E3EA2');
    $(this).prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
    $(this).parent().prevAll('label').css('color', '#3E3EA2').css('opacity', '1');
}, function(){
    $(".bootstrap-select").css('border', '1px solid #ccc');
    $(".bootstrap-select").prevAll('label').css('color', '#242424').css('opacity', '0.7');
    $(this).parent().prevAll('label').css('color', '#242424').css('opacity', '0.7');
});

$('.metapredmet_checkbox').on('click', function(e) {
    $input = $(this).find($("input"));
    if($($input).prop("checked")) {
        $($input).prop('checked', "");
        $(this).prev('.check_img_note_metapredmet').css('opacity', '0');
        $(this).parent().css('border', '');
        $(this).parent().css('opacity', '0.7');
    }else{
        $($input).prop('checked', "checked");
        $(this).prev('.check_img_note_metapredmet').css('opacity', '1');
        $(this).css('opacity', '1');
        $(this).parent().css('border', '2px solid #3E3EA2');
        $(this).parent().css('opacity', '1');
    }
});
$('.predmet_checkbox').on('click', function(e) {
    $input = $(this).find($("input"));
    if($($input).prop("checked")) {
        $($input).prop('checked', "");
        $(this).prev('.check_img_note_predmet').css('opacity', '0');
        $(this).parent().css('border', '');
        $(this).parent().css('opacity', '0.7');
    }else{
        $($input).prop('checked', "checked");
        $(this).prev('.check_img_note_predmet').css('opacity', '1');
        $(this).css('opacity', '1');
        $(this).parent().css('border', '2px solid #3E3EA2');
        $(this).parent().css('opacity', '1');
    }
});
$('.age_checkbox').on('click', function(e) {
    $input = $(this).find($("input"));
    if($($input).prop("checked")) {
        $($input).prop('checked', "");
        $(this).parent().css('border', '');
        $(this).parent().css('background', '');
        $(this).css('color', '#3E3EA2');
    }else{
        $($input).prop('checked', "checked");
        $(this).parent().css('border', '1px solid #3E3EA2');
        $(this).parent().css('background', '#3E3EA2');
        $(this).css('color', '#fff');
    }
});
$('.level_checkbox').on('click', function(e) {
    $input = $(this).find($("input"));
    if($($input).prop("checked")) {
        $($input).prop('checked', "");
        $(this).prev('.check_img_note_levels').css('opacity', '0');
        $(this).parent().css('border', '');
        $(this).parent().css('opacity', '0.7');
    }else{
        $($input).prop('checked', "checked");
        $(this).prev('.check_img_note_levels').css('opacity', '1');
        $(this).css('opacity', '1');
        $(this).parent().css('border', '2px solid #3E3EA2');
        $(this).parent().css('opacity', '1');
    }
});
$('.form_date').datetimepicker({
    language:  'ru',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});

function check_full_data($class, $type, $id = ''){
    if($type == 1){  // чекбоксы
        $count = 0;
        $('.' + $class).each(function (item) {
            if($('#' + $(this).attr('id')).is(":checked")) {
                $count++;
            }
        });
        if($count != 0){
            $('.error_' + $class).css('display', 'none');
            return true;
        }else{
            $('.error_' + $class).css('display', 'inline');
            return false;
        }
    }
    if($type == 0){ //select
        if( $('#method').val() != 'all'){
            $('.error_' + $class).css('display', 'none');
            return true;
        }else{
            $('.error_' + $class).css('display', 'inline');
            return false;
        }
    }
}

function trashFile($id){
    $($id).remove();
    if ($('.checkSizeFile').length == 1){
        $('.no_file_main').css('display', 'inline-block');
        $('.no_files_project').css('display', 'inline-block');
    }
}

function trashLink($id){
    $($id).remove();
    if ($('.checkSizeLink').length == 1){
        $('.no_link_main').css('display', 'inline-block');
        $('.no_links_project').css('display', 'inline-block');
    }
}

function trashLeader($id){
    $($id).remove();
    if ($('.checkSizeLeader').length == 1){
        $('.no_leader_main').css('display', 'inline-block');
        $('.no_leaders_project').css('display', 'inline-block');
    }
}
$('form').validate({
    submitHandler: function (){
        $result = check_full_data("ages_field_project", 1);
        $result = check_full_data("levels_field_project", 1);
        $result = check_full_data("methods_field_project", 0, "method");

        if($result){
            $.ajax({
                type: 'POST',
                url: '/ajax/projects/update',
                data: $('form').serialize(),
                success: function(data) {
                    if (data == 'success') {
                        $('.back_link_admin').css('display', 'none');
                        $('#result_status_new_tag').css('display', 'inline-block');
                        $('.add_input_tag_img').css('display', 'inline-block');
                        $('#addUserTagId').val('');
                    }
                    //window.location.href = "/user";
                }
            });
        }

    },
    invalidHandler: function (){
        $result = check_full_data("ages_field_project", 1);
        $result = check_full_data("levels_field_project", 1);
        $result = check_full_data("methods_field_project", 0);
    },
    rules: {
        telephone: {
            number: true,
        },
        email: {
            email: true,
        },
        start_year: {
            digits: true,
        },

    }
});