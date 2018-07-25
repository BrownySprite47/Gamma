<?php

function index() {
    if ($_SESSION['role'] == 'admin' && is_numeric($_GET['id'])){
        $data['user_logo'] = '';
        $data['title'] = 'Админ - Редактирование лидера';
        $data['user'] = getData(getUserData($_GET['id']));
        $data['project_files'] = getUserFiles($_GET['id']);
        $data['leaders_link'] = getUserLinks($_GET['id']);
        $data['projects'] = getOneLeaderProjects($_GET['id']);
        $data['css'][] = 'css/leaders/edit/style.css';
        $data['js'][] = 'js/leaders/edit/script.js';
        renderView('leaders/edit/index/index/index', $data);
    } else{
        header('Location: /');
    }
}