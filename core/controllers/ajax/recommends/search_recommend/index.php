<?php
//
//function index(){
//    if($_POST['search'] == '') exit();
//    $db = dbConnect();
//    $sql = "SELECT id_lid, fio, image_name FROM leaders WHERE familya = '".checkChars($_POST['search'])."'";
//    $query = mysqli_query($db, $sql);
//    if(mysqli_num_rows($query) > 0){
//        $sql = mysqli_fetch_array($query);
//        $exist_recom = "SELECT id FROM recommend_leaders WHERE id_lid = '".$sql["id_lid"]."' AND user_id = '".$_SESSION['id_lid']."'";
//        $result = mysqli_query($db, $exist_recom);
//
//        if(mysqli_num_rows($result) === 0){
//            do{
//                if (!empty($sql['image_name'])) {
//                    $id = 'no_btn_'.$sql["id_lid"];
//                    echo "<div style='margin: 10px; text-align: center; width: 278px; border: 1px #474747 solid; padding: 30px 10px 34px 10px; background: #e7e7e7;' class='search_box_".$id."'><a onclick=\"checkSearch('".$id."')\"><i style='position: absolute; top: 19px; right: 22px;' class='fa fa-times' aria-hidden='true'></i></a><p>Возможно вы имеете в виду этого лидера?</p><a href='/leaders/view?id=".$sql['id_lid']."'>".$sql['fio']."</a>"."<img style='margin: 36px 0; width: 100%;' src='". CORE_IMG_PATH . $sql['image_name']."'><a style='margin: 0 15px;' href='/leaders/view?id=".$sql['id_lid']."&recom=true' class='btn btn-success'>Да</a>"."<a onclick=\"checkSearch('".$id."')\" class='btn btn-danger'>Нет</a></div>";
//                }else{
//                    $id = 'no_btn_'.$sql["id_lid"];
//                    echo "<div style='margin: 10px; text-align: center; width: 278px; border: 1px #474747 solid; padding: 30px 10px 34px 10px; background: #e7e7e7;' class='search_box_".$id."'><a onclick=\"checkSearch('".$id."')\"><i style='position: absolute; top: 19px; right: 22px;' class='fa fa-times' aria-hidden='true'></i></a><p>Возможно вы имеете в виду этого лидера?</p><a href='/leaders/view?id=".$sql['id_lid']."'>".$sql['fio']."</a>". "<img style='margin: 36px 0; width: 100%;' src='" . CORE_IMG_PATH . "img_not_found.png'><a id='yes_btn' style='margin: 0 15px;'  href='/leaders/view?id=" .$sql['id_lid']."&recom=true' class='btn btn-success'>Да</a>"."<a onclick=\"checkSearch('".$id."')\" class='btn btn-danger'>Нет</a></div>";
//                }
//            }while($sql = mysqli_fetch_array($query));
//       }else{
//            do{
//                if (!empty($sql['image_name'])) {
//                    $id = 'no_btn_'.$sql["id_lid"];
//                    echo "<div style='margin: 10px; text-align: center; width: 278px; border: 1px #474747 solid; padding: 30px 10px 34px 10px; background: #e7e7e7;' class='search_box_".$id."'><a onclick=\"checkSearch('".$id."')\"><i style='position: absolute; top: 19px; right: 22px;' class='fa fa-times' aria-hidden='true'></i></a><p>Возможно вы имеете в виду этого лидера?</p><a href='/leaders/view?id=".$sql['id_lid']."'>".$sql['fio']."</a>"."<img style='margin: 36px 0; width: 100%;' src='". CORE_IMG_PATH . $sql['image_name']."'><p style='margin: text-align: center;'>Вы уже рекомендовали данного лидера</p><a id='yes_btn' style='margin: 0 15px;'  href='/leaders/view?id=".$sql['id_lid']."&recom=true' class='btn btn-success'>Перейти</a></div>";
//                }else{
//                    $id = 'no_btn_'.$sql["id_lid"];
//                    echo "<div style='margin: 10px; text-align: center; width: 278px; border: 1px #474747 solid; padding: 30px 10px 34px 10px; background: #e7e7e7;' class='search_box_".$id."'><a onclick=\"checkSearch('".$id."')\"><i style='position: absolute; top: 19px; right: 22px;' class='fa fa-times' aria-hidden='true'></i></a><p>Возможно вы имеете в виду этого лидера?</p><a href='/leaders/view?id=".$sql['id_lid']."'>".$sql['fio']."</a>". "<img style='margin: 36px 0; width: 100%;' src='" . CORE_IMG_PATH . "img_not_found.png'><p style='margin: text-align: center;'>Вы уже рекомендовали данного лидера</p><a id='yes_btn' style='margin: 0 15px;'  href='/leaders/view?id=" .$sql['id_lid']."&recom=true' class='btn btn-success'>Перейти</a></div>";
//                }
//            }while($sql = mysqli_fetch_array($query));
//        }
//    }
//}
