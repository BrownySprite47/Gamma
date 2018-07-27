<?php
/**
 * Page /admin/news/edit
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
        /**
         * Activation admin menu link
         */
        $data['news_link_admin'] = '';

        /**
         * Get data about the news for editing
         */
        $data['news'] = getNewsFromDb('', $_GET['id'], false);

        /**
         * Page title
         */
        $data['title'] = 'Админ - редактирование новости';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/news/edit/script.js';

        /**
         * Require view
         */
        renderView('admin/news/edit/index/index', $data);
    } else {
        header('Location: /');
    }
}
