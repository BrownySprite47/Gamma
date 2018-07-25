<?php

function index() {
    require CORE_DIR . '/core/library/projectSqlStr.php';

    if($_SESSION['role'] == 'user')  $leader_id = $_SESSION['id_lid'];
    if($_SESSION['role'] == 'admin') $leader_id = 'admin';

    $checked = ($_SESSION['role'] == 'admin') ? '1' : '0';
    $img = (isset($_POST['image_name'])) ? basename($_POST['image_name']) : '';

    $sql = "INSERT INTO projects (id_proj, user_id, general_online, only_online, general_offline,
        totally_offline, first_level, second_level, third_level, business, engineer, eq, it_prof, personal, proforient, arts, lingvistic,
        pedagogy, sport, social, techno, naturall, r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others,
        project_title, short_title, project_description, site, author, stage_of_project, author_location, start_year, image_name, offline_geography,
        checked) VALUES (NULL, '" . $_SESSION['id_lid'] . "', '" . $_POST['general_online'] . "', '" . $_POST['only_online'] . "', '" . $_POST['general_offline'] . "',
        '" . $_POST['totally_offline'] . "', '" . $_POST['first_level'] . "', '" . $_POST['second_level'] . "', 
        '" . $_POST['third_level'] . "', '" . $_POST['business'] . "', '" . $_POST['engineer'] . "', '" . $_POST['eq'] . "',
         '" . $_POST['it_prof'] . "', '" . $_POST['personal'] . "', '" . $_POST['proforient'] . "', '" . $_POST['arts'] . "', '" . $_POST['lingvistic'] . "',
        '" . $_POST['pedagogy'] . "', '" . $_POST['sport'] . "', '" . $_POST['social'] . "', '" . $_POST['techno'] . "', '" . $_POST['naturall'] . "',
         '" . $_POST['r_00_07'] . "', '" . $_POST['r_08_11'] . "', '" . $_POST['r_12_15'] . "', '" . $_POST['r_16_18'] . "', '" . $_POST['r_19_25'] . "',
          '" . $_POST['r_all_life'] . "', '" . $_POST['r_parents'] . "', '" . $_POST['r_teachers'] . "', '" . $_POST['r_others'] . "',
        '" . $_POST['project_title'] . "', '" . $_POST['short_title'] . "', '" . $_POST['project_description'] . "', '" . $_POST['site'] . "',
         '" . $_POST['author'] . "', '" . $_POST['stage_of_project'] . "', '" . $_POST['author_location'] . "', '" . $_POST['start_year'] . "', 
         '" . $_POST['image_name'] . "', '" . $_POST['geographys'] . "', '" . $checked . "')";

//    echo $sql;
//    die();
    $last_id = dbQuery($sql, true);


    function checkAndPushToDb($id_lid, $role, $start_year, $end_year,  $last_id, $checked){
        $doubles = getData(dbQuery ("SELECT id FROM leader_project WHERE id_lid = '".$id_lid."' AND id_proj = '".$last_id."'"));
        if(!isset($doubles[0]['id'])){
            dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked) VALUES ('".$id_lid."', '".$last_id."', '".$role."', '".$start_year."', '".$end_year."', ".$checked.")");
        }
    }

    if(isset($_POST['leader'])){
        foreach ($_POST['leader'] as $leader){
            if(isset($leader['id_lid']) && isset($leader['role']) && isset($leader['start'])){
                checkAndPushToDb(checkChars($leader['id_lid']), checkChars($leader['role']), checkChars($leader['start']), checkChars($leader['end']), $last_id, (($_SESSION['role'] == 'admin') ? '1' : '3'));
            }
        }
    }

    if($_SESSION['role'] == 'user'){
        $doublesUser = getData(dbQuery ("SELECT id FROM leader_project WHERE id_lid = '".$_SESSION['id_lid']."' AND id_proj = '".$last_id."'"));
        if(!isset($doublesUser[0]['id'])){
            dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked) VALUES ('".$_SESSION['id_lid']."', '".$last_id."', '', '', '', '0')");
        }
    }

    // появился новый проект EVENT 11
    if($_SESSION['status'] == 2 OR $_SESSION['status'] == 3){
        userLogs($_SESSION['id_lid'], '14', '', '', $last_id);
    }


    function add_files_to_db($title, $filename, $description, $size, $ext, $last_id){
        if ($filename == '') return false;
        $last_file_id = dbQuery("INSERT INTO projects_uploads (id_proj, filename, description, title, size, ext) VALUES ('".$last_id."', '".$filename."', '".$description."', '".$title."', '".$size."', '".$ext."')", true);
        // появился новый файл в проекте EVENT 16
        if($_SESSION['status'] == 2 OR $_SESSION['status'] == 3){
            userLogs($_SESSION['id_lid'], '16', '', '', $last_id, '', '', $last_file_id);
        }
    }

    function add_links_to_db($title, $link, $last_id){
        if(!isset($doubles[0]['id'])){
            $last_link_id = dbQuery("INSERT INTO projects_links (id_proj, title, link) VALUES ('".$last_id."', '".$title."', '".$link."')", true);
            // появилась новая ссылка в проекте EVENT 17
            if($_SESSION['status'] == 2 OR $_SESSION['status'] == 3){
                userLogs($_SESSION['id_lid'], '17', '', '', $last_id, '', $last_link_id, '');
            }
        }
    }

    if(isset($_POST['file'])){
        foreach ($_POST['file'] as $file){
            if(isset($file['title']) && isset($file['filename']) && isset($file['description']) && isset($file['size']) && isset($file['ext'])){
                add_files_to_db(checkChars($file['title']), checkChars($file['filename']), checkChars($file['description']), checkChars($file['size']), checkChars($file['ext']), $last_id);
            }
        }
    }

    if(isset($_POST['link'])){
        foreach ($_POST['link'] as $link){
            if(isset($link['title']) && isset($link['link'])){
                add_links_to_db(checkChars($link['title']), checkChars($link['link']), $last_id);
            }
        }
    }

    exit('success_user');
}
