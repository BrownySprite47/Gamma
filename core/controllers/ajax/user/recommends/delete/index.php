<?php
/**
 * Page /admin/doubles
 */
function index()
{
    if (isset($_POST['leader'])) {
        recommends_delete($_POST);

        status_setAdmin($_POST['leader']);
        status_setUser($_SESSION['id_lid']);
    }
    exit('success');
}
