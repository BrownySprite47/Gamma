<?php

function index(){
    $data['leaders_link'] = 'active_menu';

    if (isset($_GET['id']) && is_numeric($_GET['id'])){
        $data['project'] = getProject($_GET['id']);
        $data['localizations'] = getLocalizations();
        $data['leaders'] = getOneProjectLeaders($_GET['id']);
        $data['files'] = getProjectFiles($_GET['id']);
        $data['links'] = getProjectLinks($_GET['id']);
        $data['css'][] = 'css/projects/view/style.css';
        $data['js'][] = 'js/projects/view/script.js';
        if (isset($_GET['id'])) $data['getUserData'] = getData(getUserDataAdmin($_GET['id']));
    }else{
        header('Location: /');
        exit();
    }
    renderView('projects/view/index/index/index', $data);
}
