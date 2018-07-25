<?php

function index(){
    if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
        $data['tags_link_admin'] = '';
        $data['title'] = 'Админ - Теги';
        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/tags/script.js';

        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' t.checked !=2 ';
        }else{
            $checked = ' t.checked = '.checkChars($_POST['condition'])." ";
        }
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? checkChars($_POST['count_on_page']): '10';
        $data['all_tags'] = getTagsData('', '', '');

        $data['countpages'] = intval((db_count('tags AS t', '', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

        if ($data['numpage'] < 1)                    $data['numpage'] = 1;
        if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
        $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);

        if (!empty($_POST)) {

            if ($_POST['type'] == 'condition') {
                $checked = ' t.checked = '.checkChars($_POST['condition']).' ';
                $_POST['tag'] = 'all';
            }

            if ($_POST['type'] == 'tag') {
                $checked = ' t.id='.checkChars($_POST['tag']).' ';
                $_POST['condition'] = 'all';
            }
         
            $data['tags'] = getTagsData($checked, '', $limit);
            
//            if($_POST['tag'] != 'all'){
//                $data['countpages'] = 1;
//            }else{
                $data['countpages'] = intval((db_count('tags AS t', '', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
//            }
            
            renderView('admin/tags/index/layouts/index', $data);
        }else{
            $data['tags'] = getTagsData($checked, '', $limit);
            renderView('admin/tags/index/index/index', $data);
        }
    }else{
        header('Location: /');
    } 
}