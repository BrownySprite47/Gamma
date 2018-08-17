<?php
/**
 * Page /admin/news
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
        $data['title'] = 'Админ - Новости';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/index/style.css';

        $data['js'][] = 'admin/js/news/view/script.js';

        /**
         * set the number of leaders per page
         */
        $settings['count_on_page'] = 10;

        $data['countpages'] = intval((db_count('news', '', ' WHERE checked = 1') - 1) / $settings['count_on_page']) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

        if ($data['numpage'] < 1) {
            $data['numpage'] = 1;
        }

        if ($data['numpage'] > $data['countpages']) {
            $data['numpage'] = $data['countpages'];
        }

        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];

        $limit = main_limit($data['startproject'], $settings['count_on_page']);

        /**
         * get all the news according to the conditions and limit
         */
        $data['news'] = news_get(1, false, $limit);

        if (!empty($_POST)) {

            /**
             * Require view
             */
            renderView('admin/news/view/layouts/index', $data);
        } else {

            /**
             * Require view
             */
            renderView('admin/news/view/index/index', $data);
        }
    } else {
        header('Location: /');
    }
}
