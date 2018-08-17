<?php
/**
 * Page /ajax/admin/leaders/recovery
 */
function index()
{
    if($_SESSION['role'] == 'admin' && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_lid = main_checkChars($_POST['id_lid']);
        $id = dbQuery("UPDATE leaders SET checked = 1 WHERE id_lid = ".$id_lid);
        exit('success');
    }else{
        header('Location: /');
    }
}
