<?php
/**
 * Page /admin/projects/add
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {

        /**
         * obtaining information for correct display of data
         */
        $data['localizations'] = projects_getLocalizations();
//        $data['type'] = 'projects';
        /**
         * TODO Проверить работает ли с удаленной строкой выше
         */

        /**
         * getting information about project leaders
         */
        $data['leaders'] = leaders_getFioForProject();

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
        $data['css'][] = 'admin/css/projects/add/style.css';
        $data['css'][] = 'admin/css/projects/add/media.css';
        $data['js'][] = 'admin/js/projects/add/script.js';

        /**
         * Require view
         */
        renderView('admin/projects/add/index/index', $data);
    } else {
        header('Location: /user');
        exit();
    }
}
