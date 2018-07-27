<?php
/**
 * Page /recommends/add
 */
function index()
{
    /**
     * Activation admin menu link
     */
    if($_SESSION['role'] == 'user'){
        $data['recomendations'] = '';
    }else{
        $data['recommend_link_admin'] = '';
    }

    /**
     * Page title
     */
    $data['title'] = 'Добавление рекомендации';

//    if ($_SESSION['role'] == 'user' && is_numeric($_GET['id']) && getUserRecommendsAccess($_GET['id'])){
//        $data = getOneLeaderRecom($_GET['id']);
//        $data['css'][] = 'css/recommends/edit/style.css';
//        $data['js'][] = 'js/recommends/edit/script.js';
//        renderView('/recommends/edit/index/index', $data);
//    }
//    else{
//        header('Location: /');
//    }
}
