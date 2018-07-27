<?php

function index()
{
    if (isset($_GET['site']) && !empty($_GET['site'])) {
        $myrow = mysqli_fetch_array(dbQuery("SELECT id_proj FROM projects WHERE site = '".checkChars($_GET['site'])."'"));
        if (!empty($myrow['id_proj'])) {
            exit("site_exists");
        }
    }
}
