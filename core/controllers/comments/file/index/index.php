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
    $data['title'] = 'Комментарии файла';

    renderView('comments/file/index/index/index', $data);
}