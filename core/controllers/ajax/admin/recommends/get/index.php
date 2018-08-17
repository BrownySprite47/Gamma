<?php
/**
 * Page /ajax/admin/recommends/get
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //recommends_changeStatus($_POST);

        status_setAdmin($_POST['data_doubles']);
        status_setUser($_SESSION['id_lid']);
    }else{
        header('Location: /');
    }
}
