<?php

function index() {
    if(is_int((int)$_GET['id'])){
        $data['news'] = getNewsFromDb(1, $_GET['id'], true);
        $data['next_news'] = getNewsFromDb(1, $_GET['id'] - 1, true);

        $data['news_link'] = 'active_menu';
        $data['title'] = 'Новость';
        $data['css'][] = 'css/news/view/style.css';
        $data['js'][] = 'js/news/view/script.js';

        renderView('news/view/index/index/index', $data);
    }else{
        header('Location: /');
    }
}
