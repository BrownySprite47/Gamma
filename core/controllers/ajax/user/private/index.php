<?php
/**
 * Изменени настроек приватности в личном кабинете пользователя
 */
function index(){
    if (isset($_POST['check']) && ($_POST['check'] == 0 || $_POST['check'] == 1 || $_POST['check'] == 2)) {
        dbQuery("UPDATE leaders SET actual = '".checkChars($_POST['check'])."' WHERE id_lid = '".$_SESSION['id_lid']."'");
        $projects = getData(dbQuery("SELECT id_proj FROM leader_project WHERE id_lid = '".$_SESSION['id_lid']."'"));
        foreach ($projects as $key => $value) {
            dbQuery("UPDATE projects SET actual = '".checkChars($_POST['check'])."' WHERE id_proj = '".$value['id_proj']."'");

            setStatusAndAccessUserOnline($_SESSION['id_lid']);
        }
        exit('success');
    }else{
        exit('error');
    }
}

