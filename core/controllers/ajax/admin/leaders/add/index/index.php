<?php
/**
 * Page /ajax/admin/leaders/add
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require CORE_DIR . '/core/library/validateLeader.php';

        $lastId = leaders_add($_POST);

        leaders_addFiles($_POST, $lastId);
        leaders_addFLinks($_POST, $lastId);



        status_setAdmin($lastId);
        exit('success');

    }else{
        header('Location: /');
    }
}
