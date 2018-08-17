<?php
/**
 * Page /ajax/admin/leaders/edit
 */
function index()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin' && !empty($_POST['id_lid'])) {

        require CORE_DIR . '/core/library/validateLeader.php';

        if (empty($_POST['familya']) || empty($_POST['name']) || empty($_POST['city']) || empty($_POST['social']) || empty($_POST['birthday'])) {
            exit("empty");
        }

        //тут должна быть функция валридации

        $user_isChanged = leaders_isChanged($_POST, leaders_getDataBeforeChange($_POST['id_lid']));

        if ($user_isChanged) {
            leaders_update($_POST);
            main_log($_POST['id_lid'], '15');
        }

        leaders_updateFiles($_POST, leaders_getDataFilesBeforeChange($_POST['id_lid']));
        leaders_updateLinks($_POST, leaders_getDataLinksBeforeChange($_POST['id_lid']));

        status_setAdmin($_POST['id_lid']);

        exit('success_user');
    }
}
