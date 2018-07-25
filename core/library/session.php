<?php
//if (isset($_SESSION)) {
//    if(!empty($_SESSION['id'])) {
//        if ($_SESSION['role'] == 'user'){
//            $admin = false;
//        }else{
//            $admin = true;
//        }
//        $session = true;
//    }else{
//        $session = false;
//    }
//}else{
//    $session = false;
//
//}

//проверка $_GET
//function check_correct_leader($user_id, $id_lid, $recom){
//    $sql = "SELECT id_lid FROM leaders WHERE id_lid='{$id_lid}'";
//    $leader = getData(dbQuery($sql));
//    if (empty($leader[0])){
//        return false;
//    }
//    if($recom){
//        $sql = "SELECT id_lid FROM leaders WHERE user_id='{$user_id}' AND id_lid='{$id_lid}'";
//        $leader = getData(dbQuery($sql));
//        if (!empty($leader[0])){
//            header("Location: /user/");
//        }else{
//            return false;
//        }
//    }
//
//}

//проверка $_GET
//function check_correct_project($user_id, $id_proj){
//    $sql = "SELECT id_lid FROM leaders WHERE user_id='{$user_id}'";
//    $leader = getData(dbQuery($sql));
//
//    $sql = "SELECT id_proj FROM leader_project WHERE id_proj='{$id_proj}'";
//    $project = getData(dbQuery($sql));
//    if (empty($project[0])){
//        return false;
//    }
//    $sql = "SELECT id_proj FROM leader_project WHERE id_lid='{$leader[0]["id_lid"]}' AND id_proj='{$id_proj}'";
//    $project = getData(dbQuery($sql));
//    if (!empty($project[0])){
//        return true;
//    }else{
//        return false;
//    }
//}
