<?php
/**
 * Page /admin/doubles
 */
function index()
{
    require CORE_DIR . '/core/library/validateRecommends.php';

    recommends_create($_POST);

    recommends_changeStatus($_POST);

    status_setAdmin($_POST['id_lid']);
    status_setUser($_SESSION['id_lid']);

    $id_lid = leader_getLeaderStatus($_POST);

    if($id_lid[0]['status'] == 2 || $id_lid[0]['status'] == 3){
        //сделал рекомендацию EVENT 4
        main_log($_SESSION['id_lid'], '4', '', '', '', $_POST['id_lid']);
    }
    exit("leader_recom_success");
}
