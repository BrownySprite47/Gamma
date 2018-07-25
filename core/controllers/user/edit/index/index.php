<?php

function index() {
    if ($_SESSION['role'] == 'user'){
        $data['user'] = getData(getUserData($_SESSION['id_lid']));
        $data['project_files'] = getUserFiles($_SESSION['id_lid']);
        $data['leaders_link'] = getUserLinks($_SESSION['id_lid']);
        $data['projects'] = getOneLeaderProjects($_SESSION['id_lid']);
        $data['user_logo'] = '';
        $data['title'] = 'Редактирование пользователя';
        $data['css'][] = 'css/user/edit/style.css';
        $data['js'][] = 'js/user/edit/script.js';
        renderView('user/edit/index/index/index', $data);
    }
    else{
        header('Location: /');
    }
}