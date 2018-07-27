<?php
/**
 * Page /projects/add
 */
function index()
{
    if (isset($_SESSION['id'])) {

        /**
         * obtaining information for correct display of data
         */
        $data['localizations'] = getLocalizations();
//        $data['type'] = 'projects';
        /**
         * TODO Проверить работает ли с удаленной строкой выше
         */

        /**
         * getting information about project leaders
         */
        $data['leaders'] = getLeadersFioFromProject();

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
        $data['title'] = 'Создание проекта';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'css/projects/add/style.css';
        $data['js'][] = 'js/projects/add/script.js';

        /**
         * Require view
         */
        renderView('projects/add/index/index/index', $data);
    } else {
        header('Location: /user');
        exit();
    }
}
