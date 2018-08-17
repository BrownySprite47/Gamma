<?php
/**
 * Page /admin/recommends/add
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
        /**
         * Activation admin menu link
         */

        $data['recommend_link_admin'] = '';


        /**
         * Page title
         */
        $data['title'] = 'Добавление рекомендации';

        $data['css'][] = 'admin/css/recommends/add/style.css';
        $data['css'][] = 'admin/css/recommends/add/media.css';

        $data['js'][] = 'admin/js/recommends/add/script.js';

        renderView('admin/recommends/add/index/index', $data);
    } else {
        header('Location: /');
    }
}
