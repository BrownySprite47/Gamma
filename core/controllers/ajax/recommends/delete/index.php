<?php

function index()
{
    if (isset($_POST['leader'])) {
        $leader = checkChars($_POST['leader']);
        dbQuery("UPDATE recommend_leaders SET actual = '0' WHERE id_lid = '".$leader."' AND user_id = '".$_SESSION['id_lid']."'");

        setStatusAndAccessAdminOnline($leader);
        setStatusAndAccessUserOnline($_SESSION['id_lid']);
    }
    exit('success');
}
