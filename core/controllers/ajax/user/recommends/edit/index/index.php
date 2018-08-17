<?php
/**
 * Page /admin/doubles
 */
function index()
{
    require CORE_DIR . '/core/library/validateRecommends.php';

    if (empty($_POST['familya']) || empty($_POST['name']) || empty($_POST['city']) || empty($_POST['project']) || empty($_POST['social']) || empty($_POST['reason'])) {
        exit("empty");
    }
    recommends_update($_POST);

    status_setAdmin(main_checkChars($_POST['id_lid']));
    status_setAdmin(main_checkChars($_SESSION['id_lid']));
    status_setUser($_SESSION['id_lid']);

    exit('success_user');
}
