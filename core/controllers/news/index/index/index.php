<?php

function index(){
    $data['news_link'] = 'active_menu';

    $data['events'] = getNewsEventsFromDb();

    $data['leaders_count'] = getLeadersFromDb();
    $data['recommends_count'] = getRecommendsCountFromDb();

    $settings['count_on_page'] = 50;

    $data['countpages'] = intval((db_count('news', '', " WHERE checked != 2 ") - 1) / $settings['count_on_page']) + 1;
   
    $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

    if ($data['numpage'] < 1)                    $data['numpage'] = 1;
    if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

    $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];

    $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);
    $data['news'] = getNewsFromDb(1, null, true, $limit);

    $data['css'][] = 'css/news/index/style.css';
    $data['js'][] = 'js/news/index/script.js';

    if (!empty($_POST)) {
        renderView('news/index/layouts/index/index/index', $data);
    }else{
        renderView('news/index/index/index/index', $data);
    } 
}
