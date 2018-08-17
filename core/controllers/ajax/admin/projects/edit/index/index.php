<?php
/**
 * Page /ajax/admin/projects/edit
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require CORE_DIR . '/core/library/validateProject.php';

        /**
         * get the data about the project change.
         */

        $isChangedProject = isChangedProject($_POST, getDataProjectBeforeChange($_POST['id_proj']));

        /**
         * if the project has been changed, then we update it
         */
        if ($isChangedProject) {
            updateProject($_POST);
            // обновилась информация о пользователе  EVENT 11
            if ($_SESSION['status'] == 2 or $_SESSION['status'] == 3) {
                main_log($_SESSION['id_lid'], '6', '', '', main_checkChars($_POST['id_proj']));
            }
        }

        /**
         *  update project files
         */
        updateProjectFiles($_POST, getDataProjectFilesBeforeChange($_POST['id_proj']));

        /**
         * update project links
         */
        updateProjectLinks($_POST, getDataProjectLinksBeforeChange($_POST['id_proj']));

        /**
         * update project leaders
         */
        updateLeadersProject($_POST);

        /**
         * add user to project
         */
        addUserToProject($_POST['id_proj']);

    }else{
        header('Location: /');
    }
}
