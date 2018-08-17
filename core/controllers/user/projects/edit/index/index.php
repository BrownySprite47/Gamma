<?php
/**
 * Page /user/projects/edit
 */
function index()
{
    if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user')) {

        if(isset($_GET['id']) && is_numeric($_GET['id']) && main_getProjectAccess($_GET['id'])) {
        /**
         * get information about the project
         */
        $data['project'] = getProject($_GET['id']);

        /**
         * get information for correct display of data
         */
        $data['localizations'] = projects_getLocalizations();


        $data['leaders'] = getOneProjectLeaders($_GET['id']);

        /**
         * Leaders filter block
         */
        $data['leaders_fio'] = leaders_getFioForProject();

        /**
         * get information about project files
         */
        $data['files'] = files_getProjectFiles($_GET['id']);

        /**
         * get information about project links
         */
        $data['links'] = links_getProjectLinks($_GET['id']);

        /**
         * Activation user menu link
         */
        $data['user_logo'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Редактирование проекта';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'user/css/projects/edit/style.css';
        $data['css'][] = 'user/css/projects/edit/media.css';
        $data['js'][] = 'user/js/projects/edit/script.js';

        /**
         * Require view
         */
        renderView('user/projects/edit/index/index/index', $data);
        } else {
            header('Location: /user/projects/add');
        }
    } else {
        header('Location: /');
    }
}
