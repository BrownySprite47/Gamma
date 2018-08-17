<?php
/**
 * Page /admin/doubles
 * Добавление нового тега пользователем
 */
function index()
{
    if (!empty($_POST['name_tag'])) {
        tags_add($_POST);

        status_setUser($_SESSION['id_lid']);
        exit('success');
    }
}
