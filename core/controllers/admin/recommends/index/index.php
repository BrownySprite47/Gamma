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
        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/recommends/script.js';

        /**
         * Choose the request according to the conditions
         */
        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' r.checked !=2 ';
        } else {
            $checked = ' r.checked = '.checkChars($_POST['condition'])." ";
        }

        /**
         * set the number of recommends per page
         */
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? checkChars($_POST['count_on_page']): '10';

        /**
         * Get data on leaders who have recommended others
         */
        $data['from_recommend'] = getAdminRecommendsFrom();

        /**
         * Get data on the leaders who were recommended
         */
        $data['to_recommend'] = getAdminRecommendsTo();

        /**
         * Get data on all the leaders to create a recommendation at the bottom of the page
         */
        $data['create_recommends'] = getUsersAdminRecommendsLeaders();
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
        $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);

        if (!empty($_POST)) {

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'condition') {
                $checked = ' r.checked = '.checkChars($_POST['condition']).' ';
                $_POST['from_recommend'] = 'all';
                $_POST['to_recommend'] = 'all';
            }

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'from_recommend') {
                $checked = ' r.user_id='.checkChars($_POST['from_recommend']).' ';
                $_POST['condition'] = 'all';
                $_POST['to_recommend'] = 'all';
            }

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'to_recommend') {
                $checked = ' r.id_lid='.checkChars($_POST['to_recommend']).' ';
                $_POST['from_recommend'] = 'all';
                $_POST['condition'] = 'all';
            }
            /**
             * get all the recommends according to the conditions
             */
            $data['recommends'] = getAdminRecommends($limit, '', ' GROUP BY l.id_lid ', $checked);

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
            $data['recommends'] = getAdminRecommends($limit, '', ' GROUP BY l.id_lid ', $checked);

            /**
             * Require view
             */
            renderView('admin/recommends/index/index/index', $data);
        }
    } else {
        header('Location: /');
    }
}
