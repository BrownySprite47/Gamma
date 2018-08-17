<?php
/**
 * Page /admin/statistics
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
        /**
         * Activation admin menu link
         */
        $data['statistics_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Статистика';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/index/style.css';
        $data['js'][] = 'libs/bootstrap/bootstrap-datetimepicker.min.js';
        $data['js'][] = 'admin/js/statistics/index/script.js';

        $data['statistics'][] = admin_getGeneralStatistics();

        /**
         * Require view
         */
        renderView('admin/statistics/index/index/index', $data);
    } else {
        header('Location: /');
    }
}
