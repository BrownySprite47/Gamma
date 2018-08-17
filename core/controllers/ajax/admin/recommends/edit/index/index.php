<?php
/**
 * Page /ajax/admin/recommends/edit
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require CORE_DIR . '/core/library/validateLeader.php';

        $familya   = main_checkChars($_POST['familya']);
        $name      = main_checkChars($_POST['name']);
        $otchestvo = main_checkChars($_POST['otchestvo']);
        $city      = main_checkChars($_POST['city']);
        $project   = main_checkChars($_POST['project']);
        $birthday  = main_checkChars($_POST['birthday']);
        $telephone = main_checkChars($_POST['telephone']);
        $email     = main_checkChars($_POST['email']);
        $social    = main_checkChars($_POST['social']);
        $reason    = main_checkChars($_POST['reason']);
        $id_lid    = main_checkChars($_POST['id_lid']);
        $contact   = main_checkChars($_POST['contact_info']);

        if (empty($familya) || empty($name) || empty($city) || empty($project) || empty($reason)) {
            exit("empty");
        }
        $sql = "UPDATE recommend_leaders SET familya = '{$familya}', name = '{$name}', otchestvo = '{$otchestvo}', project_name = '{$project}', contact_info = '{$contact}', telephone = '{$telephone}', birthday = '{$birthday}', city = '{$city}', email = '{$email}', 
                social = '{$social}', reason = '{$reason}', actual = '1', full = '1' 
                WHERE id_lid = '{$id_lid}' AND user_id = '{$_SESSION['id_lid']}'";

        echo $sql;
        dbQuery($sql);

        status_setAdmin(main_checkChars($_POST['id_lid']));
        status_setAdmin(main_checkChars($_SESSION['id_lid']));
        status_setUser($_SESSION['id_lid']);

        exit('success_user');
    }else{
        header('Location: /');
    }
}
