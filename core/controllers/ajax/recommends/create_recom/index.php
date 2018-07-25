<?php

//function index(){
//    $recommend = checkChars($_POST['id_lid']);
//    $reason = checkChars($_POST['reason']);
//    $project_name = checkChars($_POST['project']);
//    $city = checkChars($_POST['city']);
//    $email = checkChars($_POST['email']);
//    $social = checkChars($_POST['social']);
//    $exist_recom = getData(dbQuery("SELECT id FROM recommend_leaders WHERE id_lid = '".$recommend."' AND user_id = '".$_SESSION['id_lid']."'"));
//    if (!isset($exist_recom[0]['id'])) {
//        dbQuery("INSERT INTO recommend_leaders (id_lid, user_id, project_name, city, email, social, reason, exist, actual, full) VALUES ('".$recommend."', '".$_SESSION['id_lid']."', '".$project_name."', '".$city."', '".$email."', '".$social."', '".$reason."', '1', '1', '1')");
//
//    }
//    // $pushLeaderToDb = dbQuery("UPDATE leaders SET status_recom = '1' WHERE id_lid = '".checkChars($id_lid[0]['id_lid'])."'");
//
//    $count_recommend = getData(dbQuery("SELECT COUNT(*) FROM recommend_leaders WHERE id_lid = '".$recommend."'"));
//    if($count_recommend[0]["COUNT(*)"] > 1) {
//        dbQuery("UPDATE leaders SET status_recom = '1' WHERE id_lid = '".$recommend."'");
//
//    }
//
//    setStatusAndAccessAdminOnline($recommend);
//    setStatusAndAccessUserOnline($_SESSION['id_lid']);
//
//
//    $id_lid = getData(dbQuery("SELECT status FROM leaders WHERE id_lid = '".checkChars($recommend)."'"));
//
//    if($id_lid[0]['status'] == 2 || $id_lid[0]['status'] == 3){
//        //сделал рекомендацию EVENT 4
//        userLogs($_SESSION['id_lid'], '4', '', '', '', $recommend);
//    }
//    exit("leader_recom_success");
//}