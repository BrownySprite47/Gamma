<?php
/**
 * Page /admin/doubles
 */
function index()
{
    require CORE_DIR . '/core/library/validateProject.php';

    /**
     * Creating a new project
     */
    $last_id = addProject($_POST);

    /**
     * Creating a link between the project and the leaders of this project
     */

    if(isset($_POST['leader'])){
        addLeadersToProject($_POST, $last_id);
    }

    /**
     * Adding user to the project
     */
    addUserToProject($last_id);


    // появился новый проект EVENT 11
    if ($_SESSION['status'] == 2 or $_SESSION['status'] == 3) {
        main_log($_SESSION['id_lid'], '14', '', '', $last_id);
    }

    /**
     * Adding files to the project
     */

    if(isset($_POST['file'])){
        addFilesToProject($_POST, $last_id);
    }

    /**
     * Adding links to the project
     */

    if(isset($_POST['link'])){
        addLinksToProject($_POST, $last_id);
    }

    status_setUser($_SESSION['id_lid']);

    exit('success_user');
}
