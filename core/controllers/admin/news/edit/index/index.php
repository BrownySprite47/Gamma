<?php
/**
 * Page /admin/news/edit
 */
function index()
{
    if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin')) {

        if(isset($_GET['id']) && is_numeric($_GET['id'])) {
            /**
             * Activation admin menu link
             */
            $data['news_link_admin'] = '';

            /**
             * Get data about the news for editing
             */
            $data['news'] = news_get('', $_GET['id'], false);

            /**
             * Page title
             */
            $data['title'] = 'Админ - редактирование новости';

            /**
             * Require css and js files for page
             */
            $data['css'][] = 'admin/css/common/index/style.css';

            $data['js'][] = 'admin/js/news/edit/script.js';

            /**
             * Require view
             */
            renderView('admin/news/edit/index/index', $data);
        } else {
            header('Location: /admin/news/add');
        }
    } else {
        header('Location: /');
    }
}
