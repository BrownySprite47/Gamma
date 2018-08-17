<?php
/**
 * Page /admin/tags
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
        /**
         * Activation admin menu link
         */
        $data['tags_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Теги';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/index/style.css';
        $data['js'][] = 'admin/js/tags/index/script.js';

        /**
         * Choose the request according to the conditions
         */
        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' t.checked !=2 ';
        } else {
            $checked = ' t.checked = '.main_checkChars($_POST['condition'])." ";
        }

        /**
         * set the number of tags per page
         */
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? main_checkChars($_POST['count_on_page']): '10';
        $data['all_tags'] = tags_get('', '', '');

        $data['countpages'] = intval(
            (db_count('tags AS t', '', " WHERE ".$checked) - 1) / $settings['count_on_page']
        ) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

        if ($data['numpage'] < 1) {
            $data['numpage'] = 1;
        }
        if ($data['numpage'] > $data['countpages']) {
            $data['numpage'] = $data['countpages'];
        }

        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
        $limit = main_limit($data['startproject'], $settings['count_on_page']);

        if (!empty($_POST)) {

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'condition') {
                $checked = ' t.checked = '.main_checkChars($_POST['condition']).' ';
                $_POST['tag'] = 'all';
            }

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'tag') {
                $checked = ' t.id='.main_checkChars($_POST['tag']).' ';
                $_POST['condition'] = 'all';
            }

            /**
             * get all the tags according to the conditions and limit
             */
            $data['tags'] = tags_get($checked, '', $limit);

            /**
             * set the number of tags per page
             */
            $data['countpages'] = intval(
                (db_count('tags AS t', '', " WHERE ".$checked) - 1) / $settings['count_on_page']
            ) + 1;

            /**
             * Require view
             */
            renderView('admin/tags/index/layouts/index', $data);
        } else {
            $data['tags'] = tags_get($checked, '', $limit);

            /**
             * Require view
             */
            renderView('admin/tags/index/index/index', $data);
        }
    } else {
        header('Location: /');
    }
}
