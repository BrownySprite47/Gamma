<?php

function index() {
    if(isset($_GET['id']) && is_int((int)$_GET['id'])){
        $data['news'] = getNewsFromDb(1, true);
        $data['news_link'] = 'active_menu';
        $data['title'] = 'Новость';
        $data['comments'] = getComments($_GET['id']);

        $data['css'][] = 'css/news/view/style.css';
        $data['css'][] = 'libs/kemoji/lib/prettify.css';
        $data['css'][] = 'libs/kemoji/css/emoji.css';
        $data['css'][] = 'libs/kemoji/css/smiles.css';
        $data['css'][] = 'libs/kemoji/css/style.css';

        $data['js'][] = 'libs/kemoji/lib/prettify.js';
        $data['js'][] = 'libs/kemoji/kemoji.min.js';
        $data['js'][] = 'js/news/view/script.js';

        renderView('news/view/index/index/index', $data);
    }else{
        header('Location: /');
    }
}
