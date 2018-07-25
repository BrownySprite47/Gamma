<?php

function index(){
    if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
        $data['leaders_link_admin'] = '';
        $data['title'] = 'Админ - Лидеры';
        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/leaders/script.js';

        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' checked != 2 ';
        }elseif ($_POST['condition'] == '4') {
            $checked = ' (user_id != 0 OR user_id != "") ';
        }elseif ($_POST['condition'] == '5') {
            $checked = ' (user_id = 0 OR user_id = "") ';
        }else{
            $checked = ' checked = '.checkChars($_POST['condition'])." ";
        }
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? checkChars($_POST['count_on_page']): '10';
        $data['all_leaders'] = getLeadersAdmin($checked, '', '', 'list');

        $data['countpages'] = intval((db_count('leaders', '', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

        if ($data['numpage'] < 1)                    $data['numpage'] = 1;
        if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
        $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);

        if (!empty($_POST)) {

            if ($_POST['type'] == 'leader') {
                $checked = ' id_lid='.checkChars($_POST['leader']).' ';
                $_POST['condition'] = 'all';
                $_POST['status'] = 'all';
            }

            if ($_POST['type'] == 'status') {
                $checked = ' status = '.checkChars($_POST['status']).' ';
                $_POST['condition'] = 'all';
                $_POST['leader'] = 'all';
            }

            if ($_POST['type'] == 'condition') {
                //$checked = ' checked = '.checkChars($_POST['condition'])." ";
                $_POST['status'] = 'all';
                $_POST['leader'] = 'all';
            }
           
            $data['leaders'] = getLeadersAdmin($checked, '', $limit);

            
            if($_POST['leader'] != 'all'){
                $data['countpages'] = 1;
            }else{
                $data['countpages'] = intval((db_count('leaders', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
            }

            renderView('admin/leaders/index/layouts/index', $data);
        }else{
            $data['leaders'] = getLeadersAdmin($checked, '', $limit);
            renderView('admin/leaders/index/index/index', $data);
        }
    }else{
        header('Location: /');
    }
}