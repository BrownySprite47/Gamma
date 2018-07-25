<?php

function index(){
    if (isset($_POST['id_proj']) && $_POST['id_proj'] != '') {
        dbQuery("UPDATE projects SET checked = '".checkChars($_POST['checked'])."' WHERE id_proj = '".checkChars($_POST['id_proj'])."'");
        dbQuery ("UPDATE leader_project SET checked = '".checkChars($_POST['checked'])."' WHERE id_proj = '".checkChars($_POST['id_proj'])."'");
        exit('project_update_success');
    }

    if (isset($_POST['id_lid']) && $_POST['id_lid'] != '') {
        dbQuery ("UPDATE leaders SET checked = '".checkChars($_POST['checked'])."' WHERE id_lid = '".checkChars($_POST['id_lid'])."'");
        dbQuery ("UPDATE leader_project SET checked = '".checkChars($_POST['checked'])."' WHERE id_lid = '".checkChars($_POST['id_lid'])."'");

        exit('leader_update_success');
    }
    if (isset($_POST['id_news']) && $_POST['id_news'] != '') {
        dbQuery ("UPDATE news SET checked = '".checkChars($_POST['status'])."' WHERE id = '".checkChars($_POST['id_news'])."'");

        exit('news_update_success');
    }
    if (isset($_POST['id_lid_recom']) && $_POST['id_lid_recom'] != '') {
        if (isset($_POST['exist'])) {
            dbQuery ("UPDATE recommend_leaders SET checked = '".checkChars($_POST['checked'])."' WHERE id_lid = '".checkChars($_POST['id_lid_recom'])."' AND user_id = '".checkChars($_POST['user_id'])."'");
        }     
        if ($_POST['direction'] == 'recommend') {
            $recommend = getData(dbQuery("SELECT email, name, familya, token FROM leaders WHERE id_lid = '".checkChars($_POST['id_lid_recom'])."' LIMIT 1"));
           
            $email   = $recommend[0]['email'];
            $name    = $recommend[0]['name'];
            $familya = $recommend[0]['familya'];
            $token   = $recommend[0]['token'];
            
            // удаление адреса из листа
            // $result = mailchimp('del_from_list', array('list_id' => '83320450bb', 'email' => "$email"));

            //добавление в лист нового адреса
            // $data = array(
            //  'list_id' => '83320450bb', // номер листа вытащить в настройки или в БД
            //  'email'   => "$email",
            //  // 'status'  => 'subscribed',
            //  // 'firstname' => "$name",
            //  // 'lastname' => "$familya",
            //  // 'token' => "$token",
            // );
            // $result = mailchimp('del_from_list', $data);
            
            // //добавление в лист нового адреса
            // $data = array(
            //  'list_id' => '83320450bb', // номер листа вытащить в настройки или в БД
            //  'email'   => "$email",
            //  'status'  => 'subscribed',
            //  'firstname' => "$name",
            //  'lastname' => "$familya",
            //  'token' => "$token",
            // );
            // $result = mailchimp('add_to_list', $data);

            // // удаление адреса из листа
            //$result = mailchimp('del_from_list', array('list_id' => '83320450bb', 'email' => '$email'));
        }

//        setStatusAndAccessAdminOnline($_POST['id_lid_recom']);
//        setStatusAndAccessAdminOnline($_POST['id_lid']);
//        setStatusAndAccessUserOnline($_SESSION['id_lid']);


        exit('recom_update_success');
    }
}
