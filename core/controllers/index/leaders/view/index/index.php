<?php
/**
 * Page /index/leaders/view
 */
function index()
{
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        /**
         * TODO тут видимо получение разрешения на просмотр информации
         */
        if (isset($_SESSION['id_lid'])) {
            $data['user'] = leader_getLeader($_SESSION['id_lid']);
        }

        /**
         * get leader data
         */
        $data['leader'] = leader_getLeader($_GET['id']);

        /**
         * Getting information about leader projects
         */
        $data['projects'] = leader_getProjects($_GET['id'], 'id_lid');

        /**
         * Getting information about leader tags
         */
        $data['tags'] = leader_getTagsArray($_GET['id']);

        /**
         * Getting information about leader files
         */
        $data['files'] = files_getUserFiles($_GET['id']);

        /**
         * Getting information about leader links
         */
        $data['links'] = links_getUserLinks($_GET['id']);

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
        $data['css'][] = 'index/css/leaders/view/style.css';
        $data['css'][] = 'index/css/leaders/view/media.css';
        $data['js'][] = 'index/js/leaders/view/script.js';
    } else {
        header('Location: /');
        exit();
    }
    if (isset($_SESSION['id_lid'])) {

        /**
         * obtaining data on leader communications
         */
        $data['six_friends_small'] = leader_getFriends($_SESSION['id_lid'], $_GET['id']);
    }

    /**
     * Require view
     */
    renderView('index/leaders/view/index/index/index', $data);
}
