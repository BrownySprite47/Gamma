<?php
/**
 * Page /admin/leaders
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
        /**
         * Activation admin menu link
         */
        $data['leaders_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Лидеры';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/index/style.css';

        $data['js'][] = 'admin/js/leaders/index/script.js';

        /**
         * Choose the request according to the conditions
         */
        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' checked != 2 ';
        } elseif ($_POST['condition'] == '4') {
            $checked = ' (user_id != 0 OR user_id != "") ';
        } elseif ($_POST['condition'] == '5') {
            $checked = ' (user_id = 0 OR user_id = "") ';
        } else {
            $checked = ' checked = ' . main_checkChars($_POST['condition']) . " ";
        }

        /**
         * set the number of leaders per page
         */
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? main_checkChars($_POST['count_on_page']) : '10';

        /**
         * get all the leaders according to the conditions
         */
        $data['all_leaders'] = admin_leader_get($checked, '', '', '');

        $data['countpages'] = intval((db_count('leaders', '', " WHERE " . $checked) - 1) / $settings['count_on_page']) + 1;
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
            if ($_POST['type'] == 'leader') {
                $checked = ' id_lid=' . main_checkChars($_POST['leader']) . ' ';
                $_POST['condition'] = 'all';
                $_POST['status'] = 'all';
            }

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'status') {
                $checked = ' status = ' . main_checkChars($_POST['status']) . ' ';
                $_POST['condition'] = 'all';
                $_POST['leader'] = 'all';
            }

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'condition') {
                $_POST['status'] = 'all';
                $_POST['leader'] = 'all';
            }
           
            $data['leaders'] = admin_leader_get($checked, '', $limit);

            /**
             * if a particular leader is chosen, then set the limit 1
             */
            if ($_POST['leader'] != 'all') {
                $data['countpages'] = 1;
            } else {
                $data['countpages'] = intval(
                    (db_count('leaders', " WHERE " . $checked) - 1) / $settings['count_on_page']
                ) + 1;
            }

            /**
             * Require view
             */
            renderView('admin/leaders/index/layouts/index', $data);
        } else {
            $data['leaders'] = admin_leader_get($checked, '', $limit);

            /**
             * Require view
             */
            renderView('admin/leaders/index/index/index', $data);
        }
    } else {
        header('Location: /');
    }
}
