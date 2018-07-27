<?php

function index()
{
    require CORE_DIR . '/core/library/leaderSqlStr.php';

    if ($_POST['familya'] == '' || $_POST['name'] == '' || $_POST['city'] == '' || $_POST['birthday'] == '') {
        exit("empty");
    }

    $pos = strripos($_POST['image_name'], 'http');
    $img = ($pos === false) ? basename(checkChars($_POST['image_name'])) : checkChars($_POST['image_name']);

    $hash = md5(rand(0, PHP_INT_MAX));

    $sql = "INSERT INTO leaders SET fio = '".$fio."', familya = '".$_POST['familya']."', 
    name = '".$_POST['name']."', otchestvo = '".$_POST['otchestvo']."', city = '".$_POST['city']."', telephone = '".$_POST['telephone']."', 
    email = '".$_POST['email']."', birthday = '".$_POST['birthday']."', social = '".$_POST['social']."', contact_info = '".$_POST['contact_info']."', 
    image_name = '".$img."', status_info = '1', checked = '1', token = '".$hash."'";

    $lastId = dbQuery($sql, true);

    // появился новый лидер EVENT 5
    if ($_SESSION['status'] == 2 or $_SESSION['status'] == 3) {
        userLogs($lastId, '5');
    }

    function add_files_to_db($title, $filename, $description, $size, $ext, $lastId)
    {
        if ($filename == '') {
            return false;
        }
        $id = dbQuery("INSERT INTO leaders_uploads (id_lid, filename, description, title, size, ext) VALUES ('".$lastId."', '".$filename."', '".$description."', '".$title."', '".$size."', '".$ext."')", true);
        userLogs($lastId, '10', '', '', '', '', '', $id);
    }

    if (!empty($_POST['file'])) {
        foreach ($_POST['file'] as $key => $file) {
            add_files_to_db(checkChars($file['title']), checkChars($file['filename']), checkChars($file['description']), checkChars($file['size']), checkChars($file['ext']), $lastId);
        }
    }

    function add_links_to_db($title, $link, $lastId)
    {
        if ($title == '') {
            return false;
        }
        $pos = strripos($link, 'http');
        if ($pos !== false) {
            $id = dbQuery("INSERT INTO leaders_links (id_lid, link, title) VALUES ('".$lastId."', '".$link."', '".$title."')", true);
            userLogs($lastId, '11', '', '', '', '', $id. '');
        }
    }

    if (!empty($_POST['link'])) {
        foreach ($_POST['link'] as $key => $link) {
            add_links_to_db(checkChars($link['title']), checkChars($link['link']), $lastId);
        }
    }
    setStatusAndAccessAdminOnline($lastId);
    exit('success');
}
