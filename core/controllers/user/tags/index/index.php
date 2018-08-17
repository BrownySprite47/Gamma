<?php
/**
 * Page /user/tags
 */
function index()
{
    if ($_SESSION['role'] == 'user') {

        /**
         * get data about user tags
         */
        $data['tags'] = user_getTags();
        /**
         * Activation admin menu link
         */
        $data['change_experience'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Теги';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'user/css/tags/index/style.css';
        $data['css'][] = 'user/css/tags/index/media.css';

        $data['js'][] = 'user/js/tags/index/script.js';

        /**
         * Require view
         */
        renderView('user/tags/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
