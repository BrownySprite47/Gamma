<?php

function index() {
    $data['projects_link'] = 'active_menu';

    if(!empty($_POST)){
        $_SESSION['save_data_projects_redirect'] = $_POST;
    }else{
        if(isset($_SESSION['save_data_projects_redirect'])){
            $_POST = $_SESSION['save_data_projects_redirect'];
            $_POST['redir_url'] = true;
        }
    }

    $data['filters'] = getFilters();
    $data['localizations'] = getLocalizations();
    $data['dynamicFilter'] = getDynamicFilter($data['filters'], $data['localizations']);
    $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? $_POST['count_on_page'] : '10';
    
    if (empty($_POST)) {
        $data['countpages'] = intval((db_count('projects') - 1) / $settings['count_on_page']) + 1;
    }else{
        $where = getWhereForFilter($_POST);
        $data['countpages'] = intval((db_count('projects', $where) - 1) / $settings['count_on_page']) + 1;
    }

    $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

    if ($data['numpage'] < 1)                    $data['numpage'] = 1;
    if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

    $startproject = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
    $limit = getLimitForPageNavigation($startproject, $settings['count_on_page']);
 
    if (!empty($_POST)) {
        $where = getWhereForFilter($_POST);
        $data['projects'] = getProjects($where, $limit);
        $data['all_projects'] = getProjects($where, '');
    }else{
        $data['projects'] = getProjects('', $limit);
    }
    $data['css'][] = 'css/projects/index/style.css';
    $data['js'][] = 'js/projects/index/script.js';

    if (empty($_POST) && empty($_SESSION['save_data_projects_redirect'])) {
        renderView('projects/index/index/index/index', $data);
    }elseif (!empty($_POST) && !empty($_SESSION['save_data_projects_redirect']) && !isset($_POST['redir_url'])) {
        renderView('projects/index/index/layouts/index', $data);
    }elseif (!empty($_POST) && !empty($_SESSION['save_data_projects_redirect']) && isset($_POST['redir_url'])) {
        renderView('projects/index/index/index/index', $data);
    }elseif (empty($_POST) && !empty($_SESSION['save_data_projects_redirect'])) {
        renderView('projects/index/index/index/index', $data);
    }
}
