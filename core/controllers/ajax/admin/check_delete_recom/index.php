<?php

//function index(){
//    $user = checkChars($_POST['user']);
//    $leader = checkChars($_POST['leader']);
//
//    if (isset($user) && isset($leader) && !empty($user) && !empty($leader)) {
//        dbQuery ("DELETE FROM recommend_leaders WHERE user_id = '".$user."' AND id_lid = '".$leader."'");
//        setStatusAndAccessAdminOnline($user);
//        setStatusAndAccessAdminOnline($leader);
//        setStatusAndAccessUserOnline($_SESSION['id_lid']);
//        exit('leader_recom_success');
//    }
//}
