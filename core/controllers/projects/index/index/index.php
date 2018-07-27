<?php
/**
 * Page /projects
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
    $data['filters'] = getFilters();

    /**
     * get information for correct display of filter
     */
    $data['localizations'] = getLocalizations();

    /**
     * Receiving data for a dynamic filter, depending on conditions
     */
    $data['dynamicFilter'] = getDynamicFilter($data['filters'], $data['localizations']);

    /**
     * set the number of projects per page
     */
    $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? $_POST['count_on_page'] : '10';

    if (empty($_POST)) {
        $data['countpages'] = intval((db_count('projects') - 1) / $settings['count_on_page']) + 1;
    } else {
        $where = getWhereForFilter($_POST);
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
    $limit = getLimitForPageNavigation($startproject, $settings['count_on_page']);

    if (!empty($_POST)) {
        /**
         * Choose the request according to the conditions
         */
        $where = getWhereForFilter($_POST);

        /**
         * Get data on projects according to the conditions and the established limit
         */
        $data['projects'] = getProjects($where, $limit);

        /**
         * Get data on all projects according to the conditions
         */
        $data['all_projects'] = getProjects($where, '');
    } else {

        /**
         * Get data on all projects according to the established limit
         */
        $data['projects'] = getProjects('', $limit);
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
    $data['css'][] = 'css/projects/index/style.css';
    $data['js'][] = 'js/projects/index/script.js';

    if (empty($_POST) && empty($_SESSION['save_data_projects_redirect'])) {

        /**
         * Require view
         */
        renderView('projects/index/index/index/index', $data);
    } elseif (!empty($_POST) && !empty($_SESSION['save_data_projects_redirect']) && !isset($_POST['redir_url'])) {

        /**
         * Require view
         */
        renderView('projects/index/index/layouts/index', $data);
    } elseif (!empty($_POST) && !empty($_SESSION['save_data_projects_redirect']) && isset($_POST['redir_url'])) {

        /**
         * Require view
         */
        renderView('projects/index/index/index/index', $data);
    } elseif (empty($_POST) && !empty($_SESSION['save_data_projects_redirect'])) {

        /**
         * Require view
         */
        renderView('projects/index/index/index/index', $data);
    }
}
