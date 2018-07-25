<?php

//function index() {
//    require CORE_DIR . '/core/library/leaderSqlStr.php';
//    $leader = checkChars($_POST['id_lid']);
//    $actual = checkChars($_POST['actual']);
//    $before = getData(dbQuery("SELECT actual FROM recommend_leaders WHERE id_lid = '".$leader."' AND user_id = '".$_SESSION['id_lid']."'"));
//    dbQuery("UPDATE recommend_leaders SET actual = '".$actual."' WHERE id_lid = '".$leader."' AND user_id = '".$_SESSION['id_lid']."'");
//
//    setStatusAndAccessAdminOnline($leader);
//    setStatusAndAccessUserOnline($_SESSION['id_lid']);
//
//
//    $id_lid = getData(dbQuery("SELECT status FROM leaders WHERE id_lid = '".checkChars($leader)."'"));
//
//    if($id_lid[0]['status'] == 2 || $id_lid[0]['status'] == 3 && $before[0]['actual'] != 1){
//        //сделал рекомендацию EVENT 4
//        userLogs($_SESSION['id_lid'], '4', '', '', '', $leader);
//    }
//
//    exit('success_user');
//}
