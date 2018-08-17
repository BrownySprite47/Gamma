<?php
/**
 * Page /user/projects/add
 */
function index()
{
    if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user')) {

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
        /**
         * Activation user menu link
         */
        $data['user_logo'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Создание проекта';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'user/css/projects/add/style.css';
        $data['css'][] = 'user/css/projects/add/media.css';
        $data['js'][] = 'user/js/projects/add/script.js';

        /**
         * Require view
         */
        renderView('user/projects/add/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
