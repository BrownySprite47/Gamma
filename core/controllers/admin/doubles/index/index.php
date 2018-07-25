<?php

function index(){
    if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
        $data['user_doubles_link_admin'] = '';
        $data['title'] = 'Админ - Привязки';
        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/doubles/script.js';

        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' checked !=2 ';
        }else{
            $checked = ' checked = '.checkChars($_POST['condition'])." ";
        }
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? checkChars($_POST['count_on_page']): '10';
        $data['all_doubles'] = getUsersAdminDoubles($checked, '', '');

        $data['countpages'] = intval((db_count('doubles', '', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

        if ($data['numpage'] < 1)                    $data['numpage'] = 1;
        if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
        $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);

        $data['user_doubles'] = getUsersAdminDoublesUsers();
        $data['leader_doubles'] = getUsersAdminDoublesLeaders();

        if (!empty($_POST)) {

            if ($_POST['type'] == 'condition') {
                $checked = ' checked = '.checkChars($_POST['condition']).' ';
            }

            $data['doubles'] = getUsersAdminDoubles($checked, '', $limit);
            $data['countpages'] = intval((db_count('doubles','', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;

            renderView('admin/doubles/index/layouts/index', $data);
        }else{
            $data['doubles'] = getUsersAdminDoubles($checked, '', $limit);
            renderView('admin/doubles/index/index/index', $data);
        }
    }else{
        header('Location: /');
    }
}