<?php
/**
 * Page /ajax/admin/leaders/delete
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_SESSION['role'] == 'admin'){
           leaders_delete($_POST);
        }

    }else{
        header('Location: /');
    }
}
