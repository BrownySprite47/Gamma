<?php
/**
 * Page /ajax/admin/statistics
 * @throws Exception
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $start = new DateTime(main_checkChars($_POST['start']));
        // Дата окончания интервала
        $end = new DateTime(main_checkChars($_POST['end']));

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
                $data['statistics'][] = admin_getGeneralStatistics($value['start'][0], $value['end'][0]);
            }
        }else{
            $data['statistics'][] = admin_getGeneralStatistics();
        }
        //view($period);
        renderView('/admin/statistics/index/layouts/index', $data);
    }else{
        header('Location: /');
    }
}
