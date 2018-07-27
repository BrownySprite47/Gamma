<?php
/**
 * Page /projects/edit
 */
function index()
{
    if (isset($_GET['id']) && is_numeric($_GET['id']) && getUserProjectsAccess($_GET['id'])) {

        /**
         * get information about the project
         */
        $data['project'] = getProject($_GET['id']);

        /**
         * get information for correct display of data
         */
        $data['localizations'] = getLocalizations();


        $data['leaders'] = getOneProjectLeaders($_GET['id']);
//        $data['leaders_fio'] = getLeadersFioFromProject();
        /**
         * TODO проверить будет ли работать с удаленной строкой выше
         */
        /**
         * get information about project files
         */
        $data['files'] = getProjectFiles($_GET['id']);

        /**
         * get information about project links
         */
        $data['links'] = getProjectLinks($_GET['id']);


        if($_SESSION['role'] == 'user'){

            /**
             * Activation user menu link
             */
            $data['user_logo'] = '';
        }else{

            /**
             * Activation admin menu link
             */
            $data['projects_link_admin'] = '';
        }

        /**
         * Page title
         */
        $data['title'] = 'Редактирование проекта';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'css/projects/edit/style.css';
        $data['js'][] = 'js/projects/edit/script.js';

        /**
         * Require view
         */
        renderView('projects/edit/index/index/index', $data);
    } else {
        header('Location: /');
        exit();
    }
}
