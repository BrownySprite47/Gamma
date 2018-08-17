<?php
/**
 * Page /ajax/admin/doubles/status
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['id'])) {
            changeStatusDoubles($_POST);
        }
    }else{
        header('Location: /');
    }
}
