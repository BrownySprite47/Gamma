<?php

function index(){
    $data['recomendations'] = '';
    $data['title'] = 'Добавление рекомендации';

//    if ($_SESSION['role'] == 'user' && is_numeric($_GET['id']) && getUserRecommendsAccess($_GET['id'])){
//        $data = getOneLeaderRecom($_GET['id']);
//        $data['css'][] = 'css/recommends/edit/style.css';
//        $data['js'][] = 'js/recommends/edit/script.js';
//        renderView('/recommends/edit/index/index', $data);
//    }
//    else{
//        header('Location: /');
//    }
}