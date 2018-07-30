<?php
/**
 * Page /news/view
 */
function index()
{
    if (isset($_GET['id']) && is_int((int)$_GET['id'])) {

        viewNews($_GET['id']);
        $data['news'] = getNewsFromDb(1, true);
        /**
         * Activation main menu link
         */
        $data['news_link'] = 'active_menu';

        /**
         * Get comments count
         */
        $data['comments_count'] = getCountComments($_GET['id']);

        /**
         * Page title
         */
        $data['title'] = 'Новость';
        $data['comments'] = getComments($_GET['id']);

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'libs/kemoji/lib/prettify.css';
        $data['css'][] = 'libs/kemoji/css/emoji.css';
        $data['css'][] = 'libs/kemoji/css/smiles.css';
        $data['css'][] = 'libs/kemoji/css/style.css';
        $data['css'][] = 'css/news/view/style.css';

        $data['js'][] = 'libs/kemoji/lib/prettify.js';
        $data['js'][] = 'libs/kemoji/kemoji.min.js';
        $data['js'][] = 'libs/sticky-kit/jquery.sticky-kit.js';
        $data['js'][] = 'js/news/view/script.js';

        /**
         * Require view
         */
        renderView('news/view/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
