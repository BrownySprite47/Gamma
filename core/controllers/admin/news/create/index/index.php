<?php

function index(){
	if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
        $data = [];
        $data['news_link_admin'] = '';

        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/news/add/script.js';

        renderView('admin/news/create/index/index', $data);
    }else{
        header('Location: /');
    }
}