<?php
/**
 * Page /user/recommends/edit
 */
function index()
{
    if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user')) {

        if(isset($_GET['id']) && is_numeric($_GET['id']) && main_getRecommendAccess($_GET['id'])) {
            $data = recommends_get($_GET['id']);

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
            $data['css'][] = 'user/css/recommends/edit/style.css';
            $data['css'][] = 'user/css/recommends/edit/media.css';

            $data['js'][] = 'user/js/recommends/edit/script.js';

            /**
             * Require view
             */
            renderView('user/recommends/edit/index/index', $data);
        } else {
            header('Location: /');
        }
    } else {
        header('Location: /');
    }
}
