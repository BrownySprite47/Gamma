<?php
/**
 * Page /ajax/admin/projects/delete
 */
function index()
{
    if($_SESSION['role'] == 'admin' && $_SERVER['REQUEST_METHOD'] == 'POST'){
        deleteProject($_POST);
    }else{
        header('Location: /');
    }
}
