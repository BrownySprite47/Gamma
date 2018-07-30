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
function getLeaders($where, $order_by, $limit, $want_need = '', $i_want = '', $i_can = '')
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
        $leaders = get_tags_from_leaders(1, $where, $order_by, $limit, $visual);
    } elseif ($i_want != '') {
        $leaders = get_tags_from_leaders(0, $where, $order_by, $limit, $visual);
    } else {
        $sql = 'SELECT l.id_lid, l.fio, l.city, l.social, l.video, l.image_name, l.status, l.user_id
            FROM leaders as l '.$where.$visual.$order_by.$limit;
        $leaders = getData(dbQuery($sql));
    }

    array_pop($leaders);
    $leaders = getCorrectData($leaders);

    if (isset($_SESSION['id_lid'])) {
        foreach ($leaders as $key => $leader) {
            $leaders[$key]['friends'] = getSixFriendsSmall($_SESSION['id_lid'], $leader["id_lid"]);
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
function get_tags_from_leaders($type, $where, $order_by, $limit, $visual)
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

    $leaders = getData(dbQuery($sql));
    return $leaders;
}

/**
 * @param $leaders
 * @return mixed
 */
function getCorrectData($leaders)
{
    foreach ($leaders as $key => $value) {
        $sql = 'SELECT id_proj FROM leader_project WHERE id_lid = '.$value['id_lid'];
        $leader_project = clean(getData(dbQuery($sql)));

        if ($value['user_id'] != 0 && $value['user_id'] != 'admin') {
            $leaders[$key]['social_user'] = clean(getData(dbQuery('SELECT vk, google, facebook FROM users WHERE id = '.$value['user_id'])))[0];
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
            $projects = clean(getData(dbQuery('SELECT id_proj, project_title FROM projects WHERE checked != "2" AND id_proj = '.$value1['id_proj'])));
            $files = clean(getData(dbQuery('SELECT COUNT(*) FROM leaders_uploads WHERE deleted IS NULL AND id_lid = '.$value['id_lid'])));
            $links = clean(getData(dbQuery('SELECT COUNT(*) FROM leaders_links WHERE deleted IS NULL AND id_lid = '.$value['id_lid'])));
            if (isset($projects[0])) {
                $leaders[$key]['projects'][] = $projects[0];
                $leaders[$key]['files'][] = $files[0];
                $leaders[$key]['links'][] = $links[0];
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
function addNewLeader($data)
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
function getOneLeader($id_lid)
{
    $id_lid = checkChars($id_lid);
    $leaders = clean(getData(dbQuery("SELECT user_id, status, id_lid, video, fio, familya, name, telephone, email, 
                  otchestvo, city, social, contact_info, birthday, checked, image_name FROM leaders WHERE id_lid = '{$id_lid}'")));

    if ($leaders[0]['user_id'] != 0 && $leaders[0]['user_id'] != 'admin') {
        $leaders['social_user'] = clean(getData(dbQuery('SELECT vk, google, facebook FROM users WHERE id = '.$leaders[0]['user_id'])))[0];
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
function getProjectsFromLeader($id_lid, $search_id)
{
    $id_lid = checkChars($id_lid);
    $search_id = checkChars($search_id);
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        $project = clean(getData(dbQuery("SELECT id_proj FROM leader_project WHERE {$search_id} = '{$id_lid}'")));
    } else {
        $project = clean(getData(dbQuery("SELECT id_proj FROM leader_project WHERE {$search_id} = '{$id_lid}'  AND checked != '2'")));
    }


    $result=[];
    foreach ($project as $key => $value) {
        $projects = clean(getData(dbQuery("SELECT id_proj, project_title, project_description, image_name FROM projects WHERE id_proj = '{$value['id_proj']}' AND checked != '2'")));
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
function getRecommendLeader()
{
    //$user = getData(dbQuery("SELECT id_lid FROM leaders WHERE user_id = '".$_SESSION['id']."'"));
    $leader = getData(dbQuery("SELECT * FROM recommend_leaders WHERE user_id = '".$_SESSION['id_lid']."' AND actual = '1'"));
    $result = array_pop($leader);
    foreach ($leader as $key => $value) {
        $res = getData(dbQuery("SELECT fio, telephone, email, image_name FROM leaders WHERE id_lid = '".$leader[$key]['id_lid']."'"));
        $leader[$key]['fio'] = $res[0]['fio'];
        $leader[$key]['image_name'] = $res[0]['image_name'];
        $leader[$key]['telephone'] = $res[0]['telephone'];
        $leader[$key]['email'] = $res[0]['email'];
        $leader[$key]['reason'] = $leader[$key]['reason'];
    }
    return $leader;
}

/**
 * @param $currentUserId
 * @param $viewLeaderId
 * @return array
 */
function getSixFriendsSmall($currentUserId, $viewLeaderId)
{
    // $currentLeaderId = getData(dbQuery("SELECT id_lid as '0' FROM leaders WHERE user_id = '" . $currentUserId . "';"));
    $sSql1 = dbQuery("SET SQL_BIG_SELECTS=1;");
    $sql = "
    (SELECT DISTINCT t1.id_lid AS '1', t2.id_lid as '2', t3.id_lid as '3', t4.id_lid as '4', t1.actual as '5', t2.actual as '6', t3.actual as '7', t4.actual as '8'
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

    //echo "$sql";
    $relations = getData(dbQuery($sql));
    //view($relations);
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
    $ids = '';
    $toString = function ($n) {
        return "'" . $n . "'";
    };
    if (!empty($result)) {
        foreach ($result as $relation) {
            $ids[] = implode(array_map($toString, $relation), ',');
        }
        $ids = implode($ids, ',');
        $sql = "SELECT id_lid, fio, status FROM leaders WHERE id_lid IN (" . $ids . ");";
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
function getUserDataTags($id)
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
function getOneLeaderProjects($id_lid)
{
    $result = [];
    $id_lid = checkChars($id_lid);
    $sql = 'SELECT id_proj, role, start_year, end_year FROM leader_project WHERE id_lid = "'.$id_lid.'" AND checked != "2"';
    $project = clean(getData(dbQuery($sql)));
    if (!empty($project)) {
        foreach ($project as $key => $value) {
            $projects = clean(getData(dbQuery('SELECT project_title FROM projects WHERE id_proj = "'.$value['id_proj'].'"')));
            $result[$key]['id_proj'] = $value['id_proj'];
            $result[$key]['project_title'] = $projects[0]['project_title'];
            $result[$key]['role'] = $value['role'];
            $result[$key]['start_year'] = $value['start_year'];
            $result[$key]['end_year'] = $value['end_year'];
        }
    }
    return $result;
}
