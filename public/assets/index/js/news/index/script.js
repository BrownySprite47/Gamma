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
$(document).ready(function(){

    // Находим блок карусели
    var carousel = $("#carousel");

    // Запускаем плагин карусели
    carousel.owlCarousel({
        // Количество отображающихся блоков
        // в зависимости от устройства (ширины экрана)

        // Количество блоков на больших экранах
        items:             3

        // // 5 блоков на компьютерах (экран от 1400px до 901px)
        // itemsDesktop:      [1400, 3],
        //
        // // 3 блока на маленьких компьютерах (экран от 900px до 601px)
        // itemsDesktopSmall: [900, 3],
        //
        // // 2 элемента на планшетах (экран от 600 до 480 пикселей)
        // itemsTablet:       [600, 3],
        //
        // // Настройки для телефона отключены, в этом случае будут
        // // использованы настройки планшета
        // itemsMobile:       false
    });


// Назад
// При клике на "Назад"
    $('#js-prev').click(function () {

        // Запускаем перемотку влево
        carousel.trigger('owl.prev');

        return false;
    });

// Вперед
// При клике на "Вперед"
    $('#js-next').click(function () {

        // Запускаем перемотку вправо
        carousel.trigger('owl.next');

        return false;
    });


});

