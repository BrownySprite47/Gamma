<?php
/**
 * Page /admin/leaders/edit
 */
function index()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin' && is_numeric($_GET['id'])) {
        /**
         * Activation admin menu link
         */
        $data['leaders_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Редактирование лидера';

        /**
         * get user information
         */
        $data['user'] = getData(getUserData($_GET['id']));

        /**
         * get information about the user's files
         */
        $data['project_files'] = getUserFiles($_GET['id']);

        /**
         * get information about the user's links
         */
        $data['leaders_link'] = getUserLinks($_GET['id']);

        /**
         * get information about the user's projects
         */
        $data['projects'] = getOneLeaderProjects($_GET['id']);

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'css/leaders/edit/style.css';
        $data['js'][] = 'js/leaders/edit/script.js';

        /**
         * Require view
         */
        renderView('leaders/edit/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
