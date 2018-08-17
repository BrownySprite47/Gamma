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
        $data['recommend'] = leader_getRecommends();

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
        $data['css'][] = 'user/css/recommends/index/style.css';
        $data['css'][] = 'user/css/recommends/index/media.css';

        $data['js'][] = 'user/js/recommends/index/script.js';

        /**
         * Require view
         */
        renderView('user/recommends/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
