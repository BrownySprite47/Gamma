<?php

function clean($array, $el1 = null, $el2 = null, $el3 = null, $el4 = null, $el5 = null)
{
    foreach ($array as $key => $value) {
        if ($value === $el1 || $value === $el2 || $value === $el3 || $value === $el4 || $value === $el5) {
            unset($array[$key]);
        }
    }
    return $array;
}

function getFilters()
{
    /**
     * TODO переписать!!!!!!!!!!!!!!!!!!!!!!!!!!!
     */
    $where = (isset($_POST['city']) && checkChars($_POST['city']) != 'all') ? 'WHERE author_location = "'.checkChars($_POST['city']).'" AND checked != "2" AND (status="3" OR status="2")' : 'WHERE checked != "2" AND (status="3" OR status="2")';
    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';
    $filters['titles'] = clean(getData(dbQuery('SELECT DISTINCT project_title FROM projects '.$where.$visual.' ORDER BY project_title')));
    $filters['cities'] = clean(getData(dbQuery('SELECT DISTINCT author_location FROM projects WHERE checked != "2" AND (status="3" OR status="2") ' .$visual. 'ORDER BY author_location')));
    $filters['fio'] = clean(getData(dbQuery('SELECT fio FROM leaders WHERE checked != "2" AND (status="3" OR status="2") '.$visual.' ORDER BY fio')));
    $filters['city'] = clean(getData(dbQuery('SELECT DISTINCT city FROM leaders WHERE status="3" OR status="2" '.$visual.' ORDER BY city')));
    $ages = clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects '.$where.$visual)));
    $predmets = clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects '.$where.$visual)));
    $metapredmets = clean(getData(dbQuery('SELECT business, engineer, eq, proforient, it_prof, personal FROM projects '.$where.$visual)));
    foreach ($ages as $key => $value) {
        $filters['ages'][$key] = clean($ages[$key], '', '0', 0, null, 'NULL');
    }
    foreach ($predmets as $key => $value) {
        $filters['predmets'][$key] = clean($predmets[$key], '', '0', 0, null, 'NULL');
    }
    foreach ($metapredmets as $key => $value) {
        $filters['metapredmets'][$key] = clean($metapredmets[$key], '', '0', 0, null, 'NULL');
    }
    return $filters;
}


function getFiltersLeaders()
{
    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';
    $filters['cities'] = clean(getData(dbQuery('SELECT DISTINCT author_location FROM projects WHERE checked != "2" AND (status="3" OR status="2") ' .$visual. 'ORDER BY author_location')));
    $filters['tag_i_can'] = clean(getData(dbQuery('SELECT id, tag_i_can FROM tags ORDER BY tag_i_can')));
    $filters['tag_i_want'] = clean(getData(dbQuery('SELECT id, tag_i_want FROM tags ORDER BY tag_i_want')));
    $filters['fio'] = clean(getData(dbQuery('SELECT fio FROM leaders WHERE checked != "2" AND (status="3" OR status="2") '.$visual.' ORDER BY fio')));
    $filters['city'] = clean(getData(dbQuery('SELECT DISTINCT city FROM leaders WHERE status="3" OR status="2" '.$visual.' ORDER BY city')));
    return $filters;
}

function getLeadersFio()
{
    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';
    $sql = 'SELECT fio FROM leaders WHERE checked != "2" AND fio !="" AND (status="3" OR status="2") '.$visual.' ORDER BY fio';
    $filters['fio'] = clean(getData(dbQuery($sql)));
    return $filters;
}

function getLeadersFioFromProject()
{
    $leaders = clean(getData(dbQuery('SELECT id_lid, fio FROM leaders WHERE checked != "2" AND fio !="" ORDER BY fio')));
    return $leaders;
}

function getProjectsTitlesFromLeader()
{
    $filters['project_title'] = clean(getData(dbQuery('SELECT project_title FROM projects WHERE checked != "2" AND project_title !="" ORDER BY project_title')));
    return $filters;
}
//функция для перевода названия колонок в таблице(так как в БД локализации нет)
function getLocalizations()
{
    $localizations['ages'] = array(
        'r_00_07' => '0-7',
        'r_12_15' => '12-15',
        'r_16_18' => '16-18',
        'r_19_25' => '19-25',
        'r_08_11' => '8-11',
        'r_all_life' => '26+',
        'r_others' => 'Прочее',
        'r_parents' => 'Родители',
        'r_teachers' => 'Педагоги',
    );

    $localizations['metapredmets'] = array(
        'business' => 'Предпринимательство и бизнес-навыки',
        'engineer' => 'Инженерное мышление',
        'eq' => 'Эмоциональная компетентность',
        'it_prof' => 'Современные ИТ-профессии',
        'personal' => 'Личностное развитие, когнитивные навыки',
        'proforient' => 'Профориентация, самоопределение',

    );

    $localizations['predmets'] = array(
        'arts' => 'Arts',
        'lingvistic' => 'Лингвистика',
        'pedagogy' => 'Педагогика2.0 и родительство',
        'sport' => 'Спорт и здоровье',
        'social' => 'Обществ.-научн. блок',
        'techno' => 'Технология',
        'naturall' => 'Естеств.-научн. блок и математика',
    );

    $localizations['methods'] = array(
        'only_online' => 'только онлайн',
        'general_online' => 'в основном онлайн',
        'general_offline' => 'в основном оффлайн',
        'totally_offline' => 'только оффлайн',
    );

    $localizations['levels'] = array(
        'first_level' => '1 уровень',
        'second_level' => '2 уровень',
        'third_level' => '3 уровень',
    );

    $localizations['geographys'] = array(
        'Международный' => 'Международный',
        'Межрегиональный' => 'Межрегиональный',
        'Локальный' => 'Локальный',
    );

    $localizations['stage_of_project'] = array(
        'Стартап' => 'Стартап',
        'Развитие' => 'Развитие',
        'Прототип' => 'Прототип',
        'Закрыт' => 'Закрыт',
        'Идея' => 'Идея',
    );

    return $localizations;
}

// локализация фильтров для корректного визуального отображения
function getDynamicFilter($filters, $localizations)
{
    if (isset($filters['ages'])) {
        foreach ($filters['ages'] as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $ages[$key1] = $value1;
            }
        }
    }

    if (isset($ages)) {
        foreach ($ages as $key => $value) {
            $result['ages'][$key] = $localizations['ages'][$key];
        }
        ksort($result['ages']);
    }
    if (isset($filters['predmets'])) {
        foreach ($filters['predmets'] as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $predmets[$key1] = $value1;
            }
        }
    }

    if (isset($predmets)) {
        foreach ($predmets as $key => $value) {
            $result['predmets'][$key] = $localizations['predmets'][$key];
        }
        asort($result['predmets']);
    }
    if (isset($filters['metapredmets'])) {
        foreach ($filters['metapredmets'] as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $metapredmets[$key1] = $value1;
            }
        }
    }

    if (isset($metapredmets)) {
        foreach ($metapredmets as $key => $value) {
            $result['metapredmets'][$key] = $localizations['metapredmets'][$key];
        }
        asort($result['metapredmets']);
    }

    return $result;
}

//функция для получения корректного WHERE для SQL-запроса, когда выбрано  1 или несколько фильтров
function getWhereForFilter($post = null)
{
    $where = '';
    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';
    if (!is_null($post)) {
        $where .= ($post['title'] == 'all'       ? '' : ($where == '' ? ' WHERE ' : ' AND ').'project_title = "'.$post['title'].'"');
        $where .= ($post['city'] == 'all'        ? '' : ($where == '' ? ' WHERE ' : ' AND ').'author_location = "'.$post['city'].'"');
        $where .= ($post['predmet'] == 'all'     ? '' : ($where == '' ? ' WHERE ' : ' AND ').$post['predmet'].' = 1');
        $where .= ($post['metapredmet'] == 'all' ? '' : ($where == '' ? ' WHERE ' : ' AND ').$post['metapredmet'].' = 1');
        $where .= ($post['age'] == 'all'         ? '' : ($where == '' ? ' WHERE ' : ' AND ').$post['age'].' = "1" '.$visual);
    }
    return $where;
}


//функция для получения корректного WHERE для SQL-запроса, когда выбрано  1 или несколько фильтров на странице ЛИДЕРОВ
function getWhereForFilterLeaders($post = null)
{
    $where = '';
    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';
    if (!is_null($post)) {
        $where .= ($post['city_filter'] == 'all'        ? '' : ($where == '' ? ' WHERE ' : ' AND ').'city = "'.$post['city_filter'].'"'.$visual);
    }
    return $where;
}


//функция для получения корректного LIMIT при SQL запросе
function getLimitForPageNavigation($start, $count)
{
    return $limit = ' LIMIT '.$start.', '.$count;
}
//функция для получения данных по проектам из БД с заданными условиями по фильтру и лимитом по количеству проектов на странице
function getProjects($where, $limit)
{
    if ($where == '') {
        $where = ' WHERE checked != "2" AND (status="3" OR status="2")';
    }
    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';
    $projects = clean(getData(dbQuery('SELECT id_proj, project_title, author_location, image_name FROM projects'.$where.$visual.' ORDER BY `id_proj` ASC'.$limit)));
    $predmets = clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects'.$where.$visual.$limit)));
    $metapredmets = clean(getData(dbQuery('SELECT business, engineer, eq , proforient, it_prof, personal FROM projects'.$where.$visual.$limit)));
    $ages = clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects'.$where.$visual.$limit)));
    foreach ($projects as $key => $project) {
        $projects[$key]['predmets'] = clean($predmets[$key], '', '0', 0, null, 'NULL');
        $projects[$key]['metapredmets'] = clean($metapredmets[$key], '', '0', 0, null, 'NULL');
        $projects[$key]['ages'] = clean($ages[$key], '', '0', 0, null, 'NULL');
    }
    return $projects;
}
// ищем в бд ID лидеров и проектов и добавляем в таблицу проект-лидер их id и роль в проекте
function pushToDB($leaderNum, $project_title, $status)
{
    if (!empty($leaderNum)) {
        $pushToDBLidID = dbQuery("SELECT id_lid FROM leaders WHERE fio = '".$leaderNum['fio']."'");
        while ($leader[] = mysqli_fetch_assoc($pushToDBLidID));
        $pushToDBProjID = dbQuery("SELECT id_proj FROM projects WHERE project_title = '".$project_title."'");
        while ($project[] = mysqli_fetch_assoc($pushToDBProjID));
        $pushToDBProjID = dbQuery("SELECT id FROM leader_project WHERE id_lid = '".$leader[0]['id_lid']."' AND id_proj = '".$project[0]['id_proj']."'");
        while ($projectFind[] = mysqli_fetch_assoc($pushToDBProjID));
        if (!isset($projectFind[0]['id'])) {
            dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked) VALUES ('".$leader[0]['id_lid']."', '".$project[0]['id_proj']."', '".$leaderNum['role']."', '".$leaderNum['start_year']."', '".$leaderNum['end_year']."', '".$status."')");
        }
    }

    setStatusAndAccessAdminOnline(checkChars($leader[0]['id_lid']));
    setStatusAndAccessUserOnline($_SESSION['id_lid']);
}


// ищем в бд ID лидеров и проектов и добавляем в таблицу проект-лидер их id и роль в проекте
function pushToDBLeader($ProjectNum, $leader, $status)
{
    //echo "string";
    if (!empty($ProjectNum)) {
        $pushToDBLidID = dbQuery("SELECT id_proj FROM projects WHERE project_title = '".$ProjectNum['project_title']."'");
        while ($project[] = mysqli_fetch_assoc($pushToDBLidID));
        // $pushToDBProjID = dbQuery ("SELECT id_lid FROM leaders WHERE fio = '".$leader."'");
        // while($project[] = mysqli_fetch_assoc($pushToDBProjID));
        $pushToDBProjID = dbQuery("SELECT id FROM leader_project WHERE id_lid = '".$leader."' AND id_proj = '".$project[0]['id_proj']."'");
        while ($projectFind[] = mysqli_fetch_assoc($pushToDBProjID));
        if (!isset($projectFind[0]['id'])) {
            dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked) 
                    VALUES ('".$leader."', '".$project[0]['id_proj']."', '".$ProjectNum['role']."', '".$ProjectNum['start_year']."', '".$ProjectNum['end_year']."', '".$status."')");
        }
    }

    setStatusAndAccessAdminOnline(checkChars($leader));
    setStatusAndAccessUserOnline($_SESSION['id_lid']);
}

function pushToDBUser($id_lid, $project_title, $checked)
{
    $project = getData(dbQuery("SELECT id_proj FROM projects WHERE project_title = '".$project_title."' LIMIT 1"));
    $projectFind = getData(dbQuery("SELECT id FROM leader_project WHERE id_lid = '".$id_lid."' AND id_proj = '".$project[0]['id_proj']."'"));
    if (!isset($projectFind[0]['id'])) {
        dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, checked) VALUES ('".$id_lid."', '".$project[0]['id_proj']."', '', '".$checked."')");
    }

    setStatusAndAccessUserOnline($_SESSION['id_lid']);
}

//превращаем все введенное пользователями в строку
function checkChars($value)
{
    $link = dbConnect();
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    $value = mysqli_real_escape_string($link, $value);
    return $value;
}

//превращаем все введенное пользователями в строку, защита от скриптов
function checkCharsDb($value)
{
    $link = dbConnect();
    $value = mysqli_real_escape_string($link, $value);
    return $value;
}

function getTagsNamesUser()
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

function getTagsData($checked, $where, $limit)
{
    if ($checked == '' && $where == '') {
        $where = '';
    } else {
        $where =  ($where == '') ? " WHERE ".$checked : $where." AND ".$checked;
    }
    $tags = getData(dbQuery("SELECT t.*, l.fio, l.id_lid FROM tags AS t LEFT JOIN leaders AS l ON t.who_is_add = l.id_lid ".$where.$limit));
    array_pop($tags);
    return $tags;
}
