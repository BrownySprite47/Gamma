<?php
/**
 * Page /index/projects/view
 */
function index()
{
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {

        /**
         * get information about the project
         */
        $data['project'] = getProject($_GET['id']);

        /**
         * get information for correct display
         */
        $data['localizations'] = projects_getLocalizations();

        /**
         * get information about project leaders
         */
        $data['leaders'] = getOneProjectLeaders($_GET['id']);

        /**
         * get information about project files
         */
        $data['files'] = files_getProjectFiles($_GET['id']);

        /**
         * get information about project links
         */
        $data['links'] = links_getProjectLinks($_GET['id']);
        /**
         * Activation main menu link
         */
        $data['projects_link'] = 'active_menu';

        /**
         * Page title
         */
        $data['title'] = 'Карточка проекта';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'index/css/projects/view/style.css';
        $data['css'][] = 'index/css/projects/view/media.css';
        $data['js'][] = 'index/js/projects/view/script.js';
        if (isset($_GET['id'])) {
            $data['getUserData'] = getData(admin_getUser($_GET['id']));
        }
        /**
         * Require view
         */
        renderView('index/projects/view/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
