function FilterProjects($numpage) {

    if($numpage == undefined){ $numpage = 1; }

    $.post(
        '/index/projects',
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


function FilterCity($numpage) {

    if($numpage == undefined){ $numpage = 1; }

    $.post(
        '/index/projects',
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

function FilterProjectTitle($numpage) {

    if($numpage == undefined){ $numpage = 1; }

    $.post(
        '/index/projects',
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

function ClearFilter($numpage) {

    if($numpage == undefined){ $numpage = 1; }

    $.post(
        '/index/projects',
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

$('.close_main_filter').on('click', function(e){
    $('.mobile_filter').css('display', 'none');
});

function main_filter_projects() {
    $('.mobile_filter').css('display', 'block');
}