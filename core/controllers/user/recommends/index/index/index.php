<?php
/**
 * Page /user/recommends
 */
function index()
{
    if ($_SESSION['role'] == 'user') {

        /**
         * get data about user recommends
         */
        $data['recommend'] = getRecommendLeader();

        /**
         * Activation admin menu link
         */
        $data['recomendations'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Рекомендации';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'css/user/recommends/style.css';
        $data['js'][] = 'js/user/recommends/script.js';

        /**
         * Require view
         */
        renderView('user/recommends/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
