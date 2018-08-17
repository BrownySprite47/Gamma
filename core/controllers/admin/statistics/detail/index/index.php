<?php
/**
 * Page /admin/statistics/detail
 */
function index()
{
    if (isset($_SESSION) && $_SESSION['role'] == 'admin') {
//        $data['js'][] = 'admin/ajax_admin.js';

        if (isset($_GET['type'])) {
            $data = admin_getDetailStatistics(
                main_checkChars($_GET['start']),
                main_checkChars($_GET['end']),
                main_checkChars($_GET['type'])
            );
        }
        /**
         * Activation admin menu link
         */
        $data['statistics_link_admin'] = '';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Детальная статисика';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/index/style.css';

        /**
         * Require view
         */
        renderView('admin/statistics/detail/index/index', $data);
    } else {
        header('Location: /');
    }
}
