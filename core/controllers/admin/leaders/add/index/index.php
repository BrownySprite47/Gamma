<?php
/**
 * Page /admin/leaders/add
 */
function index()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        /**
         * Activation admin menu link
         */
        $data['leaders_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Создание лидера';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/index/style.css';
        $data['css'][] = 'admin/css/leaders/add/style.css';
        $data['css'][] = 'admin/css/leaders/add/media.css';

        $data['js'][] = 'admin/js/leaders/add/script.js';

        /**
         * Require view
         */
        renderView('admin/leaders/add/index/index', $data);
    } else {
        header('Location: /');
    }
}
