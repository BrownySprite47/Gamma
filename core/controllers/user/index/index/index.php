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
        $data['tags'] = getTagsNamesUser();

        /**
         * get data about user doubles
         */
        $data['check_double'] = getCheckDouble();

        /**
         * get data about user projects
         */
        $data['projects'] = getProjectsFromUser($_SESSION['id_lid']);

        /**
         * get data about user files
         */
        $data['files'] = getUserFiles($_SESSION['id_lid']);

        /**
         * get data about user links
         */
        $data['links'] = getUserLinks($_SESSION['id_lid']);

        /**
         * get data about user recommends
         */
        $data['recom'] = getUserRecommendsCount($_SESSION['id_lid']);

        /**
         * get data about user
         */
        $data['user'] = getData(getUserData($_SESSION['id_lid']));

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
        $data['css'][] = 'css/user/index/style.css';
        $data['js'][] = 'js/user/index/script.js';

        /**
         * Require view
         */
        renderView('user/index/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
