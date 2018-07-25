<?php

function index(){
    $data['recomendations'] = '';

    if ($_SESSION['role'] == 'user'){
        $data = getOneLeaderRecom($_GET['id']);
        $data['css'][] = 'css/recommends/edit/style.css';
        $data['js'][] = 'js/recommends/edit/script.js';
        renderView('/recommends/edit/index/index', $data);
    }
    else{
        header('Location: /');
    }
}