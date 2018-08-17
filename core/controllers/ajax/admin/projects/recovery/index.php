<?php
/**
 * Page /ajax/admin/projects/recovery
 */
function index()
{
    if($_SESSION['role'] == 'admin' && $_SERVER['REQUEST_METHOD'] == 'POST'){
        recoveryProject($_POST);
    }else{
        header('Location: /');
    }
}
