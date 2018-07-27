<?php

function index()
{
    require CORE_DIR . '/core/library/projectSqlStr.php';

    $isChangedProject = false;

    $projectBefore = getData(dbQuery("SELECT * FROM projects WHERE id_proj = '".checkChars($_POST['id_proj'])."'"));
    $fileBefore = getData(dbQuery("SELECT id, title, filename, size, ext, description FROM projects_uploads WHERE deleted IS NULL AND id_proj = '" . checkChars($_POST['id_proj']) . "'"));

    foreach ($projectBefore[0] as $key => $user) {
        if (isset($_POST[$key]) && $projectBefore[0][$key] != checkChars($_POST[$key])) {
            $isChangedProject = true;
            break;
        }
    }

    if ($isChangedProject) {
        $pos = strripos($_POST['image_name'], 'http');
        $img = ($pos === false) ? basename(checkChars($_POST['image_name'])) : checkChars($_POST['image_name']);

        $sql = "UPDATE projects SET project_title = '".$_POST['project_title']."', short_title = '".$_POST['short_title']."', project_description = '".$_POST['project_description']."', site = '".$_POST['site']."', engineer = '".$_POST['engineer']."', eq = '".$_POST['eq']."', it_prof = '".$_POST['it_prof']."', personal = '".$_POST['personal']."', proforient = '".$_POST['proforient']."', arts = '".$_POST['arts']."', lingvistic = '".$_POST['lingvistic']."', pedagogy = '".$_POST['pedagogy']."', sport = '".$_POST['sport']."', social = '".$_POST['social']."', techno = '".$_POST['techno']."', naturall = '".$_POST['naturall']."', r_00_07 = '".$_POST['r_00_07']."', r_12_15 = '".$_POST['r_12_15']."', r_16_18 = '".$_POST['r_16_18']."', r_19_25 = '".$_POST['r_19_25']."', r_08_11 = '".$_POST['r_08_11']."', r_all_life = '".$_POST['r_all_life']."', r_others = '".$_POST['r_others']."', r_parents = '".$_POST['r_parents']."', r_teachers = '".$_POST['r_teachers']."', general_online = '".$_POST['general_online']."', only_online = '".$_POST['only_online']."', general_offline = '".$_POST['general_offline']."', totally_offline = '".$_POST['totally_offline']."', first_level = '".$_POST['first_level']."', second_level = '".$_POST['second_level']."', third_level = '".$_POST['third_level']."', author = '".$_POST['author']."', stage_of_project = '".$_POST['stage_of_project']."', author_location = '".$_POST['author_location']."', start_year = '".$_POST['start_year']."', offline_geography = '".$_POST['geographys']."', image_name = '".checkChars($img)."', checked = '".(($_SESSION['role'] == 'admin') ? '1' : '3')."' WHERE id_proj = '".checkChars($_POST['id_proj'])."'";

        dbQuery($sql);
        // обновилась информация о пользователе  EVENT 11
        if ($_SESSION['status'] == 2 or $_SESSION['status'] == 3) {
            userLogs($_SESSION['id_lid'], '6', '', '', checkChars($_POST['id_proj']));
        }
    }

    function add_files_to_db($title, $filename, $description, $size, $ext)
    {
        if ($filename == '') {
            return false;
        }
        $id = dbQuery("INSERT INTO projects_uploads (id_proj, filename, description, title, size, ext) VALUES ('".$_POST['id_proj']."', '".$filename."', '".$description."', '".$title."', '".$size."', '".$ext."')", true);
        userLogs($_SESSION['id_lid'], '16', '', '', checkChars($_POST['id_proj']), '', '', $id);
    }

    if (!empty($_POST['file'])) {
        $deletedFiles = array_diff_key($fileBefore, $_POST['file']); // удаленные файлы
        $addedFiles = array_diff_key($_POST['file'], $fileBefore); // добавленные файлы

        foreach ($fileBefore as $key1 => $value1) {
            foreach ($_POST['file'] as $key2 => $value2) {
                if ($value1['filename'] == $value2['filename']) {
                    dbQuery("UPDATE projects_uploads SET description = '".$value2['description']."', title = '".$value2['title']."' WHERE id = '".$value1['id']."'");
                }
            }
        }

        foreach ($deletedFiles as $key => $file) {
            dbQuery("UPDATE projects_uploads SET deleted = 1 WHERE id = '".$file['id']."'");
        }

        foreach ($addedFiles as $key => $file) {
            add_files_to_db(checkChars($file['title']), checkChars($file['filename']), checkChars($file['description']), checkChars($file['size']), checkChars($file['ext']));
        }
    } else {
        foreach ($fileBefore as $key => $file) {
            dbQuery("UPDATE projects_uploads SET deleted = 1 WHERE id = '".$file['id']."'");
        }
    }

    function add_links_to_db($title, $link)
    {
        if ($title == '') {
            return false;
        }
        $pos = strripos($link, 'http');
        if ($pos !== false) {
            $id = dbQuery("INSERT INTO projects_links (id_proj, link, title) VALUES ('".checkChars($_POST['id_proj'])."', '".$link."', '".$title."')", true);
            userLogs($_SESSION['id_lid'], '17', '', '', checkChars($_POST['id_proj']), '', $id. '');
        }
    }

    if (!empty($_POST['link'])) {
        $deletedLinks = array_diff_key($linksBefore, $_POST['link']); // удаленные ссылки
        $addedLinks = array_diff_key($_POST['link'], $linksBefore); // добавленные ссылки

        foreach ($linksBefore as $key1 => $value1) {
            foreach ($_POST['link'] as $key2 => $value2) {
                if (isset($value1['link']) && isset($value2['link']) && ($value1['link'] == $value2['link'] || $value1['title'] == $value2['title'])) {
                    dbQuery("UPDATE projects_links SET link = '" . $value2['link'] . "', title = '" . $value2['title'] . "' WHERE id = '" . $value1['id'] . "'");
                }
            }
        }

        foreach ($deletedLinks as $key => $link) {
            dbQuery("UPDATE projects_links SET deleted = 1 WHERE id = '" . $link['id'] . "'");
        }

        foreach ($addedLinks as $key => $link) {
            add_links_to_db(checkChars($link['title']), checkChars($link['link']));
        }
    } else {
        foreach ($linksBefore as $key => $link) {
            dbQuery("UPDATE projects_links SET deleted = 1 WHERE id = '" . $link['id'] . "'");
        }
    }


    function checkAndPushToDb($id_lid, $role, $start_year, $end_year, $last_id, $checked)
    {
        $doubles = getData(dbQuery("SELECT id FROM leader_project WHERE id_lid = '".$id_lid."' AND id_proj = '".$last_id."'"));
        if (!isset($doubles[0]['id'])) {
            dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked) VALUES ('".$id_lid."', '".$last_id."', '".$role."', '".$start_year."', '".$end_year."', ".$checked.")");
        }
    }

    if (isset($_POST['leader'])) {
        dbQuery("DELETE FROM leader_project WHERE id_proj = " . checkChars($_POST['id_proj']));
        foreach ($_POST['leader'] as $leader) {
            if (isset($leader['id_lid']) && isset($leader['role']) && isset($leader['start'])) {
                checkAndPushToDb(checkChars($leader['id_lid']), checkChars($leader['role']), checkChars($leader['start']), checkChars($leader['end']), checkChars($_POST['id_proj']), (($_SESSION['role'] == 'admin') ? '1' : '3'));
            }
        }
    } else {
        dbQuery("DELETE FROM leader_project WHERE id_proj = " . checkChars($_POST['id_proj']));
    }

    if ($_SESSION['role'] == 'user') {
        $doublesUser = getData(dbQuery("SELECT id FROM leader_project WHERE id_lid = '".$_SESSION['id_lid']."' AND id_proj = '".checkChars($_POST['id_proj'])."'"));
        if (!isset($doublesUser[0]['id'])) {
            dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked) VALUES ('".$_SESSION['id_lid']."', '".checkChars($_POST['id_proj'])."', '', '', '', '0')");
        }

        setStatusAndAccessUserOnline($_SESSION['id_lid']);
    }

    exit('success');
}
