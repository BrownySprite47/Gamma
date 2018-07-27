<?php

function index()
{
    if (isset($_GET['fio_lid'])) {
        $myrow = mysqli_fetch_array(dbQuery("SELECT id_lid FROM leaders WHERE fio = '".checkChars($_GET['fio_lid'])."'"));
        if (!empty($myrow['id_lid'])) {
            exit("leader_exists");
        }
    }
}
