$().ready(function () {
    $(".news_main_link").mouseover(function() {
        setTimeout(function () {
            $('.news_main_link .description_box .inner').css('transform', 'translate(0,-100px)');
        });
        setTimeout(function () {
            $('.news_description_main').css('opacity', '1');
        }, 1000);
        // setTimeout(function () {
        //     $('.news_description_main').css('display', 'block');
        // }, 1000);
    });
    $(".news_main_link").mouseout(function() {
        setTimeout(function () {
            $('.news_main_link .description_box .inner').css('transform', '');
        });
        setTimeout(function () {
            $('.news_description_main').css('opacity', '0');
        }, 1000);
        // setTimeout(function () {
        //     $('.news_description_main').css('display', 'none');
        // }, 1000);

    });
});
