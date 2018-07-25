<?php

function index(){
    $data['user_logo'] = '';
    if (isset($_SESSION['id']) && $_SESSION['role'] == 'user'){      
        $data['tags'] = getTagsNamesUser();
        $data['check_double'] = getCheckDouble();
        $data['projects'] = getProjectsFromUser($_SESSION['id_lid']);
        $data['files'] = getUserFiles($_SESSION['id_lid']);
        $data['links'] = getUserLinks($_SESSION['id_lid']);
        $data['recom'] = getUserRecommendsCount($_SESSION['id_lid']);
        $data['user'] = getData(getUserData($_SESSION['id_lid']));
        $data['social'] = getData(getUser($_SESSION['id']));
        $data['css'][] = 'css/user/index/style.css';
        $data['js'][] = 'js/user/index/script.js';
        renderView('user/index/index/index/index', $data);
    }else{
        header('Location: /');
    }
}