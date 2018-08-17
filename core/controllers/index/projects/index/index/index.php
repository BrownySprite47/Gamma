<?php
/**
 * Page /index/projects
 */
function index()
{
    /**
     * save the current state of filters on the page
     */
    if (!empty($_POST)) {
        $_SESSION['save_data_projects_redirect'] = $_POST;
    } else {
        if (isset($_SESSION['save_data_projects_redirect'])) {
            $_POST = $_SESSION['save_data_projects_redirect'];
            $_POST['redir_url'] = true;
        }
    }

    /**
     * getting data for the filter
     */
    $data['filters'] = projects_getFilters($_POST);

    /**
     * get information for correct display of filter
     */
    $data['localizations'] = projects_getLocalizations();

    /**
     * Receiving data for a dynamic filter, depending on conditions
     */
    $data['dynamicFilter'] = projects_getDynamicFilter($data['filters'], $data['localizations']);

    /**
     * set the number of projects per page
     */
    $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? $_POST['count_on_page'] : '10';

    if (empty($_POST)) {
        $data['countpages'] = intval((db_count('projects') - 1) / $settings['count_on_page']) + 1;
    } else {
        $where = projects_getWhereForFilter($_POST);
        $data['countpages'] = intval((db_count('projects', $where) - 1) / $settings['count_on_page']) + 1;
    }

    $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

    if ($data['numpage'] < 1) {
        $data['numpage'] = 1;
    }
    if ($data['numpage'] > $data['countpages']) {
        $data['numpage'] = $data['countpages'];
    }

    $startproject = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
    $limit = main_limit($startproject, $settings['count_on_page']);

    if (!empty($_POST)) {
        /**
         * Choose the request according to the conditions
         */
        $where = projects_getWhereForFilter($_POST);

        /**
         * Get data on projects according to the conditions and the established limit
         */
        $data['projects'] = projects_get($where, $limit);

        /**
         * Get data on all projects according to the conditions
         */
        $data['all_projects'] = projects_get($where, '');
    } else {

        /**
         * Get data on all projects according to the established limit
         */
        $data['projects'] = projects_get('', $limit);
    }

    /**
     * Activation main menu link
     */
    $data['projects_link'] = 'active_menu';

    /**
     * Page title
     */
    $data['title'] = 'Проекты';

    /**
     * Require css and js files for page
     */
    $data['css'][] = 'index/css/projects/index/style.css';
    $data['css'][] = 'index/css/projects/index/media.css';

    $data['js'][] = 'index/js/projects/index/script.js';

    if (empty($_POST) && empty($_SESSION['save_data_projects_redirect'])) {

        /**
         * Require view
         */
        renderView('index/projects/index/index/index/index', $data);
    } elseif (!empty($_POST) && !empty($_SESSION['save_data_projects_redirect']) && !isset($_POST['redir_url'])) {

        /**
         * Require view
         */
        renderView('index/projects/index/index/layouts/index', $data);
    } elseif (!empty($_POST) && !empty($_SESSION['save_data_projects_redirect']) && isset($_POST['redir_url'])) {

        /**
         * Require view
         */
        renderView('index/projects/index/index/index/index', $data);
    } elseif (empty($_POST) && !empty($_SESSION['save_data_projects_redirect'])) {

        /**
         * Require view
         */
        renderView('index/projects/index/index/index/index', $data);
    }
}
