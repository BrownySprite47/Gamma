<?php
/**
 * Page /admin/recommends/edit
 */
function index()
{
    if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin')) {

        if(isset($_GET['id']) && is_numeric($_GET['id'])) {

            $data = recommends_get($_GET['id']);

            $data['recommend_link_admin'] = '';

            /**
             * Page title
             */
            $data['title'] = 'Редактирование рекомендации';

            /**
             * Require css and js files for page
             */
            $data['css'][] = 'admin/css/recommends/edit/style.css';
            $data['css'][] = 'admin/css/recommends/edit/media.css';

            $data['js'][] = 'admin/js/recommends/edit/script.js';

            /**
             * Require view
             */
            renderView('admin/recommends/edit/index/index', $data);
        }else {
            header('Location: /admin/recommends/add');
        }
    } else {
        header('Location: /');
    }
}
