<?php
/**
 * Page /admin/doubles
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
        /**
         * var $checked (0 - not checked, 1 - checked, 2 - deleted)
         */
        /**
         * Activation admin menu link
         */
        $data['user_doubles_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Привязки';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/doubles/script.js';

        /**
         * var $checked
         */
        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' checked !=2 ';
        } else {
            $checked = ' checked = '.checkChars($_POST['condition'])." ";
        }
        /**
         * set the number of doubles per page
         */
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? checkChars($_POST['count_on_page']): '10';


       // $data['all_doubles'] = getUsersAdminDoubles($checked, '', '');

        $data['countpages'] = intval(
            (db_count('doubles', '', " WHERE ".$checked) - 1) / $settings['count_on_page']
        ) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

        if ($data['numpage'] < 1) {
            $data['numpage'] = 1;
        }
        if ($data['numpage'] > $data['countpages']) {
            $data['numpage'] = $data['countpages'];
        }

        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
        $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);

        /**
         * get all registered users who are not yet leaders for the filter at the bottom of the page
         */
        $data['user_doubles'] = getUsersAdminDoublesUsers();

        /**
         * get all unregistered leaders with status 2 or 3 for the filter at the bottom of the page
         */
        $data['leader_doubles'] = getUsersAdminDoublesLeaders();

        if (!empty($_POST)) {
            if ($_POST['type'] == 'condition') {
                $checked = ' checked = '.checkChars($_POST['condition']).' ';
            }

            /**
             * get all the doubles according to the conditions and limit
             */
            $data['doubles'] = getUsersAdminDoubles($checked, '', $limit);
            $data['countpages'] = intval(
                (db_count('doubles', '', " WHERE ".$checked) - 1) / $settings['count_on_page']
            ) + 1;

            /**
             * get all the doubles according to the conditions and limit
             */
            renderView('admin/doubles/index/layouts/index', $data);
        } else {
            $data['doubles'] = getUsersAdminDoubles($checked, '', $limit);

            /**
             * Require view
             */
            renderView('admin/doubles/index/index/index', $data);
        }
    } else {
        header('Location: /');
    }
}
