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
        $data['tags'] = getTagsNamesUser();
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
        $data['css'][] = 'css/user/tags/style.css';
        $data['js'][] = 'js/user/tags/script.js';

        /**
         * Require view
         */
        renderView('user/tags/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
