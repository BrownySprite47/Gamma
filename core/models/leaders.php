<?php

//функция для получения данных по лидерам из БД с заданными условиями по фильтру и лимитом по количеству лидеров на странице

/**
 * @param $where
 * @param $order_by
 * @param $limit
 * @param string $want_need
 * @param string $i_want
 * @param string $i_can
 * @return array|mixed
 */
function leader_get($where, $order_by, $limit, $want_need = '', $i_want = '', $i_can = '')
{
    if ($where == '') {
        $where = ' WHERE l.checked != "2" AND (l.status="3" OR l.status="2")';
    }
    $visual = (isset($_SESSION['id'])) ? ' AND (l.actual = "1" OR l.actual="0")' : ' AND l.actual="0"';

    if ($want_need != '') {
        $sql = 'SELECT DISTINCT l.id_lid, l.fio, l.city, l.social, l.video, l.image_name, l.status, l.user_id, tl.id_tag 
            FROM leaders as l LEFT JOIN tags_leaders AS tl ON tl.id_lid = l.id_lid '.$where.$want_need.$visual.$order_by.$limit;
        $leaders = getData(dbQuery($sql));
    } elseif ($i_can != '') {
        $leaders = leader_getTags(1, $where, $order_by, $limit, $visual);
    } elseif ($i_want != '') {
        $leaders = leader_getTags(0, $where, $order_by, $limit, $visual);
    } else {
        $sql = 'SELECT l.id_lid, l.fio, l.city, l.social, l.video, l.image_name, l.status, l.user_id
            FROM leaders as l '.$where.$visual.$order_by.$limit;
        $leaders = getData(dbQuery($sql));
    }

    array_pop($leaders);

    $leaders = leader_getCorrectData($leaders);

    if (isset($_SESSION['id_lid'])) {
        foreach ($leaders as $key => $leader) {
            $leaders[$key]['friends'] = leader_getFriends($_SESSION['id_lid'], $leader["id_lid"]);
        }
    }

    return $leaders;
}

/**
 * @param $type
 * @param $where
 * @param $order_by
 * @param $limit
 * @param $visual
 * @return array
 */
function leader_getTags($type, $where, $order_by, $limit, $visual)
{
    $my_tags_str = [];
    $my_sql = 'SELECT id_tag FROM tags_leaders WHERE id_lid = '.$_SESSION['id_lid'].' AND type = "'.$type.'"';
    $my_tags = getData(dbQuery($my_sql));

    array_pop($my_tags);

    foreach ($my_tags as $value) {
        $my_tags_str[] = $value["id_tag"];
    }

    $my_where = implode(" OR tl.id_tag = ", $my_tags_str);

    if ($my_where != '') {
        $my_where = " AND (tl.id_tag = ".$my_where.")";
    }

    $sql = "(SELECT DISTINCT l.id_lid, l.fio, l.city, l.social, l.image_name, l.status, l.user_id, NULL AS id_tags FROM leaders as l, tags_leaders as tl  
        ".$where." AND tl.id_lid != l.id_lid AND l.id_lid != ".$_SESSION['id_lid']." AND l.checked != '2' AND (l.status = '3' OR l.status = '2') AND (l.actual = '1' OR l.actual='0'))
        UNION
        (SELECT DISTINCT l.id_lid, l.fio, l.city, l.social, l.image_name, l.status, l.user_id, tl.id_tag AS id_tags FROM leaders as l, tags_leaders as tl  
        ".$where." AND tl.type = ".$type." ".$my_where." AND tl.id_lid = l.id_lid AND l.id_lid != ".$_SESSION['id_lid']." AND l.checked != '2' AND (l.status = '3' OR l.status = '2') AND (l.actual = '1' OR l.actual='0') ".$visual." GROUP BY l.id_lid) ORDER BY id_tags DESC ".$limit;

    return getData(dbQuery($sql));
}

/**
 * @param $leaders
 * @return mixed
 */
function leader_getCorrectData($leaders)
{
    foreach ($leaders as $key => $value) {
        $sql = 'SELECT id_proj FROM leader_project WHERE id_lid = '.$value['id_lid'];

        $leader_project = main_clean(getData(dbQuery($sql)));

        if ($value['user_id'] != 0 && $value['user_id'] != 'admin') {
            $leaders[$key]['social_user'] = main_clean(getData(dbQuery('SELECT vk, google, facebook FROM users WHERE id = '.$value['user_id'])))[0];
        } else {
            if ($value['social'] != '') {
                $pos1 = strripos($value['social'], 'facebook.com');
                if ($pos1 !== false) {
                    $leaders[$key]['social_user']['facebook_old'] = $value['social'];
                }
                $pos2 = strripos($value['social'], 'vk.com');
                if ($pos2 !== false) {
                    $leaders[$key]['social_user']['vk_old'] = $value['social'];
                }
                $pos3 = strripos($value['social'], 'google.com');
                if ($pos3 !== false) {
                    $leaders[$key]['social_user']['google_old'] = $value['social'];
                }
            }
        }

        $leaders[$key]['tag_i_can'] = getData(dbQuery('SELECT t.tag_i_can FROM tags_leaders AS tl LEFT JOIN tags AS t ON tl.id_tag = t.id WHERE type="0" AND id_lid = '.$value['id_lid']));
        $leaders[$key]['tag_i_want'] = getData(dbQuery('SELECT t.tag_i_want FROM tags_leaders AS tl LEFT JOIN tags AS t ON tl.id_tag = t.id WHERE type="1" AND id_lid = '.$value['id_lid']));

        foreach ($leader_project as $key1 => $value1) {
            $projects = main_clean(getData(dbQuery('SELECT id_proj, project_title FROM projects WHERE checked != "2" AND id_proj = '.$value1['id_proj'])));
            $files_leaders = main_clean(getData(dbQuery('SELECT COUNT(*) FROM leaders_uploads WHERE deleted IS NULL AND id_lid = '.$value['id_lid'])));
            $links_leaders = main_clean(getData(dbQuery('SELECT COUNT(*) FROM leaders_links WHERE deleted IS NULL AND id_lid = '.$value['id_lid'])));

            $files_projects = main_clean(getData(dbQuery('SELECT COUNT(*) FROM projects_uploads WHERE deleted IS NULL AND id_lid = '.$value['id_lid'])));
            $links_projects = main_clean(getData(dbQuery('SELECT COUNT(*) FROM projects_links WHERE deleted IS NULL AND id_lid = '.$value['id_lid'])));

            $files['COUNT(*)'] = $files_leaders[0]['COUNT(*)'] + $files_projects[0]['COUNT(*)'];
            $links['COUNT(*)'] = $links_leaders[0]['COUNT(*)'] + $links_projects[0]['COUNT(*)'];

            if (isset($projects[0])) {
                $leaders[$key]['projects'][] = $projects[0];
                $leaders[$key]['files'][] = $files;
                $leaders[$key]['links'][] = $links;
            }
        }
    }
    return $leaders;
}
// добавление нового лидера

/**
 * @param $data
 * @return bool|int|mysqli_result|string
 */
function leader_add($data)
{
    $email = $data['email'];
    $res = getData(dbQuery("SELECT id FROM users WHERE email = '{$email}'"));
    return dbQuery("INSERT INTO `leaders`(`user_id`, `checked`) VALUES ('{$res[0]['id']}', '0')");
}
// получение полной информации по выбранному лидеру из таблицы лидеров

/**
 * @param $id_lid
 * @return mixed
 */
function leader_getLeader($id_lid)
{
    $leaders = main_clean(getData(dbQuery("SELECT user_id, status, id_lid, video, fio, familya, name, telephone, email, 
                  otchestvo, city, social, contact_info, birthday, checked, image_name FROM leaders WHERE id_lid = '" . main_checkChars($id_lid) . "'")));

    if ($leaders[0]['user_id'] != 0 && $leaders[0]['user_id'] != 'admin') {
        $leaders['social_user'] = main_clean(getData(dbQuery('SELECT vk, google, facebook FROM users WHERE id = '.$leaders[0]['user_id'])))[0];
    } else {
        if ($leaders[0]['social'] != '') {
            $pos1 = strripos($leaders[0]['social'], 'facebook.com');
            if ($pos1 !== false) {
                $leaders['social_user']['facebook_old'] = $leaders[0]['social'];
            }
            $pos2 = strripos($leaders[0]['social'], 'vk.com');
            if ($pos2 !== false) {
                $leaders['social_user']['vk_old'] = $leaders[0]['social'];
            }
            $pos3 = strripos($leaders[0]['social'], 'google.com');
            if ($pos3 !== false) {
                $leaders['social_user']['google_old'] = $leaders[0]['social'];
            }
        }
    }

    return $leaders;
}
// получение всех проектов у выбранного лидера

/**
 * @param $id_lid
 * @param $search_id
 * @return array
 */
function leader_getProjects($id_lid, $search_id)
{

    $project = main_clean(getData(dbQuery("SELECT id_proj FROM leader_project WHERE " . main_checkChars($search_id) . " = '" . main_checkChars($id_lid) . "'  AND checked != '2'")));

    $result=[];

    foreach ($project as $key => $value) {
        $projects = main_clean(getData(dbQuery("SELECT id_proj, project_title, project_description, image_name FROM projects WHERE id_proj = '{$value['id_proj']}' AND checked != '2'")));
        if (isset($projects[0])) {
            $result[$key]['project_title'] = $projects[0]['project_title'];
            $result[$key]['id_proj'] = $value['id_proj'];
            $result[$key]['project_description'] = $projects[0]['project_description'];
            $result[$key]['image_name'] = $projects[0]['image_name'];
        }
    }

    $result = array_values($result);

    return $result;
}

// получение рекомендованных лидеров

/**
 * @return array
 */
function leader_getRecommends()
{
    $leader = getData(dbQuery("SELECT * FROM recommend_leaders WHERE user_id = '".$_SESSION['id_lid']."'"));

    array_pop($leader);

    foreach ($leader as $key => $value) {
        $res = getData(dbQuery("SELECT fio, familya, name, telephone, email, image_name FROM leaders WHERE id_lid = '".$leader[$key]['id_lid']."'"));
        $leader[$key]['fio'] = $res[0]['fio'];
        $leader[$key]['familya'] = $res[0]['familya'];
        $leader[$key]['name'] = $res[0]['name'];
        $leader[$key]['image_name'] = $res[0]['image_name'];
        $leader[$key]['telephone'] = $res[0]['telephone'];
        $leader[$key]['email'] = $res[0]['email'];
    }

    return $leader;
}

/**
 * @param $currentUserId
 * @param $viewLeaderId
 * @return array
 */
function leader_getFriends($currentUserId, $viewLeaderId)
{
    dbQuery("SET SQL_BIG_SELECTS=1;");

    $sql = "(SELECT DISTINCT t1.id_lid AS '1', t2.id_lid as '2', t3.id_lid as '3', t4.id_lid as '4', t1.actual as '5', t2.actual as '6', t3.actual as '7', t4.actual as '8'
        FROM recommend_leaders AS t1
        LEFT JOIN recommend_leaders AS t2 ON t2.user_id = t1.id_lid
        LEFT JOIN recommend_leaders AS t3 ON t3.user_id = t2.id_lid
        LEFT JOIN recommend_leaders AS t4 ON t4.user_id = t3.id_lid
        LEFT JOIN recommend_leaders AS t5 ON t5.user_id = t4.id_lid
        WHERE t1.id_lid = '{$currentUserId}'AND t1.actual != '2' AND (t2.id_lid = '{$viewLeaderId}' OR t3.id_lid = '{$viewLeaderId}' OR t4.id_lid = '{$viewLeaderId}') AND (t2.actual != '2' OR t3.actual != '2' OR t4.actual != '2') LIMIT 5) 
        UNION
        (SELECT DISTINCT t1.user_id AS '1', t2.user_id as '2', t3.user_id as '3', t4.user_id as '4', t1.actual as '5', t2.actual as '6', t3.actual as '7', t4.actual as '8'
        FROM recommend_leaders AS t1
        LEFT JOIN recommend_leaders AS t2 ON t2.id_lid = t1.user_id
        LEFT JOIN recommend_leaders AS t3 ON t3.id_lid = t2.user_id
        LEFT JOIN recommend_leaders AS t4 ON t4.id_lid = t3.user_id
        LEFT JOIN recommend_leaders AS t5 ON t5.id_lid = t4.user_id
        WHERE t1.user_id = '{$currentUserId}' AND t1.actual != '2' AND (t2.user_id = '{$viewLeaderId}' OR t3.user_id = '{$viewLeaderId}' OR t4.user_id = '{$viewLeaderId}') AND (t2.actual != '2' OR t3.actual != '2' OR t4.actual != '2') LIMIT 5);
    ";

    $relations = getData(dbQuery($sql));

    return formationDataRelations($currentUserId, $viewLeaderId, $relations, 8);
}

/**
 * @param $currentLeaderId
 * @param $viewLeaderId
 * @param $relations
 * @param $j
 * @return array
 */
function formationDataRelations($currentLeaderId, $viewLeaderId, $relations, $j)
{
    $res = [];
    foreach ($relations as $key => $value) {
        for ($count=1; $count <= $j; $count++) {
            if ($value[$count] == $viewLeaderId) {
                $res[$key][1] = $value[1];
                for ($i=2; $i <= $count; $i++) {
                    if ($value[$i] == '0') {
                        unset($res[$key]);
                        continue(2);
                    }
                    if (!in_array($value[$i], $res[$key])) {
                        $res[$key][$i] = $value[$i];
                    } else {
                        unset($res[$key]);
                        continue(2);
                    }
                }
            }
        }
    }
    $result = [];

    // здесь мы получили в массиве айдишники наших связей
    foreach ($res as $key => $value) {
        if (!in_array($value, $result)) {
            $result[] = $value;
        }
    }

    // по айдишникам получаем ФИО ------------------------------
    $ids = [];

    $toString = function ($n) {
        return "'" . $n . "'";
    };

    $tmp2 = [];

    if (!empty($result)) {
        foreach ($result as $relation) {
            $ids[] = implode(array_map($toString, $relation), ',');
        }
        $ids_1 = implode($ids, ',');
        $sql = "SELECT id_lid, fio, status FROM leaders WHERE id_lid IN (" . $ids_1 . ")";

        $currentLeaderId = getData(dbQuery($sql));

        array_pop($currentLeaderId);

        foreach ($currentLeaderId as $value) {
            $tmp[$value['id_lid']]['fio'] = $value['fio'];
            $tmp[$value['id_lid']]['status'] = $value['status'];
        }
        //------------------------------------------------------------------
        // делаем структуру массива айди - фамилия лидера
        foreach ($result as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($tmp[$value2]['status'] == '2' || $tmp[$value2]['status'] == '3') {
                    $tmp2[$key][$value2][] = $tmp[$value2]['fio'];
                    $tmp2[$key][$value2][] = $tmp[$value2]['status'];
                } else {
                    unset($tmp2[$key]);
                    continue(2);
                }
            }
        }
    }
    return isset($tmp2) ? $tmp2 : [];
}

/**
 * @param $id
 * @return array
 */
function leader_getTagsArray($id)
{
    $tags['tag_i_can'] = getData(dbQuery("SELECT tl.*, t.* FROM tags_leaders AS tl LEFT JOIN tags AS t ON t.id=tl.id_tag  WHERE tl.id_lid = '".$id."' AND type='0'"));

    array_pop($tags['tag_i_can']);

    $tags['tag_i_want'] = getData(dbQuery("SELECT tl.*, t.* FROM tags_leaders AS tl LEFT JOIN tags AS t ON t.id=tl.id_tag  WHERE tl.id_lid = '".$id."' AND type='1'"));

    array_pop($tags['tag_i_want']);

    return isset($tags) ? $tags : [];
}


//функция для получения ФИО и роли лидеров по выбранному проекту

/**
 * @param $id_lid
 * @return array
 */
function leader_getOneLeaderProjects($id_lid)
{
    $result = [];

    $sql = 'SELECT id_proj, role, start_year, end_year FROM leader_project WHERE id_lid = "'.main_checkChars($id_lid).'" AND checked != "2"';

    $project = main_clean(getData(dbQuery($sql)));

    if (!empty($project)) {
        foreach ($project as $key => $value) {
            $projects = main_clean(getData(dbQuery('SELECT project_title FROM projects WHERE id_proj = "'.$value['id_proj'].'"')));
            $result[$key]['id_proj'] = $value['id_proj'];
            $result[$key]['project_title'] = $projects[0]['project_title'];
            $result[$key]['role'] = $value['role'];
            $result[$key]['start_year'] = $value['start_year'];
            $result[$key]['end_year'] = $value['end_year'];
        }
    }
    return $result;
}

function leader_getLeaderStatus($post){
    return getData(dbQuery("SELECT status FROM leaders WHERE id_lid = '".$post['id_lid']."'"));
}


/**
 * getting information on filters on the page \leaders
 * @return mixed
 */
function leaders_getFilters()
{
    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';

    $filters['cities'] = main_clean(getData(dbQuery('SELECT DISTINCT author_location FROM projects WHERE checked != "2" AND (status="3" OR status="2") ' .$visual. 'ORDER BY author_location')));
    $filters['tag_i_can'] = main_clean(getData(dbQuery('SELECT id, tag_i_can FROM tags ORDER BY tag_i_can')));
    $filters['tag_i_want'] = main_clean(getData(dbQuery('SELECT id, tag_i_want FROM tags ORDER BY tag_i_want')));
    $filters['fio'] = main_clean(getData(dbQuery('SELECT fio FROM leaders WHERE checked != "2" AND (status="3" OR status="2") '.$visual.' ORDER BY fio')));
    $filters['city'] = main_clean(getData(dbQuery('SELECT DISTINCT city FROM leaders WHERE status="3" OR status="2" '.$visual.' ORDER BY city')));

    return $filters;
}

///**
// * getting all the leaders from the database
// * @return mixed
// */
//function getLeadersFio()
//{
//    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';
//
//    $filters['fio'] = main_clean(getData(dbQuery('SELECT fio FROM leaders WHERE checked != "2" AND fio !="" AND (status="3" OR status="2") '.$visual.' ORDER BY fio')));
//
//    return $filters;
//}
//
//
/**
 * getting all the leaders from the database
 * @return mixed
 */
function leaders_getFioForProject()
{
    $leaders = main_clean(getData(dbQuery('SELECT id_lid, fio FROM leaders WHERE checked != "2" AND fio !="" ORDER BY fio')));

    return $leaders;
}

/**
 * function to get the correct WHERE for the SQL query when 1 or more filters are selected on the LEADERS page
 * @param null $post
 * @return string
 */
function leaders_getWhereForFilter($post = null)
{
    $where = '';
    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';

    if (!is_null($post)) {
        $where .= ($post['city_filter'] == 'all'        ? '' : ($where == '' ? ' WHERE ' : ' AND ').'city = "'.$post['city_filter'].'"'.$visual);
    }

    return $where;
}


/**
 * Search for the ID of the leaders and projects in the DB and add the project leader their ID and role in the project to the table
 * @param $leaderNum
 * @param $project_title
 * @param $status
 */
//function pushToDB($leaderNum, $project_title, $status)
//{
//    if (!empty($leaderNum)) {
//        $pushToDBLidID = dbQuery("SELECT id_lid FROM leaders WHERE fio = '".$leaderNum['fio']."'");
//
//        while ($leader[] = mysqli_fetch_assoc($pushToDBLidID));
//
//        $pushToDBProjID = dbQuery("SELECT id_proj FROM projects WHERE project_title = '".$project_title."'");
//
//        while ($project[] = mysqli_fetch_assoc($pushToDBProjID));
//
//        $pushToDBProjID = dbQuery("SELECT id FROM leader_project WHERE id_lid = '".$leader[0]['id_lid']."' AND id_proj = '".$project[0]['id_proj']."'");
//
//        while ($projectFind[] = mysqli_fetch_assoc($pushToDBProjID));
//
//        if (!isset($projectFind[0]['id'])) {
//            dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked) VALUES ('".$leader[0]['id_lid']."', '".$project[0]['id_proj']."', '".$leaderNum['role']."', '".$leaderNum['start_year']."', '".$leaderNum['end_year']."', '".$status."')");
//        }
//    }
//
//    status_setAdmin(main_checkChars($leader[0]['id_lid']));
//    status_setUser($_SESSION['id_lid']);
//}
//




















































function leaders_getDataBeforeChange($id_lid){
    return getData(dbQuery("SELECT image_name, familya, name, otchestvo, city, birthday, social, video, telephone, email, contact_info FROM leaders WHERE id_lid = '" . $id_lid . "'"));
}

function leaders_getDataFilesBeforeChange($id_lid){
    return getData(dbQuery("SELECT id, title, filename, size, ext, description FROM leaders_uploads WHERE deleted IS NULL AND id_lid = '" . $id_lid . "'"));
}

function leaders_getDataLinksBeforeChange($id_lid){
    return getData(dbQuery("SELECT id, title, link FROM leaders_links WHERE deleted IS NULL AND id_lid = '" . $id_lid . "'"));
}

function leaders_isChanged($post, $userBefore){
    foreach ($userBefore[0] as $key => $user) {
        if (isset($post[$key]) && $userBefore[0][$key] != main_checkChars($post[$key])) {
            return true;
        }
    }
    return false;
}

function leaders_update($post)
{
    $fio = $post['familya']." ".$post['name']." ".$post['otchestvo'];

    $pos = strripos($post['image_name'], 'http');
    $img = ($pos === false) ? basename(main_checkChars($post['image_name'])) : main_checkChars($post['image_name']);

    dbQuery("UPDATE leaders SET fio = '" . $fio . "', familya = '" . $post['familya'] . "', 
         name = '" . $post['name'] . "', otchestvo = '" . $post['otchestvo'] . "', city = '" . $post['city'] . "',
         telephone = '" . $post['telephone'] . "', email = '" . $post['email'] . "', video = '" . $post['video'] . "', 
         birthday = '" . $post['birthday'] . "', social = '" . $post['social'] . "', contact_info = '" . $post['contact_info'] . "', 
         image_name = '" . $img . "', status_info = '1', checked = '3' WHERE id_lid = '" . $post['id_lid'] . "'");
}

function leaders_updateFiles($post, $fileBefore){
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
                VALUES ('".$post['id_lid']."', '".main_checkChars($file['filename'])."', '".main_checkChars($file['description'])."', '".main_checkChars($file['title'])."', '".main_checkChars($file['size'])."', '".main_checkChars($file['ext'])."')", true);
                main_log($post['id_lid'], '10', '', '', '', '', '', $id);
            }
        }
    } else {
        dbQuery("UPDATE leaders_uploads SET deleted = 1 WHERE id_lid = '" . $post['id_lid'] . "'");
    }

}

function leaders_updateLinks($post, $linksBefore){
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
                              VALUES ('".$post['id_lid']."', '".main_checkChars($link['link'])."', '".main_checkChars($link['title'])."')", true);
                    main_log($post['id_lid'], '11', '', '', '', '', $id. '');
                }
            }
        }
    } else {
        dbQuery("UPDATE leaders_links SET deleted = 1 WHERE id_lid = '" . $post['id_lid'] . "'");
    }
}


function leaders_add($post){

    if ($post['familya'] == '' || $post['name'] == '' || $post['city'] == '' || $post['birthday'] == '') {
        exit("empty");
    }
    $fio = $post['familya']." ".$post['name']." ".$post['otchestvo'];

    $pos = strripos($post['image_name'], 'http');
    $img = ($pos === false) ? basename(main_checkChars($post['image_name'])) : main_checkChars($post['image_name']);

    $hash = md5(rand(0, PHP_INT_MAX));

    $sql = "INSERT INTO leaders SET fio = '".$fio."', familya = '".$post['familya']."', 
        name = '".$post['name']."', otchestvo = '".$post['otchestvo']."', city = '".$post['city']."', telephone = '".$post['telephone']."', 
        email = '".$post['email']."', birthday = '".$post['birthday']."', social = '".$post['social']."', contact_info = '".$post['contact_info']."', 
        image_name = '".$img."', status_info = '1', checked = '1', token = '".$hash."'";

    $lastId = dbQuery($sql, true);


    main_log($lastId, '5');

    return $lastId;

}

function leaders_addFiles($post, $lastId){
    if (!empty($post['file'])) {
        foreach ($post['file'] as $key => $file) {
            if ($file['filename'] != '') {
                $id = dbQuery("INSERT INTO leaders_uploads (id_lid, filename, description, title, size, ext) 
                        VALUES ('".$lastId."', '".main_checkChars($file['filename'])."', '".main_checkChars($file['description'])."', '".main_checkChars($file['title'])."', '".main_checkChars($file['size'])."', '".main_checkChars($file['ext'])."')", true);
                main_log($lastId, '10', '', '', '', '', '', $id);
            }
        }
    }
}

function leaders_addFLinks($post, $lastId){
    if (!empty($post['link'])) {
        foreach ($post['link'] as $key => $link) {
            if ($link['title'] == '') {
                $pos = strripos($link['link'], 'http');
                if ($pos !== false) {
                    $id = dbQuery("INSERT INTO leaders_links (id_lid, link, title) VALUES ('".$lastId."', '".main_checkChars($link['link'])."', '".main_checkChars($link['title'])."')", true);
                    main_log($lastId, '11', '', '', '', '', $id. '');
                }
            }
        }
    }
}

function leaders_delete($post){
    dbQuery("UPDATE leaders SET checked = 2 WHERE id_lid = ".main_checkChars($post['id_lid']));
}