<?php

function index(){
    if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
        $data['recommend_link_admin'] = '';

        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/recommends/script.js';

        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' r.checked !=2 ';
        }else{
            $checked = ' r.checked = '.checkChars($_POST['condition'])." ";
        }
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? checkChars($_POST['count_on_page']): '10';
        // $data['all_recommends'] = getAdminRecommends('', '', ' GROUP BY r.id_lid ', $checked);
        $data['from_recommend'] = getAdminRecommendsFrom();
        $data['to_recommend'] = getAdminRecommendsTo();

        $data['create_recommends'] = getUsersAdminRecommendsLeaders();
        $data['countpages'] = intval((db_count('recommend_leaders AS r', '', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

        if ($data['numpage'] < 1)                    $data['numpage'] = 1;
        if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
        $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);

        if (!empty($_POST)) {

            if ($_POST['type'] == 'condition') {
                $checked = ' r.checked = '.checkChars($_POST['condition']).' ';
                $_POST['from_recommend'] = 'all';
                $_POST['to_recommend'] = 'all';
            }
            if ($_POST['type'] == 'from_recommend') {
                $checked = ' r.user_id='.checkChars($_POST['from_recommend']).' ';
                $_POST['condition'] = 'all';
                $_POST['to_recommend'] = 'all';
            }
            if ($_POST['type'] == 'to_recommend') {
                $checked = ' r.id_lid='.checkChars($_POST['to_recommend']).' ';
                $_POST['from_recommend'] = 'all';
                $_POST['condition'] = 'all';
            }
            $data['recommends'] = getAdminRecommends($limit, '', ' GROUP BY l.id_lid ', $checked);

            if($_POST['from_recommend'] != 'all' || $_POST['to_recommend'] != 'all'){
                $data['countpages'] = 1;
            }else{
                $data['countpages'] = intval((db_count('recommend_leaders AS r', '', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
            }
            renderView('admin/recommends/index/layouts/index', $data);
        }else{
            $data['recommends'] = getAdminRecommends($limit, '', ' GROUP BY l.id_lid ', $checked);
            renderView('admin/recommends/index/index/index', $data);
        }
    }else{
        header('Location: /');
    } 
}