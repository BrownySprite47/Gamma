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
        $data['user'] = getData(getUserData($_SESSION['id_lid']));

        /**
         * get data about user files
         */
        $data['project_files'] = getUserFiles($_SESSION['id_lid']);

        /**
         * get data about user links
         */
        $data['leaders_link'] = getUserLinks($_SESSION['id_lid']);

        /**
         * get data about user projects
         */
        $data['projects'] = getOneLeaderProjects($_SESSION['id_lid']);
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
        $data['css'][] = 'css/user/edit/style.css';
        $data['js'][] = 'js/user/edit/script.js';

        /**
         * Require view
         */
        renderView('user/edit/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
