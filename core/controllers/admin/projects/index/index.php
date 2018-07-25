<?php

function index(){
    if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
        $data['projects_link_admin'] = '';

        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/js/projects/script.js';

        if (empty($_POST) || $_POST['condition'] == 'all') {
            $checked = ' checked !=2 ';
        }else{
            $checked = ' checked = '.checkChars($_POST['condition'])." ";
        }
        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? checkChars($_POST['count_on_page']): '10';
        $data['all_projects'] = getProjectsAdmin($checked, '', '');

        $data['countpages'] = intval((db_count('projects', '', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

        if ($data['numpage'] < 1)                    $data['numpage'] = 1;
        if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
        $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);

        if (!empty($_POST)) {

            if ($_POST['type'] == 'project') {
                $checked = ' id_proj='.checkChars($_POST['project']).' ';
                $_POST['condition'] = 'all';
                $_POST['status'] = 'all';
            }

            if ($_POST['type'] == 'status') {
                $checked = ' status = '.checkChars($_POST['status']).' ';
                $_POST['condition'] = 'all';
                $_POST['project'] = 'all';
            }

            if ($_POST['type'] == 'condition') {
                $checked = ' checked = '.checkChars($_POST['condition'])." ";
                $_POST['status'] = 'all';
                $_POST['project'] = 'all';
            }

            $data['projects'] = getProjectsAdmin($checked, '', $limit);


            if($_POST['project'] != 'all'){
                $data['countpages'] = 1;
            }else{
                $data['countpages'] = intval((db_count('projects', " WHERE ".$checked) - 1) / $settings['count_on_page']) + 1;
            }

            renderView('admin/projects/index/layouts/index', $data);
        }else{
            $data['projects'] = getProjectsAdmin($checked, '', $limit);
            renderView('admin/projects/index/index/index', $data);
        }
    }else{
        header('Location: /');
    }
}

