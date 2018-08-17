<?php
/**
 * Page /admin/doubles
 */
function index()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
        require CORE_DIR . '/core/library/validateLeader.php';

        if (empty($_POST['familya']) || empty($_POST['name']) || empty($_POST['city']) || empty($_POST['social']) || empty($_POST['birthday'])) {
            exit("empty");
        }

        //тут должна быть функция валридации

        $user_isChanged = user_isChanged($_POST, user_getUserBeforeChange());

        if ($user_isChanged) {
            user_update($_POST);
            // обновилась информация о пользователе  EVENT 11
            if ($_SESSION['status'] == 2 or $_SESSION['status'] == 3) {
                main_log($_SESSION['id_lid'], '15');
            }
        }

        user_updateFiles($_POST, user_getFilesBeforeChange());
        user_updateLinks($_POST, user_getLinksBeforeChange());

        status_setUser($_SESSION['id_lid']);

        exit('success_user');
    }
}
