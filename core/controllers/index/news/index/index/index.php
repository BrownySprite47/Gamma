<?php
/**
 * Page /index/news
 */
function index()
{
    /**
     * Activation main menu link
     */
    $data['news_link'] = 'active_menu';

    /**
     * receiving information about events that occurred on the site
     */
    $data['events'] = news_getEvents();

    /**
     * getting information about the number of leaders
     */
    $data['leaders_count'] = news_getCountLeaders();

    /**
     * getting information on the number of recommendations
     */
    $data['recommends_count'] = news_getCountRecommends();

    /**
     * set the number of leaders per page according to the conditions
     */
    $settings['count_on_page'] = 50;
    $data['countpages'] = intval(
        (db_count('news', '', " WHERE checked != 2 ") - 1) / $settings['count_on_page']
    ) + 1;
    $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

    if ($data['numpage'] < 1) {
        $data['numpage'] = 1;
    }
    if ($data['numpage'] > $data['countpages']) {
        $data['numpage'] = $data['countpages'];
    }

    $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];

    $limit = main_limit($data['startproject'], $settings['count_on_page']);

    /**
     * getting information about all published news
     */
    $data['news'] = news_get(1, true, $limit);

    

    /**
     * Page title
     */
    $data['title'] = 'Новости';

    /**
     * Require css and js files for page
     */
    $data['css'][] = 'libs/carousel/owl.carousel.css';
    $data['js'][] = 'index/js/news/index/script.js';
    $data['js'][] = 'libs/carousel/owl.carousel.js';
    $data['css'][] = 'index/css/news/index/style.css';
    $data['css'][] = 'index/css/news/index/media.css';


    if (!empty($_POST)) {

        /**
         * Require view
         */
        renderView('index/news/index/layouts/index/index/index', $data);
    } else {

        /**
         * Require view
         */
        renderView('index/news/index/index/index/index', $data);
    }
}
