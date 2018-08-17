<?php
/**
 * Page /ajax/admin/recommends/add
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $recommend = main_checkChars($_POST['id_lid']);
        $familya = main_checkChars($_POST['familya']);
        $name = main_checkChars($_POST['name']);
        $otchestvo = main_checkChars($_POST['otchestvo']);
        $birthday = main_checkChars($_POST['birthday']);
        $project_name = main_checkChars($_POST['project']);
        $city = main_checkChars($_POST['city']);
        $telephone = main_checkChars($_POST['telephone']);
        $contact_info = main_checkChars($_POST['contact_info']);
        $email = main_checkChars($_POST['email']);
        $social = main_checkChars($_POST['social']);
        $reason = main_checkChars($_POST['reason']);
        $image_name = main_checkChars($_POST['image_name']);

        $checked = $_SESSION['role'] == 'admin' ? '1' : '0';

        $hash = md5(rand(0, PHP_INT_MAX));

        if(empty($recommend)){
            $sql = "INSERT INTO leaders (familya, name, otchestvo, birthday, telephone, contact_info, city, email, social, checked, actual, image_name, token) 
          VALUES ('".$familya."','".$name."','".$otchestvo."','".$birthday."','".$telephone."','".$contact_info."',
          '".$city."','".$email."','".$social."','".$checked."','1','".$image_name."','".$hash."')";
            $recommend = dbQuery($sql, true);
        }


        if(!empty($recommend)){
            $exist_recom = getData(dbQuery("SELECT id FROM recommend_leaders WHERE id_lid = '".$recommend."' AND user_id = '".$_SESSION['id_lid']."'"));
        }
        if (!isset($exist_recom[0]['id']) && !empty($recommend)) {
            $sql = "INSERT INTO recommend_leaders (
          id_lid, user_id, familya, name, otchestvo, project_name, birthday, image_name,  telephone, contact_info, city, email, social, reason, checked, actual, full) 
          VALUES ('".$recommend."','".$_SESSION['id_lid']."','".$familya."','".$name."','".$otchestvo."','".$project_name."','".$birthday."','".$image_name."','".$telephone."','".$contact_info."',
          '".$city."','".$email."','".$social."','".$reason."','".$checked."','1','1')";
            dbQuery($sql);

        }
        // $pushLeaderToDb = dbQuery("UPDATE leaders SET status_recom = '1' WHERE id_lid = '".main_checkChars($id_lid[0]['id_lid'])."'");

        $count_recommend = getData(dbQuery("SELECT COUNT(*) FROM recommend_leaders WHERE id_lid = '".$recommend."'"));
        if($count_recommend[0]["COUNT(*)"] > 1) {
            dbQuery("UPDATE leaders SET status_recom = '1' WHERE id_lid = '".$recommend."'");

        }

        status_setAdmin($recommend);
        status_setUser($_SESSION['id_lid']);


        $id_lid = getData(dbQuery("SELECT status FROM leaders WHERE id_lid = '".$recommend."'"));

        if($id_lid[0]['status'] == 2 || $id_lid[0]['status'] == 3){
            //сделал рекомендацию EVENT 4
            main_log($_SESSION['id_lid'], '4', '', '', '', $recommend);
        }
        exit("leader_recom_success");
    }else{
        header('Location: /');
    }
}
