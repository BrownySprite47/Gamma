<?php

function index()
{
    if (!empty($_POST['name_tag']) && !empty($_POST['want_tag']) && !empty($_POST['need_tag'])) {
        dbQuery("INSERT INTO tags SET name = '".checkChars($_POST['name_tag'])."', 
            want = '".checkChars($_POST['want_tag'])."', need = '".checkChars($_POST['need_tag'])."', 
            who_is_add = '".$_SESSION['id_lid']."', checked = '1'"
        );
        exit('success');
    }
    setStatusAndAccessAdminOnline($_SESSION['id_lid']);
    setStatusAndAccessUserOnline($_SESSION['id_lid']);
    exit('error');
}
