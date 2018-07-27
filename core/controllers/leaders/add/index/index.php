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
        $data['css'][] = 'css/leaders/add/style.css';
        $data['js'][] = 'js/leaders/add/script.js';

        /**
         * Require view
         */
        renderView('leaders/add/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
