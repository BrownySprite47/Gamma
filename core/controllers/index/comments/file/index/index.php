<?php
/**
 * Page /index/comments/file
 */
function index(){
    if (isset($_SESSION['status']) && $_SESSION['status'] != '0') {
        $data = [];

        /**
         * Activation admin menu link
         */
        $data['user_logo'] = '';

        $data['file'] = files_getById($_GET['id']);

        if (!isset($data['file'][0])) {
            header('Location: /');
            exit();
        }
        /**
         * Page title
         */
        $data['title'] = 'Комментарии файла';

        /**
         * Get comments count
         */
//    $data['comments_count'] = getCountCommentsFiles($_GET['id']);

        $data['css'][] = 'libs/kemoji/lib/prettify.css';
        $data['css'][] = 'libs/kemoji/css/emoji.css';
        $data['css'][] = 'libs/kemoji/css/smiles.css';
        $data['css'][] = 'libs/kemoji/css/style.css';
        $data['css'][] = 'index/css/comments/files/style.css';
        $data['css'][] = 'index/css/comments/files/media.css';

        $data['js'][] = 'libs/kemoji/lib/prettify.js';
        $data['js'][] = 'libs/kemoji/kemoji.min.js';
        $data['js'][] = 'libs/sticky-kit/jquery.sticky-kit.js';
        $data['js'][] = 'index/js/comments/files/script.js';

        /**
         * Page title
         */
        $data['comments'] = comments_getToFiles($_GET['id']);

        renderView('index/comments/file/index/index/index', $data);
    } else {
        header('Location: /');
    }
}