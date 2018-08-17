<?php
/**
 * Page /user/edit
 */
function index()
{
    if ($_SESSION['role'] == 'user') {

        /**
         * get user data
         */
        $data['user'] = getData(user_get($_SESSION['id_lid']));

        /**
         * get data about user files
         */
        $data['files'] = files_getUserFiles($_SESSION['id_lid']);

        /**
         * get data about user links
         */
        $data['links'] = links_getUserLinks($_SESSION['id_lid']);

        /**
         * get data about user projects
         */
        $data['projects'] = leader_getOneLeaderProjects($_SESSION['id_lid']);
        /**
         * Activation admin menu link
         */
        $data['user_logo'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Редактирование пользователя';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'user/css/edit/style.css';
        $data['css'][] = 'user/css/edit/media.css';
        $data['js'][] = 'user/js/edit/script.js';

        /**
         * Require view
         */
        renderView('user/edit/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
