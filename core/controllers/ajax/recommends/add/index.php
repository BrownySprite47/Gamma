<?php

function index(){
    $user = checkChars($_POST['data_recommend_user']);
    $leader = checkChars($_POST['data_recommend_leader']);
    $reason = checkChars($_POST['data_reason']);

    if (isset($user) && isset($leader) && $user == $leader) exit('error');

    $id = getData(dbQuery("SELECT id FROM recommend_leaders WHERE id_lid = '".$leader."' AND user_id = '".$user."'"));
    if (isset($id[0]['id'])) exit('double');
    if (isset($user) && isset($leader) && !empty($user) && !empty($leader)) {
        dbQuery ("INSERT INTO recommend_leaders SET id_lid = '".$leader."', user_id = '".$user."', reason = '".$reason."', checked = '1', admin ='1'");
        $count_recommend = getData(dbQuery("SELECT COUNT(*) FROM recommend_leaders WHERE id_lid = '".$leader."'"));

        if($count_recommend[0]["COUNT(*)"] > 1) {
            dbQuery("UPDATE leaders SET status_recom = '1' WHERE id_lid = '".$leader."'");

        }


        setStatusAndAccessAdminOnline($user);
        setStatusAndAccessAdminOnline($leader);

        $id_lid = getData(dbQuery("SELECT status FROM leaders WHERE id_lid = '".checkChars($user)."'"));

        if($id_lid[0]['status'] == 2 || $id_lid[0]['status'] == 3){
            //сделал рекомендацию EVENT 4
            userLogs($user, '4', '', '', '', $leader);
        }
        exit('leader_recom_success');
    }else{
        exit('error');
    }
}