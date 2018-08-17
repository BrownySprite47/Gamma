<?php
/**
 * Page /admin/news/create
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
        /**
         * Activation admin menu link
         */
        $data['news_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Создание новости';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/index/style.css';

        $data['js'][] = 'admin/js/news/add/script.js';

        /**
         * Require view
         */
        renderView('admin/news/create/index/index', $data);
    } else {
        header('Location: /');
    }
}
