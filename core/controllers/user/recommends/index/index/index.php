<?php

function index(){
    $data['recomendations'] = '';

    if ($_SESSION['role'] == 'user'){
        $data['recommend'] = getRecommendLeader();
        $data['css'][] = 'css/user/recommends/style.css';
        $data['js'][] = 'js/user/recommends/script.js';
        renderView('user/recommends/index/index/index', $data);
    }
    else{
        header('Location: /');
    }
}