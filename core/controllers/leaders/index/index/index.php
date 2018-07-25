<?php

function index() {
    if(!empty($_POST)){
        $_SESSION['save_data_leaders_redirect'] = $_POST;
    }else{
        if(isset($_SESSION['save_data_leaders_redirect'])){
            $_POST = $_SESSION['save_data_leaders_redirect'];
            $_POST['redir_url'] = true;
        }
    }
    $fio_filter = ($_POST && isset($_POST['fio_filter']) ? checkChars($_POST['fio_filter']) : '' );
    $city_filter = ($_POST && isset($_POST['city_filter']) ? checkChars($_POST['city_filter']) : '' );
    $a_z = ($_POST && isset($_POST['a_z']) ? checkChars($_POST['a_z']) : '' );
    $z_a = ($_POST && isset($_POST['z_a']) ? checkChars($_POST['z_a']) : '' );

    if(!isset($_SESSION['role'])) {
        $want_filter = 'all';
        $can_filter = 'all';
        $help_to_me = '0';
        $i_can_help = '0';
    }else{
        $want_filter = ($_POST && isset($_POST['want_filter']) ? checkChars($_POST['want_filter']) : '' );
        $can_filter = ($_POST && isset($_POST['can_filter']) ? checkChars($_POST['can_filter']) : '' );
        $help_to_me = ($_POST && isset($_POST['help_to_me']) ? checkChars($_POST['help_to_me']) : '' );
        $i_can_help = ($_POST && isset($_POST['i_can_help']) ? checkChars($_POST['i_can_help']) : '' );
    }

    $data['filter'] = getFiltersLeaders();
    $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? $_POST['count_on_page'] : '10';

    if (!empty($_POST) && ($fio_filter != 'all' || $city_filter != 'all' || $want_filter != 'all' || $can_filter != 'all')) {
        $where = getWhereForFilterLeaders($_POST);
        $data['countpages'] = intval((db_count('leaders', $where) - 1) / $settings['count_on_page']) + 1;
    }else{
        $data['countpages'] = intval((db_count('leaders') - 1) / $settings['count_on_page']) + 1;
    }

    $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

    if ($data['numpage'] < 1)                    $data['numpage'] = 1;
    if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

    $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];

    $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);

    $where = [];
    $want_need_arr = [];

    $where[] = "l.checked != '2' AND (l.status = '3' OR l.status = '2')";

    if($fio_filter != 'all')  {
        $where[] = " l.fio='".$fio_filter."'";
        if($help_to_me == '') $i_want = '';
        if($i_can_help == '') $i_can = '';
    }

    if($city_filter != 'all') $where[] = " l.city='".$city_filter."'";
    if($want_filter != 'all') $want_need_arr[] = " tl.id_tag='".$want_filter."' AND type = '1'";
    if($can_filter != 'all')  $want_need_arr[] = " tl.id_tag='".$can_filter."' AND type = '0'";

    $order_by = ' ORDER BY l.id_lid ASC ';

    if($a_z == '1') $order_by = ' ORDER BY l.fio ASC ';
    if($z_a == '1') $order_by = ' ORDER BY l.fio DESC ';

    $i_want = '';
    $i_can = '';

    if($help_to_me == '1') $i_want = '1';
    if($i_can_help == '1') $i_can = '1';

    $where_str = implode(" AND ", $where);
    $want_need = implode(" AND ", $want_need_arr);

    if($want_need != '') $want_need = ' AND '.$want_need;

    if($want_filter == 'all' && $can_filter == 'all'){
        $data['countpages'] = intval((db_count('leaders as l', " WHERE ".$where_str) - 1) / $settings['count_on_page']) + 1;
    }else{
        $data['countpages'] = intval((db_count_want_need($where_str.$want_need) - 1) / $settings['count_on_page']) + 1;
    }
    $data['leaders_link'] = 'active_menu';
    $data['title'] = 'Лидеры';
    $data['css'][] = 'css/leaders/index/style.css';
    $data['js'][] = 'js/leaders/index/script.js';

    if(!isset($_SESSION['id']) || !$_SESSION['access']['recom'] || !$_SESSION['access']['info'] || !$_SESSION['access']['proj']){
        $data['access_full'] = false;
    }else{
        $data['access_full'] = true;
    }

    if (empty($_POST) && empty($_SESSION['save_data_leaders_redirect'])) {
        $data['leader'] = getLeaders('',' ORDER BY l.id_lid ASC ', $limit);
        renderView('leaders/index/index/index/index', $data);
    }elseif (!empty($_POST) && !empty($_SESSION['save_data_leaders_redirect']) && !isset($_POST['redir_url'])) {
        $data['leader'] = getLeaders(" WHERE ".$where_str, $order_by, $limit, $want_need, $i_want, $i_can);
        renderView('leaders/index/index/layouts/index', $data);
    }elseif (!empty($_POST) && !empty($_SESSION['save_data_leaders_redirect']) && isset($_POST['redir_url'])) {
        $data['leader'] = getLeaders(" WHERE ".$where_str, $order_by, $limit, $want_need, $i_want, $i_can);
        renderView('leaders/index/index/index/index', $data);
    }elseif (empty($_POST) && !empty($_SESSION['save_data_leaders_redirect'])) {
        $data['leader'] = getLeaders(" WHERE ".$where_str, $order_by, $limit, $want_need, $i_want, $i_can);
        renderView('leaders/index/index/index/index', $data);
    }
}
