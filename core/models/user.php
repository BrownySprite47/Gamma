<?php

/**
 * getting information about the chosen leader through id
 * @param $id_lid
 * @return array
 */
function user_get($id_lid)
{
    return getData(dbQuery("SELECT * FROM leaders WHERE id_lid = '{$id_lid}' LIMIT 1"));
}

function user_getById($id)
{
    return getData(dbQuery("SELECT * FROM leaders WHERE user_id = '{$id}' LIMIT 1"));
}


/**
 * Verification of the existence of unauthorized leaders with a name and a name as the user
 * @return array
 */
function user_getDouble()
{
    $leaders = [];
    if (isset($_SESSION["fio_1"])) {
        $pieces_name = explode(" ", $_SESSION["fio_1"]);

        foreach ($pieces_name as $key => $value) {
            if ($value != '') {
                $pieces_name_actual[] = $value;
            }
        }
        $leaders = getData(dbQuery("SELECT id_lid, fio, image_name FROM leaders WHERE (((familya = '{$pieces_name_actual[0]}' OR name = '{$pieces_name_actual[0]}') AND (familya = '{$pieces_name_actual[1]}' OR name = '{$pieces_name_actual[1]}')) OR ((familya_eng = '{$pieces_name_actual[0]}' OR name_eng = '{$pieces_name_actual[0]}') AND (familya_eng = '{$pieces_name_actual[1]}' OR name_eng = '{$pieces_name_actual[1]}'))) AND checked != '2' AND (status='3' OR status='2') AND user_id = '0' ORDER BY fio ASC"));
        array_pop($leaders);
    }
    return $leaders ? $leaders : [];
}


function user_getUserBeforeChange(){
    return getData(dbQuery("SELECT image_name, familya, name, otchestvo, city, birthday, social, video, telephone, email, contact_info FROM leaders WHERE id_lid = '" . $_SESSION['id_lid'] . "'"));
}

function user_getFilesBeforeChange(){
    return getData(dbQuery("SELECT id, title, filename, size, ext, description FROM leaders_uploads WHERE deleted IS NULL AND id_lid = '" . $_SESSION['id_lid'] . "'"));
}

function user_getLinksBeforeChange(){
    return getData(dbQuery("SELECT id, title, link FROM leaders_links WHERE deleted IS NULL AND id_lid = '" . $_SESSION['id_lid'] . "'"));
}

function user_isChanged($post, $userBefore){
    foreach ($userBefore[0] as $key => $user) {
        if (isset($post[$key]) && $userBefore[0][$key] != main_checkChars($post[$key])) {
            return true;
        }
    }
    return false;
}

function user_update($post)
{
    $fio = $post['familya']." ".$post['name']." ".$post['otchestvo'];

    $pos = strripos($post['image_name'], 'http');
    $img = ($pos === false) ? basename(main_checkChars($post['image_name'])) : main_checkChars($post['image_name']);

    dbQuery("UPDATE leaders SET fio = '" . $fio . "', familya = '" . $post['familya'] . "', 
         name = '" . $post['name'] . "', otchestvo = '" . $post['otchestvo'] . "', city = '" . $post['city'] . "',
         telephone = '" . $post['telephone'] . "', email = '" . $post['email'] . "', video = '" . $post['video'] . "', 
         birthday = '" . $post['birthday'] . "', social = '" . $post['social'] . "', contact_info = '" . $post['contact_info'] . "', 
         image_name = '" . $img . "', status_info = '1', checked = '3' WHERE id_lid = '" . $_SESSION['id_lid'] . "'");
}

function user_updateFiles($post, $fileBefore){
    if (isset($post['file']) && !empty($post['file'])) {

        $deletedFiles = array_diff_key($fileBefore, $post['file']); // удаленные файлы
        $addedFiles = array_diff_key($post['file'], $fileBefore); // добавленные файлы

        foreach ($fileBefore as $key1 => $value1) {
            foreach ($post['file'] as $key2 => $value2) {
                if ($value1['filename'] == $value2['filename']) {
                    dbQuery("UPDATE leaders_uploads SET description = '".$value2['description']."', title = '".$value2['title']."' WHERE id = '".$value1['id']."'");
                }
            }
        }

        foreach ($deletedFiles as $key => $file) {
            dbQuery("UPDATE leaders_uploads SET deleted = 1 WHERE id = '".$file['id']."'");
        }

        foreach ($addedFiles as $key => $file) {

            if ($file['filename'] != '') {
                $id = dbQuery("INSERT INTO leaders_uploads (id_lid, filename, description, title, size, ext) 
                VALUES ('".$_SESSION['id_lid']."', '".main_checkChars($file['filename'])."', '".main_checkChars($file['description'])."', '".main_checkChars($file['title'])."', '".main_checkChars($file['size'])."', '".main_checkChars($file['ext'])."')", true);
                main_log($_SESSION['id_lid'], '10', '', '', '', '', '', $id);
            }
        }
    } else {
        dbQuery("UPDATE leaders_uploads SET deleted = 1 WHERE id_lid = '" . $_SESSION['id_lid'] . "'");
    }

}

function user_updateLinks($post, $linksBefore){
    if (isset($post['link'])) {
        $deletedLinks = array_diff_key($linksBefore, $post['link']); // удаленные ссылки
        $addedLinks = array_diff_key($post['link'], $linksBefore); // добавленные ссылки

        foreach ($linksBefore as $key1 => $value1) {
            foreach ($post['link'] as $key2 => $value2) {
                if (isset($value1['link']) && isset($value2['link']) && ($value1['link'] == $value2['link'] || $value1['title'] == $value2['title'])) {
                    dbQuery("UPDATE leaders_links SET link = '" . $value2['link'] . "', title = '" . $value2['title'] . "' WHERE id = '" . $value1['id'] . "'");
                }
            }
        }

        foreach ($deletedLinks as $key => $link) {
            dbQuery("UPDATE leaders_links SET deleted = 1 WHERE id = '" . $link['id'] . "'");
        }

        foreach ($addedLinks as $key => $link) {

            if ($link['title'] != '') {
                $pos = strripos($link['link'], 'http');
                if ($pos !== false) {
                    $id = dbQuery("INSERT INTO leaders_links (id_lid, link, title) 
                              VALUES ('".$_SESSION['id_lid']."', '".main_checkChars($link['link'])."', '".main_checkChars($link['title'])."')", true);
                    main_log($_SESSION['id_lid'], '11', '', '', '', '', $id. '');
                }
            }
        }
    } else {
        dbQuery("UPDATE leaders_links SET deleted = 1 WHERE id_lid = '" . $_SESSION['id_lid'] . "'");
    }
}

function user_changeVisibility($post){
    dbQuery("UPDATE leaders SET actual = '".main_checkChars($post['check'])."' WHERE id_lid = '".$_SESSION['id_lid']."'");

    $projects = getData(dbQuery("SELECT id_proj FROM leader_project WHERE id_lid = '".$_SESSION['id_lid']."'"));
    foreach ($projects as $key => $value) {
        dbQuery("UPDATE projects SET actual = '".main_checkChars($post['check'])."' WHERE id_proj = '".$value['id_proj']."'");

    }
}


/**
 * getting a list of user's tags
 * @return array
 */
function user_getTags()
{
    $tags = [];

    if (isset($_SESSION['id'])) {
        $tags_id = getData(dbQuery("SELECT * FROM tags_leaders WHERE id_lid = '".$_SESSION['id_lid']."' LIMIT 1"));

        if (isset($tags_id[0]['id'])) {
            $tags['tag_i_can'] = getData(dbQuery("SELECT tl.*, t.* FROM tags_leaders AS tl LEFT JOIN tags AS t ON tl.id_tag = t.id WHERE tl.id_lid = '".$_SESSION['id_lid']."' AND tl.type = '0'"));

            array_pop($tags['tag_i_can']);

            $tags['tag_i_want'] = getData(dbQuery("SELECT tl.*, t.* FROM tags_leaders AS tl LEFT JOIN tags AS t ON tl.id_tag = t.id WHERE tl.id_lid = '".$_SESSION['id_lid']."' AND tl.type = '1'"));

            array_pop($tags['tag_i_want']);

            $tags['none'] = getData(dbQuery("SELECT * FROM tags"));

            array_pop($tags['none']);

            foreach ($tags['none'] as $key => $value) {
                foreach ($tags['tag_i_can'] as $key0 => $value0) {
                    if ($value['id'] == $value0['id']) {
                        unset($tags['none'][$key]);
                    }
                }
                foreach ($tags['tag_i_want'] as $key1 => $value1) {
                    if ($value['id'] == $value1['id']) {
                        unset($tags['none'][$key]);
                    }
                }
            }
        } else {
            $tags['tag_i_can'] = [];
            $tags['tag_i_want'] = [];
            $tags['none'] = getData(dbQuery("SELECT * FROM tags"));

            array_pop($tags['none']);
        }
    }
    return $tags;
}