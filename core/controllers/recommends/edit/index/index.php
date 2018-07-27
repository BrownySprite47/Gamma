<?php
/**
 * Page /recommends/edit
 */
function index()
{
    if ($_SESSION['role'] == 'user' && is_numeric($_GET['id']) && getUserRecommendsAccess($_GET['id'])) {
        $data = getOneLeaderRecom($_GET['id']);

        if ($_SESSION['role'] == 'user') {
            /**
             * Activation user menu link
             */
            $data['recomendations'] = '';
        } else {
            /**
             * Activation admin menu link
             */
            $data['recommend_link_admin'] = '';
        }

        /**
         * Page title
         */
        $data['title'] = 'Редактирование рекомендации';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'css/recommends/edit/style.css';
        $data['js'][] = 'js/recommends/edit/script.js';

        /**
         * Require view
         */
        renderView('/recommends/edit/index/index', $data);
    } else {
        header('Location: /');
    }
}
