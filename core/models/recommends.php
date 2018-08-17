<?php

function recommends_create($post){
    $checked = $_SESSION['role'] == 'admin' ? '1' : '0';

    $hash = md5(rand(0, PHP_INT_MAX));

    if(empty($post['id_lid'])){
        $sql = "INSERT INTO leaders (familya, name, otchestvo, birthday, telephone, contact_info, city, email, social, checked, actual, image_name, token)
      VALUES ('".$post['familya']."','".$post['name']."','".$post['otchestvo']."','".$post['birthday']."','".$post['telephone']."','".$post['contact_info']."',
      '".$post['city']."','".$post['email']."','".$post['social']."','".$checked."','1','".$post['image_name']."','".$hash."')";
        $recommend = dbQuery($sql, true);
    }

    if(!empty($post['id_lid'])){
        $exist_recom = getData(dbQuery("SELECT id FROM recommend_leaders WHERE id_lid = '".$post['id_lid']."' AND user_id = '".$_SESSION['id_lid']."'"));
    }


    if (!isset($exist_recom[0]['id']) && !empty($recommend)) {
        $sql = "INSERT INTO recommend_leaders (id_lid, user_id, familya, name, otchestvo, project_name, birthday, image_name,
              telephone, contact_info, city, email, social, reason, checked, actual, full) VALUES ('".$recommend."','".$_SESSION['id_lid']."',
              '".$post['familya']."','".$post['name']."','".$post['otchestvo']."','".$post['project']."','".$post['birthday']."',
              '".$post['image_name']."','".$post['telephone']."','".$post['contact_info']."',
              '".$post['city']."','".$post['email']."','".$post['social']."','".$post['reason']."','".$checked."','1','1')";
        dbQuery($sql);
    }
}

function recommends_changeStatus($post){
    $count_recommend = getData(dbQuery("SELECT COUNT(*) FROM recommend_leaders WHERE id_lid = '".$post['id_lid']."'"));

    if($count_recommend[0]["COUNT(*)"] > 1) {
        dbQuery("UPDATE leaders SET status_recom = '1' WHERE id_lid = '".$post['id_lid']."'");
    }
}


function recommends_update($post){
    dbQuery("UPDATE recommend_leaders SET familya = '{$post['familya']}', name = '{$post['name']}', otchestvo = '{$post['otchestvo']}', project_name = '{$post['project']}', 
        contact_info = '{$post['contact_info']}', telephone = '{$post['telephone']}', birthday = '{$post['birthday']}', city = '{$post['city']}', email = '{$post['email']}', 
        social = '{$post['social']}', reason = '{$post['reason']}', actual = '1', full = '1' 
        WHERE id_lid = '{$post['id_lid']}' AND user_id = '{$_SESSION['id_lid']}'");
}

function recommends_delete($post){
    dbQuery("UPDATE recommend_leaders SET actual = '2' WHERE id_lid = '".main_checkChars($post['leader'])."' AND user_id = '".$_SESSION['id_lid']."'");
}

/**
 * getting user recommendations
 * @param $id
 * @return mixed
 */
function recommends_get($id)
{
    $leader['recom'] = getData(dbQuery("SELECT * FROM recommend_leaders WHERE id_lid = '{$id}' AND user_id = '{$_SESSION['id_lid']}'"));

    $leader['leaders'] = getData(dbQuery("SELECT * FROM leaders WHERE id_lid = '{$id}'"));
    return $leader;
}

//
//function recommends_changeStatusGet($post) {
//    if ($post['checked'] == '1') {
//        $doubles = getData(dbQuery("SELECT * FROM doubles WHERE id = '".main_checkChars($post['id'])."' LIMIT 1"));
//        $user = getData(dbQuery("SELECT user_id FROM leaders WHERE id_lid = '".$doubles[0]['id_user']."' LIMIT 1"));
//        dbQuery("UPDATE leaders SET user_id = '".$user[0]['user_id']."' WHERE id_lid = '".$doubles[0]['id_lid']."'");
//        dbQuery("UPDATE leaders SET user_id = '0' WHERE id_lid = '".$doubles[0]['id_user']."'");
//        dbQuery ("UPDATE doubles SET checked = '".main_checkChars($post['checked'])."' WHERE id = '".main_checkChars($post['id'])."'");
//        status_setAdmin($doubles[0]['id_user']);
//        status_setAdmin($doubles[0]['id_lid']);
//        //авторизовался новый лидер EVENT 5
//        main_log($doubles[0]['id_user'], '5', '', '', '', '');
//    }
//    if ($post['checked'] == '2') {
//        $doubles = getData(dbQuery("SELECT * FROM doubles WHERE id = '".main_checkChars($post['id'])."' LIMIT 1"));
//        $user = getData(dbQuery("SELECT user_id FROM leaders WHERE id_lid = '".$doubles[0]['id_lid']."' LIMIT 1"));
//        dbQuery("UPDATE leaders SET user_id = '".$user[0]['user_id']."' WHERE id_lid = '".$doubles[0]['id_user']."'");
//        dbQuery("UPDATE leaders SET user_id = '0' WHERE id_lid = '".$doubles[0]['id_lid']."'");
//        dbQuery ("UPDATE doubles SET checked = '".main_checkChars($post['checked'])."' WHERE id = '".main_checkChars($post['id'])."'");
//        status_setAdmin($doubles[0]['id_user']);
//        status_setAdmin($doubles[0]['id_lid']);
//    }
//
//
//}
