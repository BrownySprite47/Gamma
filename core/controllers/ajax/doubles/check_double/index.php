<?php

function index()
{
    if ($_POST['check_double_no']) {
        unset($_SESSION['new']);
        echo "no";
    }
    if ($_POST['check_double_num']) {
        $_SESSION['new_num'] = $_POST['check_double_num'];
        echo "num";
    }

    if ($_POST['check_double_email'] == '' || $_POST['check_double_phone'] == '') {
        $_SESSION['new_num'] = $_POST['check_double_num'];
        echo "empty";
    }
    if (isset($_SESSION['new_num']) && isset($_POST['check_double_yes'])) {
        dbQuery("INSERT INTO doubles SET id_lid = '{$_SESSION['new_num']}', id_user = '{$_SESSION['id_lid']}', email = '{$_POST['check_double_email']}', telephone = '{$_POST['check_double_phone']}'");

        setStatusAndAccessAdminOnline($_SESSION['new_num']);
        setStatusAndAccessUserOnline($_SESSION['id_lid']);
        
        unset($_SESSION['new']);
        unset($_SESSION['new_num']);
        echo "yes";
    }
}
