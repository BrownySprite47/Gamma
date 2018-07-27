<?php
/**
 * Page /admin/statistics/detail
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
        $data['title'] = 'Админ - Детальная статисика';

        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'admin/ajax_admin.js';

        $data = [];
        if (isset($_GET['type'])) {
            $data = getDetailStatistics(
                checkChars($_GET['start']),
                checkChars($_GET['end']),
                checkChars($_GET['type'])
            );
        }

        /**
         * Require view
         */
        renderView('admin/statistics/detail_statistics', $data);
    } else {
        header('Location: /');
    }
}
