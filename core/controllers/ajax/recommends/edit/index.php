<?php

function index()
{
    require CORE_DIR . '/core/library/leaderSqlStr.php';

    $familya = checkChars($_POST['familya']);
    $name    = checkChars($_POST['name']);
    $city    = checkChars($_POST['city']);
    $project = checkChars($_POST['project']);
    $email   = checkChars($_POST['email']);
    $social  = checkChars($_POST['social']);
    $reason  = checkChars($_POST['reason']);
    $id_lid  = checkChars($_POST['id_lid']);

    if (empty($familya) || empty($name) || empty($city) || empty($project) || empty($reason)) {
        exit("empty");
    }

    dbQuery("UPDATE recommend_leaders SET project_name = '{$project}', city = '{$city}', email = '{$email}', 
            social = '{$social}', reason = '{$reason}', actual = '1', full = '1' 
            WHERE id_lid = '{$id_lid}' AND user_id = '{$_SESSION['id_lid']}'");

    setStatusAndAccessAdminOnline(checkChars($_POST['id_lid']));
    setStatusAndAccessAdminOnline(checkChars($id_lid[0]['id_lid']));
    setStatusAndAccessUserOnline($_SESSION['id_lid']);

    exit('success_user');
}
