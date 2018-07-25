<?php

function index(){
    if ($_SESSION['role'] == 'user'){
        $data['tags'] = getTagsNamesUser();
        $data['change_experience'] = '';
        $data['title'] = 'Теги';
        $data['css'][] = 'css/user/tags/style.css';
        $data['js'][] = 'js/user/tags/script.js';
        renderView('user/tags/index/index/index', $data);
    }else{
        header('Location: /');
    }
}