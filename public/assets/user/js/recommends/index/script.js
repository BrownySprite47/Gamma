function deleteRecom($actual, $id) {
    $.post(
        '/ajax/user/recommends/delete',
        {
            actual: $actual,
            leader: $id,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        if (data == "success") {
            $('#result_public_' + $id).html("<img src='/assets/images/check.svg' alt=''><span>Рекомендация успешно удалена!</span>");
            $('.recommend_info_' + $id).removeClass('true');
            $('.recommend_info_' + $id).html('Рекомендация не актуальна');
        }
    }
}

