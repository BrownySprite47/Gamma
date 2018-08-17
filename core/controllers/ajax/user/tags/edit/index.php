<?php
/**
 * Page /admin/doubles
 * Редактирование пользователем набора своих тегов
 */
function index()
{
    if (isset($_POST['tags'])) {
        tags_edit($_POST);

        status_setUser($_SESSION['id_lid']);
        exit('success');
    }
}
