<?php
/**
 * Page /user
 */
function index()
{
    if (isset($_SESSION['id']) && $_SESSION['role'] == 'user') {

        /**
         * get data about user tags
         */
        $data['tags'] = user_getTags();

        /**
         * get data about user doubles
         */
        $data['check_double'] = user_getDouble();

        /**
         * get data about user projects
         */
        $data['projects'] = getProjectsFromUser($_SESSION['id_lid']);

        /**
         * get data about user files
         */
        $data['files'] = files_getUserFiles($_SESSION['id_lid']);


        /**
         * get data about user links
         */
        $data['links'] = links_getUserLinks($_SESSION['id_lid']);

        /**
         * get data about user recommends
         */
        $data['recom'] = getUserRecommendsCount($_SESSION['id_lid']);

        /**
         * get data about user
         */
        $data['user'] = getData(user_get($_SESSION['id_lid']));

        /**
         * get data about user social
         */
        $data['social'] = getData(getUser($_SESSION['id']));

        /**
         * Activation admin menu link
         */
        $data['user_logo'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Профиль';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'user/css/index/style.css';
        $data['css'][] = 'user/css/index/media.css';

        $data['js'][] = 'user/js/index/script.js';

        /**
         * Require view
         */
        renderView('user/index/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
