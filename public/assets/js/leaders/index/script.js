function FilterLeaders($numpage = 1) {
    $.post(
        '/leaders',
        {
            fio_filter: $('#fio_filter').val(),
            city_filter: $('#city_filter').val(),
            want_filter: $('#want_filter').val(),
            can_filter: $('#can_filter').val(),
            help_to_me: isChecked('#help_to_me'),
            i_can_help: isChecked('#i_can_help'),
            a_z: isChecked('#a_z'),
            z_a: isChecked('#z_a'),
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}


function ClearFilter($numpage = 1) {
    $.post(
        '/leaders',
        {
            fio_filter: 'all',
            city_filter: 'all',
            want_filter: 'all',
            can_filter: 'all',
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}


function isChecked($checkbox) {
    if($($checkbox).is(":checked")) {
        return '1';
    }else{
        return '0';
    }
}


$(".see_more a ").click(function() {
    $('.wrap_leaders_connect').css('display', 'block');
    $('.see_more a').css('display', 'none');

});

if(screen.width > 768){
    $('.leaders_info:not(.classy)').hover(
        function(){
            var idList = $(this).attr('id');

            $('.leader_detail_info').css('display', 'none');
            $('.' + idList + '_detail').css('display', 'inline-block');
        },
        function(){
            var idList = $(this).attr('id');

            $('.leader_detail_info').css('display', 'none');
            $('.' + idList + '_detail').css('display', 'inline-block');
        }
    );
}



$('.modal.fade').on('click', function(e){
    $('.modal-dialog .modal-content').html('');
});


$('.checkbox').on('click', function(e){
    var idList = $(this).attr('id');
    if ($('.label_' + idList).prop( "checked" )) {
        $('.label_' + idList).prop('checked', "");
    }else{
        $('.label_' + idList).prop('checked', "checked");
    }
    FilterLeaders();
});


$('.filter_checkbox').on('click', function(e) {
    var idList = $(this).attr('id');
    if ($('.label_' + idList).prop("checked")) {
        $('.label_' + idList).prop('checked', "");
    } else {
        $('.label_' + idList).prop('checked', "checked");
    }
    FilterLeaders();
});