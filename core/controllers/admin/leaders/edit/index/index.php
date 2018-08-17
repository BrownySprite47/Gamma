<?php
/**
 * Page /admin/leaders/edit
 */
function index()
{
    if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin')) {
        if(isset($_GET['id']) && is_numeric($_GET['id'])) {

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
            $data['user'] = user_get($_GET['id']);

            /**
             * get information about the user's files
             */
            $data['files'] = files_getUserFiles($_GET['id']);

            /**
             * get information about the user's links
             */
            $data['links'] = links_getUserLinks($_GET['id']);

            /**
             * get information about the user's projects
             */
            $data['projects'] = leader_getOneLeaderProjects($_GET['id']);

            /**
             * Require css and js files for page
             */
            $data['css'][] = 'admin/css/common/index/style.css';
            $data['css'][] = 'admin/css/leaders/edit/style.css';
            $data['css'][] = 'admin/css/leaders/edit/media.css';

            $data['js'][] = 'admin/js/leaders/edit/script.js';

            /**
             * Require view
             */
            renderView('admin/leaders/edit/index/index', $data);
        }else{
            header('Location: /admin/leaders/add');
        }
    } else {
        header('Location: /');
    }
}
