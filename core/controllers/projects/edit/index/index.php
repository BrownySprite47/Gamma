<?php

function index(){
    if (isset($_GET['id']) && is_numeric($_GET['id']) && getUserProjectsAccess($_GET['id'])){
        $data['project'] = getProject($_GET['id']);
        $data['localizations'] = getLocalizations();
        $data['leaders'] = getOneProjectLeaders($_GET['id']);
        $data['leaders_fio'] = getLeadersFioFromProject();
        $data['files'] = getProjectFiles($_GET['id']);
        $data['links'] = getProjectLinks($_GET['id']);
        $data['title'] = 'Редактирование проекта';
        $data['css'][] = 'css/projects/edit/style.css';
        $data['js'][] = 'js/projects/edit/script.js';
        renderView('projects/edit/index/index/index', $data);
    }else{
        header('Location: /');
        exit();
    }
}
