<?php
/**
 * Page /index/comments/link
 */
function index(){
    if (isset($_SESSION['status']) && $_SESSION['status'] != '0') {
        $data = [];

        /**
         * Activation admin menu link
         */
        $data['user_logo'] = '';

        $data['link'] = links_getById($_GET['id']);

        if(!isset($data['link'][0])){
            header('Location: /');
            exit();
        }
        /**
         * Page title
         */
        $data['title'] = 'Комментарии ссылки на ресурс';

        /**
         * Get comments count
         */
    //    $data['comments_count'] = getCountCommentsLinks($_GET['id']);

        $data['css'][] = 'libs/kemoji/lib/prettify.css';
        $data['css'][] = 'libs/kemoji/css/emoji.css';
        $data['css'][] = 'libs/kemoji/css/smiles.css';
        $data['css'][] = 'libs/kemoji/css/style.css';
        $data['css'][] = 'index/css/comments/links/style.css';
        $data['css'][] = 'index/css/comments/links/media.css';

        $data['js'][] = 'libs/kemoji/lib/prettify.js';
        $data['js'][] = 'libs/kemoji/kemoji.min.js';
        $data['js'][] = 'libs/sticky-kit/jquery.sticky-kit.js';
        $data['js'][] = 'index/js/comments/links/script.js';
        /**
         * Page title
         */
        $data['comments'] = comments_getToLink($_GET['id']);

        renderView('index/comments/link/index/index/index', $data);
    } else {
        header('Location: /');
    }
}