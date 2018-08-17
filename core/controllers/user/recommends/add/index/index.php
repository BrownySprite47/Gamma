<?php
/**
 * Page /user/recommends/add
 */
function index()
{
    if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user')) {
        /**
         * Activation menu link
         */
        $data['recomendations'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Добавление рекомендации';


        $data['css'][] = 'user/css/recommends/add/style.css';
        $data['css'][] = 'user/css/recommends/add/media.css';

        $data['js'][] = 'user/js/recommends/add/script.js';

        renderView('user/recommends/add/index/index', $data);

    } else {
        header('Location: /');
    }
}
