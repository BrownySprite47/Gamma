<?php

function index(){
    if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
        $data = [];
        $data['news_link_admin'] = '';

        $data['news'] = getNewsFromDb(1, $_GET['id'], false);

        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/news/edit/script.js';

        renderView('admin/news/edit/index/index', $data);
    }else{
        header('Location: /');
    }
}