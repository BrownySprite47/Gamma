<?php
/**
 * Page /ajax/index/status/change/projects
 */
function index()
{
    if (isset($_POST['id_proj']) && $_POST['id_proj'] != '') {
        dbQuery("UPDATE projects SET checked = '".main_checkChars($_POST['checked'])."' WHERE id_proj = '".main_checkChars($_POST['id_proj'])."'");
        dbQuery("UPDATE leader_project SET checked = '".main_checkChars($_POST['checked'])."' WHERE id_proj = '".main_checkChars($_POST['id_proj'])."'");
        exit('project_update_success');
    }
}
