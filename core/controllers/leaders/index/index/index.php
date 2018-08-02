<?php
/**
 * Page /admin/leaders
 */
function index()
{
    /**
     * save the current state of filters on the page
     */
    if (!empty($_POST)) {
        $_SESSION['save_data_leaders_redirect'] = $_POST;
    } else {
        if (isset($_SESSION['save_data_leaders_redirect'])) {
            $_POST = $_SESSION['save_data_leaders_redirect'];
            $_POST['redir_url'] = true;
        }
    }

    /**
     * get the data from the filters
     */
    $fio_filter = ($_POST && isset($_POST['fio_filter']) ? checkChars($_POST['fio_filter']) : '');
    $city_filter = ($_POST && isset($_POST['city_filter']) ? checkChars($_POST['city_filter']) : '');
    $a_z = ($_POST && isset($_POST['a_z']) ? checkChars($_POST['a_z']) : '');
    $z_a = ($_POST && isset($_POST['z_a']) ? checkChars($_POST['z_a']) : '');

    /**
     * If the user is not registered, then we block some of the filters
     */
    if (!isset($_SESSION['role'])) {
        $want_filter = 'all';
        $can_filter = 'all';
        $help_to_me = '0';
        $i_can_help = '0';
    } else {
        $want_filter = ($_POST && isset($_POST['want_filter']) ? checkChars($_POST['want_filter']) : '');
        $can_filter = ($_POST && isset($_POST['can_filter']) ? checkChars($_POST['can_filter']) : '');
        $help_to_me = ($_POST && isset($_POST['help_to_me']) ? checkChars($_POST['help_to_me']) : '');
        $i_can_help = ($_POST && isset($_POST['i_can_help']) ? checkChars($_POST['i_can_help']) : '');
    }

    /**
     * get all leader data for the filter
     */
    $data['filter'] = getFiltersLeaders();

    /**
     * set the number of leaders per page
     */
    $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? $_POST['count_on_page'] : '10';

    if (!empty($_POST) && ($fio_filter != 'all' || $city_filter != 'all' || $want_filter != 'all' || $can_filter != 'all')) {
        $where = getWhereForFilterLeaders($_POST);
        $data['countpages'] = intval((db_count('leaders', $where) - 1) / $settings['count_on_page']) + 1;
    } else {
        $data['countpages'] = intval((db_count('leaders') - 1) / $settings['count_on_page']) + 1;
    }

    $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

    if ($data['numpage'] < 1) {
        $data['numpage'] = 1;
    }
    if ($data['numpage'] > $data['countpages']) {
        $data['numpage'] = $data['countpages'];
    }

    $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];

    $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);

    $where = [];
    $want_need_arr = [];
    /**
     * Set the request according to the conditions
     */
    $where[] = "l.checked != '2' AND (l.status = '3' OR l.status = '2')";

    /**
     * Choose the request according to the conditions
     */
    if ($fio_filter != 'all') {
        $where[] = " l.fio='".$fio_filter."'";
        if ($help_to_me == '') {
            $i_want = '';
        }
        if ($i_can_help == '') {
            $i_can = '';
        }
    }

    /**
     * Choose the request according to the conditions
     */
    if ($city_filter != 'all') {
        $where[] = " l.city='".$city_filter."'";
    }

    /**
     * Choose the request according to the conditions
     */
    if ($want_filter != 'all') {
        $want_need_arr[] = " tl.id_tag='".$want_filter."' AND type = '1'";
    }

    /**
     * Choose the request according to the conditions
     */
    if ($can_filter != 'all') {
        $want_need_arr[] = " tl.id_tag='".$can_filter."' AND type = '0'";
    }

    $order_by = ' ORDER BY l.id_lid ASC ';

    /**
     * Choose the request according to the conditions
     */
    if ($a_z == '1') {
        $order_by = ' ORDER BY l.fio ASC ';
    }

    /**
     * Choose the request according to the conditions
     */
    if ($z_a == '1') {
        $order_by = ' ORDER BY l.fio DESC ';
    }

    $i_want = '';
    $i_can = '';

    /**
     * Choose the request according to the conditions
     */
    if ($help_to_me == '1') {
        $i_want = '1';
    }
    if ($i_can_help == '1') {
        $i_can = '1';
    }

    $where_str = implode(" AND ", $where);
    $want_need = implode(" AND ", $want_need_arr);

    if ($want_need != '') {
        $want_need = ' AND '.$want_need;
    }

    /**
     * set the number of leaders per page according to the conditions
     */
    if ($want_filter == 'all' && $can_filter == 'all') {
        $data['countpages'] = intval((db_count('leaders as l', " WHERE ".$where_str) - 1) / $settings['count_on_page']) + 1;
    } else {
        $data['countpages'] = intval((db_count_want_need($where_str.$want_need) - 1) / $settings['count_on_page']) + 1;
    }

    /**
     * Activation main menu link
     */

    $data['leaders_link'] = 'active_menu';

    /**
     * Page title
     */
    $data['title'] = 'Лидеры';

    /**
     * Require css and js files for page
     */
    $data['css'][] = 'css/leaders/index/style.css';
    $data['css'][] = 'css/leaders/index/media.css';
    $data['js'][] = 'js/leaders/index/script.js';

    /**
     * If the leader is completely filled in the profile, we give him full access
     */
    if (!isset($_SESSION['id']) || !$_SESSION['access']['recom'] || !$_SESSION['access']['info'] || !$_SESSION['access']['proj']) {
        $data['access_full'] = false;
    } else {
        $data['access_full'] = true;
    }

    if (empty($_POST) && empty($_SESSION['save_data_leaders_redirect'])) {

        /**
         * Get data on leaders according to the conditions and the established limit
         */
        $data['leader'] = getLeaders('', ' ORDER BY l.id_lid ASC ', $limit);

        /**
         * Require view
         */
        renderView('leaders/index/index/index/index', $data);
    } elseif (!empty($_POST) && !empty($_SESSION['save_data_leaders_redirect']) && !isset($_POST['redir_url'])) {

        /**
         * Get data on leaders according to the conditions and the established limit
         */
        $data['leader'] = getLeaders(" WHERE ".$where_str, $order_by, $limit, $want_need, $i_want, $i_can);

        /**
         * Require view
         */
        renderView('leaders/index/index/layouts/index', $data);
    } elseif (!empty($_POST) && !empty($_SESSION['save_data_leaders_redirect']) && isset($_POST['redir_url'])) {

        /**
         * Obtaining data on leaders according to the conditions and the established limit
         */
        $data['leader'] = getLeaders(" WHERE ".$where_str, $order_by, $limit, $want_need, $i_want, $i_can);

        /**
         * Require view
         */
        renderView('leaders/index/index/index/index', $data);
    } elseif (empty($_POST) && !empty($_SESSION['save_data_leaders_redirect'])) {

        /**
         * Obtaining data on leaders according to the conditions and the established limit
         */
        $data['leader'] = getLeaders(" WHERE ".$where_str, $order_by, $limit, $want_need, $i_want, $i_can);

        /**
         * Require view
         */
        renderView('leaders/index/index/index/index', $data);
    }
}
