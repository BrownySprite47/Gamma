<?php

/**
 * Добавление нового тега пользователем
 */
function index()
{
    if (!empty($_POST['name_tag'])) {
        dbQuery("INSERT INTO tags SET name = '".checkChars($_POST['name_tag'])."', who_is_add = '".$_SESSION['id_lid']."'");

        setStatusAndAccessUserOnline($_SESSION['id_lid']);
        exit('success');
    }
}
