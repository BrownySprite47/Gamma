function deleteRecom($actual, $id) {
    $.post(
        '/ajax/recommends/delete',
        {
            actual: $actual,
            id_lid: $id,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        console.log(data);
        if (data == "success_user") {
            $('#result_public_' + $id).html("<img src='/assets/images/check.svg' alt=''><span>Рекомендация успешно удалена!</span>");
            // $('#myModal').modal('show');
            // $('#recom_' + $id).remove();
        }
    }
}

