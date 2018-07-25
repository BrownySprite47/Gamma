<?php

function index(){
    if (isset($_SESSION['id'])){
        $data['localizations'] = getLocalizations();
        $data['type'] = 'projects';
        $data['leaders'] = getLeadersFioFromProject();
        $data['title'] = 'Создание проекта';
        $data['css'][] = 'css/projects/add/style.css';
        $data['js'][] = 'js/projects/add/script.js';
        renderView('projects/add/index/index/index', $data);
    }else{
        header('Location: /user');
        exit();
    }
}
