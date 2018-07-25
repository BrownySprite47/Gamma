<?php

function index(){
    if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
        $data['news_link_admin'] = '';
        $data['title'] = 'Админ - Архив новостей';
        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/news/deleted/script.js';

        $settings['count_on_page'] = 10;
        $data['countpages'] = intval((db_count('news', '', ' WHERE checked = 2') - 1) / $settings['count_on_page']) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

        if ($data['numpage'] < 1)                    $data['numpage'] = 1;
        if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];

        $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);
        $data['news'] = getNewsFromDb(2, null, false, $limit);

        if (!empty($_POST)) {
            renderView('admin/news/deleted/layouts/index', $data);
        }else{
            renderView('admin/news/deleted/index/index', $data);
        }
    }else{
        header('Location: /');
    }
}