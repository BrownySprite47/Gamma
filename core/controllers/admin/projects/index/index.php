<?php
/**
 * Page /admin/projects
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
        /**
         * Activation admin menu link
         */
        $data['projects_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Проекты';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/projects/script.js';

        /**
         * Choose the request according to the conditions
         */
        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' checked !=2 ';
        } else {
            $checked = ' checked = '.checkChars($_POST['condition'])." ";
        }

        /**
         * set the number of projects per page
         */
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? checkChars($_POST['count_on_page']): '10';

        /**
         * get all the projects according to the conditions
         */
        $data['all_projects'] = getProjectsAdmin($checked, '', '');
        $data['countpages'] = intval(
            (db_count('projects', '', " WHERE ".$checked) - 1) / $settings['count_on_page']
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
            if ($_POST['type'] == 'project') {
                $checked = ' id_proj='.checkChars($_POST['project']).' ';
                $_POST['condition'] = 'all';
                $_POST['status'] = 'all';
            }

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'status') {
                $checked = ' status = '.checkChars($_POST['status']).' ';
                $_POST['condition'] = 'all';
                $_POST['project'] = 'all';
            }

            /**
             * Choose the request according to the conditions
             */
            if ($_POST['type'] == 'condition') {
                $checked = ' checked = '.checkChars($_POST['condition'])." ";
                $_POST['status'] = 'all';
                $_POST['project'] = 'all';
            }

            /**
             * get all the projects according to the conditions and limit
             */
            $data['projects'] = getProjectsAdmin($checked, '', $limit);

            /**
             * if a particular project is chosen, then set the limit 1
             */
            if ($_POST['project'] != 'all') {
                $data['countpages'] = 1;
            } else {
                $data['countpages'] = intval((db_count('projects', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
            }

            /**
             * Require view
             */
            renderView('admin/projects/index/layouts/index', $data);
        } else {
            $data['projects'] = getProjectsAdmin($checked, '', $limit);

            /**
             * Require view
             */
            renderView('admin/projects/index/index/index', $data);
        }
    } else {
        header('Location: /');
    }
}
