<?php

function index(){
    if ($_SESSION['role'] == 'user' && is_numeric($_GET['id']) && getUserRecommendsAccess($_GET['id'])){
        $data = getOneLeaderRecom($_GET['id']);
        $data['recomendations'] = '';
        $data['title'] = 'Редактирование рекомендации';
        $data['css'][] = 'css/recommends/edit/style.css';
        $data['js'][] = 'js/recommends/edit/script.js';
        renderView('/recommends/edit/index/index', $data);
    }
    else{
        header('Location: /');
    }
}