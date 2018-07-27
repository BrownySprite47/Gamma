<?php
/**
 * Редактирование информации пользователем о себе в личном кабинете
 */

function index()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
        require CORE_DIR . '/core/library/leaderSqlStr.php';

        if (empty($_POST['familya']) || empty($_POST['name']) || empty($_POST['city']) || empty($_POST['social']) || empty($_POST['birthday'])) {
            exit("empty");
        }

        $isChangedUser = false;

        $userBefore = getData(dbQuery("SELECT image_name, familya, name, otchestvo, city, birthday, social, video, telephone, email, contact_info FROM leaders WHERE id_lid = '" . $_SESSION['id_lid'] . "'"));
        $fileBefore = getData(dbQuery("SELECT id, title, filename, size, ext, description FROM leaders_uploads WHERE deleted IS NULL AND id_lid = '" . $_SESSION['id_lid'] . "'"));
        $linksBefore = getData(dbQuery("SELECT id, title, link FROM leaders_links WHERE deleted IS NULL AND id_lid = '" . $_SESSION['id_lid'] . "'"));

        foreach ($userBefore[0] as $key => $user) {
            if ($userBefore[0][$key] != checkChars($_POST[$key])) {
                $isChangedUser = true;
                break;
            }
        }

        if ($isChangedUser) {
            $pos = strripos($_POST['image_name'], 'http');
            $img = ($pos === false) ? basename(checkChars($_POST['image_name'])) : checkChars($_POST['image_name']);

            dbQuery("UPDATE leaders SET fio = '" . $fio . "', familya = '" . $_POST['familya'] . "', 
                    name = '" . $_POST['name'] . "', otchestvo = '" . $_POST['otchestvo'] . "', city = '" . $_POST['city'] . "', telephone = '" . $_POST['telephone'] . "', 
                    email = '" . $_POST['email'] . "', video = '" . $_POST['video'] . "', birthday = '" . $_POST['birthday'] . "', social = '" . $_POST['social'] . "', contact_info = '" . $_POST['contact_info'] . "', 
                    image_name = '" . $img . "', status_info = '1', checked = '3' WHERE id_lid = '" . $_SESSION['id_lid'] . "'");

            // обновилась информация о пользователе  EVENT 11
            if ($_SESSION['status'] == 2 or $_SESSION['status'] == 3) {
                userLogs($_SESSION['id_lid'], '15');
            }
        }

        function add_files_to_db($title, $filename, $description, $size, $ext)
        {
            if ($filename == '') {
                return false;
            }
            $id = dbQuery("INSERT INTO leaders_uploads (id_lid, filename, description, title, size, ext) VALUES ('".$_SESSION['id_lid']."', '".$filename."', '".$description."', '".$title."', '".$size."', '".$ext."')", true);
            if ($_SESSION['status'] == 2 or $_SESSION['status'] == 3) {
                userLogs($_SESSION['id_lid'], '10', '', '', '', '', '', $id);
            }
        }

        if (!empty($_POST['file'])) {
            $deletedFiles = array_diff_key($fileBefore, $_POST['file']); // удаленные файлы
            $addedFiles = array_diff_key($_POST['file'], $fileBefore); // добавленные файлы

//            var_dump($addedFiles);
//            var_dump($deletedFiles);

            foreach ($fileBefore as $key1 => $value1) {
                foreach ($_POST['file'] as $key2 => $value2) {
                    if ($value1['filename'] == $value2['filename']) {
                        dbQuery("UPDATE leaders_uploads SET description = '".$value2['description']."', title = '".$value2['title']."' WHERE id = '".$value1['id']."'");
                    }
                }
            }

            foreach ($deletedFiles as $key => $file) {
                dbQuery("UPDATE leaders_uploads SET deleted = 1 WHERE id = '".$file['id']."'");
            }

            foreach ($addedFiles as $key => $file) {
                add_files_to_db(checkChars($file['title']), checkChars($file['filename']), checkChars($file['description']), checkChars($file['size']), checkChars($file['ext']));
            }
        } else {
            foreach ($fileBefore as $key => $file) {
                dbQuery("UPDATE leaders_uploads SET deleted = 1 WHERE id = '".$file['id']."'");
            }
        }

        function add_links_to_db($title, $link)
        {
            if ($title == '') {
                return false;
            }
            $pos = strripos($link, 'http');
            if ($pos !== false) {
                $id = dbQuery("INSERT INTO leaders_links (id_lid, link, title) VALUES ('".$_SESSION['id_lid']."', '".$link."', '".$title."')", true);
                if ($_SESSION['status'] == 2 or $_SESSION['status'] == 3) {
                    userLogs($_SESSION['id_lid'], '11', '', '', '', '', $id. '');
                }
            }
        }

        if (!empty($_POST['link'])) {
            $deletedLinks = array_diff_key($linksBefore, $_POST['link']); // удаленные ссылки
            $addedLinks = array_diff_key($_POST['link'], $linksBefore); // добавленные ссылки

            foreach ($linksBefore as $key1 => $value1) {
                foreach ($_POST['link'] as $key2 => $value2) {
                    if (isset($value1['link']) && isset($value2['link']) && ($value1['link'] == $value2['link'] || $value1['title'] == $value2['title'])) {
                        dbQuery("UPDATE leaders_links SET link = '" . $value2['link'] . "', title = '" . $value2['title'] . "' WHERE id = '" . $value1['id'] . "'");
                    }
                }
            }

            foreach ($deletedLinks as $key => $link) {
                dbQuery("UPDATE leaders_links SET deleted = 1 WHERE id = '" . $link['id'] . "'");
            }

            foreach ($addedLinks as $key => $link) {
                add_links_to_db(checkChars($link['title']), checkChars($link['link']));
            }
        } else {
            foreach ($linksBefore as $key => $link) {
                dbQuery("UPDATE leaders_links SET deleted = 1 WHERE id = '" . $link['id'] . "'");
            }
        }

        setStatusAndAccessUserOnline($_SESSION['id_lid']);

        exit('success_user');
    }
}
