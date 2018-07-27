<?php

function index()
{
    if (isset($_POST['data_doubles_user']) && $_POST['data_doubles_user'] != '' && isset($_POST['data_doubles_leader']) && $_POST['data_doubles_leader'] != '') {
        $user = getData(dbQuery(
            "SELECT user_id, email, telephone FROM leaders WHERE id_lid = '".checkChars($_POST['data_doubles_user'])."' LIMIT 1"
        ));

        dbQuery("UPDATE leaders SET user_id = '".$user[0]['user_id']."' WHERE id_lid = '".checkChars($_POST['data_doubles_leader'])."'");
        dbQuery("UPDATE leaders SET user_id = '0' WHERE id_lid = '".checkChars($_POST['data_doubles_user'])."'");
        dbQuery("INSERT INTO doubles SET id_lid = '".checkChars($_POST['data_doubles_leader'])."', id_user = '".checkChars($_POST['data_doubles_user'])."', email = '{$user[0]['email']}', telephone = '{$user[0]['telephone']}', checked = '1', admin ='1'");

        setStatusAndAccessAdminOnline(checkChars($_POST['data_doubles_leader']));
        setStatusAndAccessUserOnline($_SESSION['id_lid']);

        //авторизовался новый лидер EVENT 5
        userLogs($_POST['data_doubles_leader'], '5', '', '', '', '');

        exit('leader_double_success');
    } else {
        exit('error');
    }
}
