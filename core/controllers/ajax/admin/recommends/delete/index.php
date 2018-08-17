<?php
/**
 * Page /ajax/admin/recommends/delete
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['leader'])) {
            $leader = main_checkChars($_POST['leader']);
            dbQuery("UPDATE recommend_leaders SET actual = '2' WHERE id_lid = '".$leader."' AND user_id = '".$_SESSION['id_lid']."'");

            status_setAdmin($leader);
            status_setUser($_SESSION['id_lid']);
        }
        exit('success');
    }else{
        header('Location: /');
    }
}
