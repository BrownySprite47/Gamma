<?php

function index(){
    $data = [];

    /**
     * Activation admin menu link
     */
    $data['user_logo'] = '';

    /**
     * Page title
     */
    $data['title'] = 'Комментарии ссылки на ресурс';

    renderView('comments/link/index/index/index', $data);
}