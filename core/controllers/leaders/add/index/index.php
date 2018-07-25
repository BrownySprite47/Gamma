<?php

function index(){
    if (isset($_SESSION['id'])){
        $data['title'] = 'Админ - Создание лидера';
        $data['css'][] = 'css/leaders/add/style.css';
        $data['js'][] = 'js/leaders/add/script.js';
        renderView('leaders/add/index/index/index', $data);
    }else{
        header('Location: /');
        exit();
    }
}
