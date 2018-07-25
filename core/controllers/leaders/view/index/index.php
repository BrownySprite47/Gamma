<?php

function index() {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        if(isset($_SESSION['id_lid'])) {
            $data['user'] = getOneLeader($_SESSION['id_lid']);
        }
        $data['leader'] = getOneLeader($_GET['id']);
        $data['projects'] = getProjectsFromLeader($_GET['id'], 'id_lid');
        $data['tags'] = getUserDataTags($_GET['id']);
        $data['files'] = getUserFiles($_GET['id']);
        $data['links'] = getUserLinks($_GET['id']);
        $data['leaders_link'] = 'active_menu';
        $data['title'] = 'Карточка лидера';
        $data['css'][] = 'css/leaders/view/style.css';
        $data['js'][] = 'js/leaders/view/script.js';
    }else{
        header('Location: /');
        exit();
    }
    if(isset($_SESSION['id_lid'])) {
        $data['six_friends_small'] = getSixFriendsSmall($_SESSION['id_lid'], $_GET['id']);
    }
    renderView('leaders/view/index/index/index', $data);
}