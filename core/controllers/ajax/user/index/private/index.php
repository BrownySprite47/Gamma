<?php
/**
 * Page /admin/doubles
 */
function index()
{
    if (isset($_POST['check']) && ($_POST['check'] == 0 || $_POST['check'] == 1 || $_POST['check'] == 2)) {

        user_changeVisibility($_POST);

        status_setUser($_SESSION['id_lid']);
        exit('success');
    } else {
        exit('error');
    }
}
