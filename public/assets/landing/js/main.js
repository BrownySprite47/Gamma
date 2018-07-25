$(document).ready(function () {

    var wow = new WOW({
        mobile: false,
        offset: 250,
    });

    var swiper = new Swiper('.swiper-container', {
        direction: 'vertical',
        effect: 'flip',
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    wow.init();

    $('a.show-tab').click(function () {
        var i = $(this).parent('li').index();
        $('.show-tab').removeClass('active');
        $(this).addClass('active');
        $('span.show-tab:eq(' + i + ')').addClass('active');
        $('.tab-container .tab').hide();
        $('.tab-container .tab:eq(' + i + ')').fadeIn();
        return false;
    });

    $('span.show-tab').click(function () {
        var i = $(this).index();
        console.log(i);
        $('.show-tab').removeClass('active');
        $('.help-block .nav-pills li:eq(' + i + ') a.show-tab').addClass('active');
        $(this).addClass('active');
        $('.tab-container .tab').hide();
        $('.tab-container .tab:eq(' + i + ')').fadeIn();
        return false;
    });

    $('.main-menu a').click(function () {

        var n = $(this).attr('href').split('#')[1];
        var sdv = $(window).width() > 1025 ? 100 : 50;
        if ($('a[name="' + n + '"]').length > 0) {
            $('html, body').animate({
                scrollTop: $('a[name="' + n + '"]').offset().top - sdv
            }, 500);
            history.pushState(null, document.title, $(this).attr('href'));
        }
        return false;
    });
    $('.main-menu .close').click(function () {
        $(this).parent('.main-menu').fadeOut();
    });

    $('.show_mobile_menu').click(function () {
        $('.main-menu').fadeIn();
    });

});
