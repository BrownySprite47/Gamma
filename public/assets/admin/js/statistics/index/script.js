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

function send(){
    $.post(
        '/admin/statistics',
        {
            start:  $('#period_start').val(),
            end:    $('#period_end').val(),
            period: $('#group_statistics_period').val(),
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}
