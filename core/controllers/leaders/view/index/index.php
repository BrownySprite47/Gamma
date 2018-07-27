<?php
/**
 * Page /admin/leaders/view
 */
function index()
{
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        /**
         * TODO тут видимо получение разрешения на просмотр информации
         */
//        if (isset($_SESSION['id_lid'])) {
//            $data['user'] = getOneLeader($_SESSION['id_lid']);
//        }

        /**
         * get leader data
         */
        $data['leader'] = getOneLeader($_GET['id']);

        /**
         * Getting information about leader projects
         */
        $data['projects'] = getProjectsFromLeader($_GET['id'], 'id_lid');

        /**
         * Getting information about leader tags
         */
        $data['tags'] = getUserDataTags($_GET['id']);

        /**
         * Getting information about leader files
         */
        $data['files'] = getUserFiles($_GET['id']);

        /**
         * Getting information about leader links
         */
        $data['links'] = getUserLinks($_GET['id']);

        /**
         * Activation main menu link
         */
        $data['leaders_link'] = 'active_menu';

        /**
         * Page title
         */
        $data['title'] = 'Карточка лидера';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'css/leaders/view/style.css';
        $data['js'][] = 'js/leaders/view/script.js';
    } else {
        header('Location: /');
        exit();
    }
    if (isset($_SESSION['id_lid'])) {

        /**
         * obtaining data on leader communications
         */
        $data['six_friends_small'] = getSixFriendsSmall($_SESSION['id_lid'], $_GET['id']);
    }

    /**
     * Require view
     */
    renderView('leaders/view/index/index/index', $data);
}
