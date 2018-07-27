<?php

function index()
{
    if (isset($_POST['id'])) {
        if ($_POST['checked'] == '1') {
            $doubles = getData(dbQuery("SELECT * FROM doubles WHERE id = '".checkChars($_POST['id'])."' LIMIT 1"));
            $user = getData(dbQuery("SELECT user_id FROM leaders WHERE id_lid = '".$doubles[0]['id_user']."' LIMIT 1"));
            dbQuery("UPDATE leaders SET user_id = '".$user[0]['user_id']."' WHERE id_lid = '".$doubles[0]['id_lid']."'");
            dbQuery("UPDATE leaders SET user_id = '0' WHERE id_lid = '".$doubles[0]['id_user']."'");
            dbQuery("UPDATE doubles SET checked = '".checkChars($_POST['checked'])."' WHERE id = '".checkChars($_POST['id'])."'");

            setStatusAndAccessAdminOnline($doubles[0]['id_user']);
            setStatusAndAccessAdminOnline($doubles[0]['id_lid']);
            setStatusAndAccessUserOnline($_SESSION['id_lid']);

            //авторизовался новый лидер EVENT 5
            userLogs($doubles[0]['id_lid'], '5', '', '', '', '');
            exit('leader_double_success');
        }
        if ($_POST['checked'] == '2') {
            $doubles = getData(dbQuery("SELECT * FROM doubles WHERE id = '".checkChars($_POST['id'])."' LIMIT 1"));
            $user = getData(dbQuery("SELECT user_id FROM leaders WHERE id_lid = '".$doubles[0]['id_lid']."' LIMIT 1"));
            dbQuery("UPDATE leaders SET user_id = '".$user[0]['user_id']."' WHERE id_lid = '".$doubles[0]['id_user']."'");
            dbQuery("UPDATE leaders SET user_id = '0' WHERE id_lid = '".$doubles[0]['id_lid']."'");
            dbQuery("UPDATE doubles SET checked = '".checkChars($_POST['checked'])."' WHERE id = '".checkChars($_POST['id'])."'");
            
            setStatusAndAccessAdminOnline($doubles[0]['id_user']);
            setStatusAndAccessAdminOnline($doubles[0]['id_lid']);
            setStatusAndAccessUserOnline($_SESSION['id_lid']);
            exit('leader_double_success');
        }
    }
}
