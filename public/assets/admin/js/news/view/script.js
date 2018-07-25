function modal_box($id){
    $('#myModal .modal-title').html('Вы уверены, что хотите удалить?');
    $('#myModal').modal('show');
    $("#delete").click(function() {
        status(2, $id);
    });
}
function send($numpage = 1) {
    $.post(
        '/admin/news',
        {
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}
function status($status, $id_news){
    $.post(
        '/ajax/general/check_status',
        {
            status: $status,
            id_news: $id_news,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == 'news_update_success') {
            $(".relat_box_news_" + $id_news).hide();
            if($status == 2){
                window.location.href = "/admin/news";
            }

            // $(this).closest(".relat_box").remove();
        }
    }
}
