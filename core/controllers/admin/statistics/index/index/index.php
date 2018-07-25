<?php

function index(){
    if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
        $data['statistics_link_admin'] = '';

        $data['css'][] = 'admin/css/common/style.css';
        $data['js'][] = 'js/bootstrap/bootstrap-datetimepicker.min.js';
        $data['js'][] = 'admin/js/statistics/index/script.js';

        $settings['count_on_page'] = (isset($_POST['count_on_page'])) ? checkChars($_POST['count_on_page']): '10';
        $data['tags'] = getTagsData('', '', '');
        $data['all_tags'] = $data['tags'];
        $data['countpages'] = intval((count($data['tags']) - 1) / $settings['count_on_page']) + 1;
        $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));
        if ($data['numpage'] < 1)                    $data['numpage'] = 1;
        if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];
        $data['startproject'] = $data['numpage'] * $settings['count_on_page'] - $settings['count_on_page'];
        $limit = getLimitForPageNavigation($data['startproject'], $settings['count_on_page']);
        $data['tags'] = getTagsData('', '', $limit);
        $data['all_tags'] = $data['tags'];

//        view($_POST);
        if (!empty($_POST)) {
            $period_result = [];
            $res = [];
            $start = new DateTime(checkChars($_POST['start']));
            // Дата окончания интервала
            $end = new DateTime(checkChars($_POST['end']));

            // $date = new DateTime('21.11.2015');
            $end->add(new DateInterval('P1D'));
            if ($_POST['period'] == 'day') {
                $step = new DateInterval('P1D');
            }else if ($_POST['period'] == 'week') {
                $step = new DateInterval('P1W');
            }else if ($_POST['period'] == 'month') {
                $step = new DateInterval('P1M');
            }else {
                $step = new DateInterval('P1D');
            }
            $period = new DatePeriod($start, $step, $end);

            foreach($period as $key => $datetime) {
                $period_result[$key][] = $datetime->format("Y-m-d");
            }
            //view($period_result);
            if ($_POST['period'] == 'day') {
                foreach ($period_result as $per => $value) {
                    $res[$per]['start'] = $period_result[$per];
                    $res[$per]['end'] = $period_result[$per];
                }
            }else{
                foreach ($period_result as $per => $value) {
                    $res[$per]['start'] = $period_result[$per];
                    $res[$per]['end'] = $period_result[$per+1];
                }
                array_pop($res);
            }

            if($_POST['period'] != 'all'){
                foreach ($res as $value) {
                    $data['statistics'][] = adminGetGeneralStatistics($value['start'][0], $value['end'][0]);
                }
            }else{
                $data['statistics'][] = adminGetGeneralStatistics();
            }
            //view($period);
            renderView('admin/statistics/index/layouts/index', $data);
        }else{
            $data['statistics'][] = adminGetGeneralStatistics();
            renderView('admin/statistics/index/index/index', $data);
        }
    }else{
        header('Location: /');
    } 
}