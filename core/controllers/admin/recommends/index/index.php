<?php
/**
 * Page /admin/recommends
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
        /**
         * Activation admin menu link
         */
        $data['recommend_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Список рекомендаций';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/index/style.css';
        $data['css'][] = 'admin/css/recommends/index/style.css';
        $data['js'][] = 'admin/js/recommends/index/script.js';

        /**
         * Choose the request according to the conditions
         */
        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' r.checked !=2 ';
        } else {
            $checked = ' r.checked = '.main_checkChars($_POST['condition'])." ";
        }

        /**
         * set the number of recommends per page
         */
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? main_checkChars($_POST['count_on_page']): '10';

        /**
         * Get data on leaders who have recommended others
         */
        $data['from_recommend'] = admin_getRecommendsFrom();

        /**
         * Get data on the leaders who were recommended
         */
        $data['to_recommend'] = admin_getRecommendsTo();

        /**
         * Get data on all the leaders to create a recommendation at the bottom of the page
         */
        $data['create_recommends'] = admin_getRecommendsLeaders();
        $data['countpages'] = intval(
            (db_count('recommend_leaders AS r', '', " WHERE ".$checked) - 1) / $settings['count_on_page']
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
                $checked = ' r.checked = '.main_checkChars($_POST['condition']).' ';
                $_POST['from_recommend'] = 'all';
                $_POST['to_recommend'] = 'all';
            }

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'from_recommend') {
                $checked = ' r.user_id='.main_checkChars($_POST['from_recommend']).' ';
                $_POST['condition'] = 'all';
                $_POST['to_recommend'] = 'all';
            }

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'to_recommend') {
                $checked = ' r.id_lid='.main_checkChars($_POST['to_recommend']).' ';
                $_POST['from_recommend'] = 'all';
                $_POST['condition'] = 'all';
            }
            /**
             * get all the recommends according to the conditions
             */
            $data['recommends'] = admin_getRecommends($limit, '', '', $checked);



            /**
             * if a particular recommend is chosen, then set the limit 1
             */
            if ($_POST['from_recommend'] != 'all' || $_POST['to_recommend'] != 'all') {
                $data['countpages'] = 1;
            } else {
                $data['countpages'] = intval((db_count('recommend_leaders AS r', '', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
            }

            /**
             * Require view
             */
            renderView('admin/recommends/index/layouts/index', $data);
        } else {
            $data['recommends'] = admin_getRecommends($limit, '', '', $checked);

            /**
             * Require view
             */
            renderView('admin/recommends/index/index/index', $data);
        }
    } else {
        header('Location: /');
    }
}
