<?php
/**
 * Page /index/news/view
 */
function index()
{
    if (isset($_GET['id']) && is_int((int)$_GET['id'])) {

        news_addView($_GET['id']);
        $id_current = main_checkChars($_GET['id']);
        $id_next = main_checkChars($_GET['id']) * 1 - 1;

        $data['current'] = news_getById($id_current, 1, true);



        $data['next'] = news_getById($id_next, 1, true);

        $data['all_news'] = news_get( 1, true);


        /**
         * Activation main menu link
         */
        $data['news_link'] = 'active_menu';

        /**
         * Get comments count
         */
        $data['comments_count'] = comments_countNews($_GET['id']);

        /**
         * Page title
         */
        $data['title'] = $data['current'][0]['title'];
        $data['comments'] = comments_get($_GET['id']);

        /**
         * Require css and js files for page
         */


        $data['css'][] = 'libs/kemoji/lib/prettify.css';
        $data['css'][] = 'libs/kemoji/css/emoji.css';
        $data['css'][] = 'libs/kemoji/css/smiles.css';
        $data['css'][] = 'libs/kemoji/css/style.css';

        $data['css'][] = 'index/css/news/view/style.css';
        $data['css'][] = 'index/css/news/view/media.css';
        $data['css'][] = 'libs/carousel/owl.carousel.css';

        $data['js'][] = 'libs/kemoji/lib/prettify.js';
        $data['js'][] = 'libs/kemoji/kemoji.min.js';
        $data['js'][] = 'libs/sticky-kit/jquery.sticky-kit.js';
        $data['js'][] = 'index/js/news/view/script.js';
        $data['js'][] = 'libs/carousel/owl.carousel.js';







        /**
         * Require view
         */
        renderView('index/news/view/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
