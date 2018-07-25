function FilterProjects($numpage = 1) {
    $.post(
        '/projects',
        {
            title: $('#title_filter').val(),
            city: $('#city_filter').val(),
            age: $('#age_filter').val(),
            predmet: $('#predmet_filter').val(),
            metapredmet: $('#metapredmet_filter').val(),
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}


function FilterCity($numpage = 1) {
    $.post(
        '/projects',
        {
            title: 'all',
            city: $('#city_filter').val(),
            age: 'all',
            predmet: 'all',
            metapredmet: 'all',
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}

function FilterProjectTitle($numpage = 1) {
    $.post(
        '/projects',
        {
            title: $('#title_filter').val(),
            city: 'all',
            age: 'all',
            predmet: 'all',
            metapredmet: 'all',
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
        '/projects',
        {
            title: 'all',
            city: 'all',
            age: 'all',
            predmet: 'all',
            metapredmet: 'all',
            numpage: $numpage,
        },
        AjaxSuccess
    );

    function AjaxSuccess(data) {
        $('#content-main').html(data);
    }
}