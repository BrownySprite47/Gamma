<?php
/**
 * Page /ajax/index/status/change/leaders
 */
function index()
{
    if (isset($_POST['id_lid']) && $_POST['id_lid'] != '') {
        dbQuery("UPDATE leaders SET checked = '".main_checkChars($_POST['checked'])."' WHERE id_lid = '".main_checkChars($_POST['id_lid'])."'");
        dbQuery("UPDATE leader_project SET checked = '".main_checkChars($_POST['checked'])."' WHERE id_lid = '".main_checkChars($_POST['id_lid'])."'");

        exit('leader_update_success');
    }
}
