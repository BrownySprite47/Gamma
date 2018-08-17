<?php

/**
 * getting information on filters on the page \projects
 * @return mixed
 */
function projects_getFilters($post)
{
    /**
     * TODO переписать!!!!!!!!!!!!!!!!!!!!!!!!!!!
     */
    $where = (isset($post['city']) && main_checkChars($post['city']) != 'all') ? 'WHERE author_location = "'.main_checkChars($post['city']).'" AND checked != "2" AND (status="3" OR status="2")' : 'WHERE checked != "2" AND (status="3" OR status="2")';
    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';

    $filters['titles'] = main_clean(getData(dbQuery('SELECT DISTINCT project_title FROM projects '.$where.$visual.' ORDER BY project_title')));
    $filters['cities'] = main_clean(getData(dbQuery('SELECT DISTINCT author_location FROM projects WHERE checked != "2" AND (status="3" OR status="2") ' .$visual. 'ORDER BY author_location')));
    $filters['fio'] = main_clean(getData(dbQuery('SELECT fio FROM leaders WHERE checked != "2" AND (status="3" OR status="2") '.$visual.' ORDER BY fio')));
    $filters['city'] = main_clean(getData(dbQuery('SELECT DISTINCT city FROM leaders WHERE status="3" OR status="2" '.$visual.' ORDER BY city')));

    $ages = main_clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects '.$where.$visual)));
    $predmets = main_clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects '.$where.$visual)));
    $metapredmets = main_clean(getData(dbQuery('SELECT business, engineer, eq, proforient, it_prof, personal FROM projects '.$where.$visual)));

    foreach ($ages as $key => $value) {
        $filters['ages'][$key] = main_clean($ages[$key], '', '0', 0, null, 'NULL');
    }

    foreach ($predmets as $key => $value) {
        $filters['predmets'][$key] = main_clean($predmets[$key], '', '0', 0, null, 'NULL');
    }

    foreach ($metapredmets as $key => $value) {
        $filters['metapredmets'][$key] = main_clean($metapredmets[$key], '', '0', 0, null, 'NULL');
    }

    return $filters;
}

/**
 * function to retrieve all data for the selected project from the project table
 * @param $id_proj
 * @return mixed
 */
function getProject($id_proj)
{
    $id_proj = main_checkChars($id_proj);

    $projects = main_clean(getData(dbQuery('SELECT id_proj, stage_of_project, project_title, short_title, project_description, site, author, author_location, start_year, checked, image_name FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $predmets = main_clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $metapredmets = main_clean(getData(dbQuery('SELECT business, engineer, eq, proforient, it_prof, personal FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $ages = main_clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $method = main_clean(getData(dbQuery('SELECT only_online, general_online, general_offline, totally_offline FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $level = main_clean(getData(dbQuery('SELECT first_level, second_level, third_level FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $geography = main_clean(getData(dbQuery('SELECT offline_geography FROM projects WHERE id_proj = "'.$id_proj.'"')));

    //чистим данные и удаляем связку ключ-значение из массива, если в значении присутствует '', '0', 0
    foreach ($projects as $key => $project) {
        $projects[$key]['predmets'] = main_clean($predmets[$key], '', '0', 0, null, 'NULL');
        $projects[$key]['metapredmets'] = main_clean($metapredmets[$key], '', '0', 0, null, 'NULL');
        $projects[$key]['ages'] = main_clean($ages[$key], '', '0', 0, null, 'NULL');
        $projects[$key]['method'] = main_clean($method[$key], '', '0', 0, null, 'NULL');
        $projects[$key]['level'] = main_clean($level[$key], '', '0', 0, null, 'NULL');
        $projects[$key]['geography'] = $geography[$key];
    }

    return $projects;
}

/**
 * function to obtain the name and role of leaders for the selected project
 * @param $id_proj
 * @return array
 */
function getOneProjectLeaders($id_proj)
{
    $result = [];

    $leader = main_clean(getData(dbQuery('SELECT id_lid, role, start_year, end_year FROM leader_project WHERE id_proj = "'.main_checkChars($id_proj).'" AND checked != "2"')));

    if (!empty($leader)) {
        foreach ($leader as $key => $value) {
            $leaders = main_clean(getData(dbQuery('SELECT fio FROM leaders WHERE id_lid = "'.$value['id_lid'].'" AND fio != "0"')));

            $result[$key]['id_lid'] = $value['id_lid'];
            $result[$key]['fio'] = $leaders[0]['fio'];
            $result[$key]['role'] = $value['role'];
            $result[$key]['start_year'] = $value['start_year'];
            $result[$key]['end_year'] = $value['end_year'];
        }
    }

    return $result;
}


/**
 * getting the amount of user recommendation
 * @param $id_lid
 * @return mixed
 */
function getUserRecommendsCount($id_lid)
{
    $recommends = main_clean(getData(dbQuery('SELECT COUNT(*) as "0" FROM recommend_leaders WHERE id_lid = "'.$id_lid.'"')));

    return $recommends;
}

/**
 * getting the amount of user projects
 * @param $id_lid
 * @return array
 */
function getProjectsFromUser($id_lid)
{
    $projects = main_clean(getData(dbQuery('SELECT id_proj FROM leader_project WHERE id_lid = "'.$id_lid.'"')));

    $result=[];

    foreach ($projects as $key => $value) {
        $projects = main_clean(getData(dbQuery('SELECT id_proj, project_title, project_description, checked, image_name FROM projects WHERE id_proj = "'.$value['id_proj'].'"')));

        $result[$key]['project_title'] = $projects[0]['project_title'];
        $result[$key]['id_proj'] = $value['id_proj'];
        $result[$key]['project_description'] = $projects[0]['project_description'];
        $result[$key]['checked'] = $projects[0]['checked'];
        $result[$key]['image_name'] = $projects[0]['image_name'];
    }

    return $result;
}

function addProject($post){
    $img = (isset($post['image_name'])) ? basename($post['image_name']) : '';

    $checked = ($_SESSION['role'] == 'admin') ? '1' : '0';

    $sql = "INSERT INTO projects (id_proj, user_id, general_online, only_online, general_offline,
        totally_offline, first_level, second_level, third_level, business, engineer, eq, it_prof, personal, proforient, arts, lingvistic,
        pedagogy, sport, social, techno, naturall, r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others,
        project_title, short_title, project_description, site, author, stage_of_project, author_location, start_year, image_name, offline_geography,
        checked) VALUES (NULL, '" . $_SESSION['id_lid'] . "', '" . $post['general_online'] . "', '" . $post['only_online'] . "', '" . $post['general_offline'] . "',
        '" . $post['totally_offline'] . "', '" . $post['first_level'] . "', '" . $post['second_level'] . "', 
        '" . $post['third_level'] . "', '" . $post['business'] . "', '" . $post['engineer'] . "', '" . $post['eq'] . "',
         '" . $post['it_prof'] . "', '" . $post['personal'] . "', '" . $post['proforient'] . "', '" . $post['arts'] . "', '" . $post['lingvistic'] . "',
        '" . $post['pedagogy'] . "', '" . $post['sport'] . "', '" . $post['social'] . "', '" . $post['techno'] . "', '" . $post['naturall'] . "',
         '" . $post['r_00_07'] . "', '" . $post['r_08_11'] . "', '" . $post['r_12_15'] . "', '" . $post['r_16_18'] . "', '" . $post['r_19_25'] . "',
          '" . $post['r_all_life'] . "', '" . $post['r_parents'] . "', '" . $post['r_teachers'] . "', '" . $post['r_others'] . "',
        '" . $post['project_title'] . "', '" . $post['short_title'] . "', '" . $post['project_description'] . "', '" . $post['site'] . "',
         '" . $post['author'] . "', '" . $post['stage_of_project'] . "', '" . $post['author_location'] . "', '" . $post['start_year'] . "', 
         '" .  $img . "', '" . $post['geographys'] . "', '" . $checked . "')";

     return dbQuery($sql, true);
}


function addLeadersToProject($post, $last_id){

    $checked = ($_SESSION['role'] == 'admin') ? '1' : '0';

    if (!empty($post)) {
        foreach ($post as $leader) {
            if (isset($leader['id_lid']) && isset($leader['role']) && isset($leader['start'])) {
                $doubles = getData(dbQuery("SELECT id FROM leader_project WHERE id_lid = '".main_checkChars($leader['id_lid'])."' AND id_proj = '".$last_id."'"));

                if (!isset($doubles[0]['id'])) {
                    dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked)
                            VALUES ('".main_checkChars($leader['id_lid'])."', '".$last_id."', '".main_checkChars($leader['role'])."', '".main_checkChars($leader['start'])."', '".main_checkChars($leader['end'])."', ".$checked.")");
                }
            }
        }
    }
}


function addFilesToProject($post, $last_id){

    if (isset($post['file'])) {
        foreach ($post['file'] as $file) {
            if (isset($file['title']) && isset($file['filename']) && isset($file['description']) && isset($file['size']) && isset($file['ext'])) {
                if ($file['filename'] == '') {
                    return false;
                }

                $last_file_id = dbQuery("INSERT INTO projects_uploads (id_proj, filename, description, title, size, ext) 
                        VALUES ('".$last_id."', '".main_checkChars($file['filename'])."', '".main_checkChars($file['description'])."', '".main_checkChars($file['title'])."', '".main_checkChars($file['size'])."', '".main_checkChars($file['ext'])."')", true);

                // появился новый файл в проекте EVENT 16
                if (($_SESSION['status'] == 2 || $_SESSION['status'] == 3) && $last_file_id) {
                    main_log($_SESSION['id_lid'], '16', '', '', $last_id, '', '', $last_file_id);
                }
            }
        }
    }
}


function addLinksToProject($post, $last_id){

    if (isset($post['link'])) {
        foreach ($post['link'] as $link) {
            if (isset($link['title']) && isset($link['link'])) {

                $last_link_id = dbQuery("INSERT INTO projects_links (id_proj, title, link) VALUES ('".$last_id."', '".main_checkChars($link['title'])."', '".main_checkChars($link['link'])."')", true);
                // появилась новая ссылка в проекте EVENT 17
                if ($_SESSION['status'] == 2 or $_SESSION['status'] == 3 && $last_link_id) {
                    main_log($_SESSION['id_lid'], '17', '', '', $last_id, '', $last_link_id, '');
                }
            }
        }
    }
}


function addUserToProject($last_id){
    $doublesUser = getData(dbQuery("SELECT id FROM leader_project WHERE id_lid = '".$_SESSION['id_lid']."' AND id_proj = '".$last_id."'"));

    if (!isset($doublesUser[0]['id'])) {
        dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked) VALUES ('".$_SESSION['id_lid']."', '".$last_id."', '', '', '', '0')");
    }
}


function deleteProject($post){
    $id_proj = main_checkChars($post['id_proj']);

    dbQuery("UPDATE projects SET checked = 2 WHERE id_proj = ".$id_proj);
}

function recoveryProject($post){
    $id_proj = main_checkChars($post['id_proj']);

    dbQuery("UPDATE projects SET checked = 1 WHERE id_proj = ".$id_proj);
}

function getDataProjectBeforeChange($id_proj){
    return getData(dbQuery("SELECT * FROM projects WHERE id_proj = '".main_checkChars($id_proj)."'"));
}

function getDataProjectFilesBeforeChange($id_proj){
    return  getData(dbQuery("SELECT id, title, filename, size, ext, description FROM projects_uploads WHERE deleted IS NULL AND id_proj = '" . main_checkChars($id_proj) . "'"));
}

function getDataProjectLinksBeforeChange($id_proj){
    return  getData(dbQuery("SELECT id, title, link FROM projects_links WHERE deleted IS NULL AND id_proj = '" . main_checkChars($id_proj) . "'"));
}

function isChangedProject($post, $projectBefore){
    foreach ($projectBefore[0] as $key => $user) {
        if (isset($post[$key]) && $projectBefore[0][$key] != main_checkChars($post[$key])) {
            return true;
        }
    }

    return false;
}

function updateProject($post){

    $checked = ($_SESSION['role'] == 'admin') ? '1' : '3';

    $pos = strripos($post['image_name'], 'http');
    $img = ($pos === false) ? basename(main_checkChars($post['image_name'])) : main_checkChars($post['image_name']);

    $sql = "UPDATE projects SET project_title = '".$post['project_title']."', short_title = '".$post['short_title']."', project_description = '".$post['project_description']."', 
    site = '".$post['site']."', engineer = '".$post['engineer']."', eq = '".$post['eq']."', it_prof = '".$post['it_prof']."', personal = '".$post['personal']."', 
    proforient = '".$post['proforient']."', arts = '".$post['arts']."', lingvistic = '".$post['lingvistic']."', pedagogy = '".$post['pedagogy']."', sport = '".$post['sport']."', 
    social = '".$post['social']."', techno = '".$post['techno']."', naturall = '".$post['naturall']."', r_00_07 = '".$post['r_00_07']."', r_12_15 = '".$post['r_12_15']."', 
    r_16_18 = '".$post['r_16_18']."', r_19_25 = '".$post['r_19_25']."', r_08_11 = '".$post['r_08_11']."', r_all_life = '".$post['r_all_life']."', r_others = '".$post['r_others']."', 
    r_parents = '".$post['r_parents']."', r_teachers = '".$post['r_teachers']."', general_online = '".$post['general_online']."', only_online = '".$post['only_online']."', 
    general_offline = '".$post['general_offline']."', totally_offline = '".$post['totally_offline']."', first_level = '".$post['first_level']."', second_level = '".$post['second_level']."',
     third_level = '".$post['third_level']."', author = '".$post['author']."', stage_of_project = '".$post['stage_of_project']."', author_location = '".$post['author_location']."',
      start_year = '".$post['start_year']."', offline_geography = '".$post['geographys']."', image_name = '".main_checkChars($img)."', checked = '".$checked."' 
      WHERE id_proj = '".main_checkChars($post['id_proj'])."'";

    dbQuery($sql);
}

function updateProjectFiles($post, $fileBefore){
    if (isset($post['file']) && !empty($post['file'])) {

        $deletedFiles = array_diff_key($fileBefore, $post['file']); // удаленные файлы
        $addedFiles = array_diff_key($post['file'], $fileBefore); // добавленные файлы

        foreach ($fileBefore as $key1 => $value1) {
            foreach ($post['file'] as $key2 => $value2) {
                if ($value1['filename'] == $value2['filename']) {
                    dbQuery("UPDATE projects_uploads SET description = '".$value2['description']."', title = '".$value2['title']."' WHERE id = '".$value1['id']."'");
                }
            }
        }

        foreach ($deletedFiles as $key => $file) {
            dbQuery("UPDATE projects_uploads SET deleted = 1 WHERE id = '".$file['id']."'");
        }

        foreach ($addedFiles as $key => $file) {

            if ($file['filename'] != '') {
                $id = dbQuery("INSERT INTO projects_uploads (id_lid, id_proj, filename, description, title, size, ext) 
                VALUES ('".$_SESSION['id_lid']."', '".$post['id_proj']."', '".main_checkChars($file['filename'])."', '".main_checkChars($file['description'])."', '".main_checkChars($file['title'])."', '".main_checkChars($file['size'])."', '".main_checkChars($file['ext'])."')", true);
                main_log($_SESSION['id_lid'], '16', '', '', main_checkChars($post['id_proj']), '', '', $id);
            }
        }
    } else {
        dbQuery("UPDATE projects_uploads SET deleted = 1 WHERE id_proj = '" . main_checkChars($post['id_proj']) . "'");
    }

}


function updateProjectLinks($post, $linksBefore){
    if (isset($post['link'])) {
        $deletedLinks = array_diff_key($linksBefore, $post['link']); // удаленные ссылки
        $addedLinks = array_diff_key($post['link'], $linksBefore); // добавленные ссылки

        foreach ($linksBefore as $key1 => $value1) {
            foreach ($post['link'] as $key2 => $value2) {
                if (isset($value1['link']) && isset($value2['link']) && ($value1['link'] == $value2['link'] || $value1['title'] == $value2['title'])) {
                    dbQuery("UPDATE projects_links SET link = '" . $value2['link'] . "', title = '" . $value2['title'] . "' WHERE id = '" . $value1['id'] . "'");
                }
            }
        }

        foreach ($deletedLinks as $key => $link) {
            dbQuery("UPDATE projects_links SET deleted = 1 WHERE id = '" . $link['id'] . "'");
        }

        foreach ($addedLinks as $key => $link) {

            if ($link['title'] != '') {
                $pos = strripos($link['link'], 'http');
                if ($pos !== false) {
                    $id = dbQuery("INSERT INTO projects_links (id_lid, id_proj, link, title) 
                              VALUES ('".$_SESSION['id_lid']."', '".main_checkChars($post['id_proj'])."', '".main_checkChars($link['link'])."', '".main_checkChars($link['title'])."')", true);
                    main_log($_SESSION['id_lid'], '17', '', '', main_checkChars($post['id_proj']), '', $id. '');
                }
            }
        }
    } else {
        dbQuery("UPDATE projects_links SET deleted = 1 WHERE id_proj = '" . main_checkChars($post['id_proj']) . "'");
    }

}

function updateLeadersProject($post){

    $checked = ($_SESSION['role'] == 'admin') ? '1' : '0';

    if (isset($post['leader'])) {
        dbQuery("DELETE FROM leader_project WHERE id_proj = " . main_checkChars($post['id_proj']));
        foreach ($post['leader'] as $leader) {
            if (isset($leader['id_lid']) && isset($leader['role']) && isset($leader['start'])) {

                $doubles = getData(dbQuery("SELECT id FROM leader_project WHERE id_lid = '".main_checkChars($leader['id_lid'])."' AND id_proj = '".main_checkChars($post['id_proj'])."'"));
                if (!isset($doubles[0]['id'])) {
                    dbQuery("INSERT INTO leader_project (id_lid, id_proj, role, start_year, end_year, checked) VALUES ('".main_checkChars($leader['id_lid'])."', '".main_checkChars($post['id_proj'])."', '".main_checkChars($leader['role'])."', '".main_checkChars($leader['start'])."', '".main_checkChars($leader['end'])."', ".$checked.")");
                }
            }
        }
    } else {
        dbQuery("DELETE FROM leader_project WHERE id_proj = " . main_checkChars($post['id_proj']));
    }
}


/**
 * getting information about all projects from the leader
 * @return mixed
// */
//function getProjectsTitlesFromLeader()
//{
//    $filters['project_title'] = main_clean(getData(dbQuery('SELECT project_title FROM projects WHERE checked != "2" AND project_title !="" ORDER BY project_title')));
//
//    return $filters;
//}



/**
 * function for translating the name of columns in the table (since there is no localization in the database)
 * @return mixed
 */
function projects_getLocalizations()
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


/**
 * Receiving data for dynamically displaying filters depending on the conditions of the sample
 * @param $filters
 * @param $localizations
 * @return mixed
 */
function projects_getDynamicFilter($filters, $localizations)
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

/**
 * function to get the correct WHERE for the SQL query when 1 or more filters are selected
 * @param null $post
 * @return string
 */
function projects_getWhereForFilter($post = null)
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


/**
 * function for obtaining project data from the database with the specified filter conditions and the limit by the number of projects on the page
 * @param $where
 * @param $limit
 * @return mixed
 */
function projects_get($where, $limit)
{
    if ($where == '') {
        $where = ' WHERE checked != "2" AND (status="3" OR status="2")';
    }

    $visual = (isset($_SESSION['id'])) ? ' AND (actual = "1" OR actual="0")' : ' AND actual="0"';

    $projects = main_clean(getData(dbQuery('SELECT id_proj, project_title, author_location, image_name FROM projects'.$where.$visual.' ORDER BY `id_proj` ASC'.$limit)));
    $predmets = main_clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects'.$where.$visual.$limit)));
    $metapredmets = main_clean(getData(dbQuery('SELECT business, engineer, eq , proforient, it_prof, personal FROM projects'.$where.$visual.$limit)));
    $ages = main_clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects'.$where.$visual.$limit)));

    foreach ($projects as $key => $project) {
        $projects[$key]['predmets'] = main_clean($predmets[$key], '', '0', 0, null, 'NULL');
        $projects[$key]['metapredmets'] = main_clean($metapredmets[$key], '', '0', 0, null, 'NULL');
        $projects[$key]['ages'] = main_clean($ages[$key], '', '0', 0, null, 'NULL');
    }

    return $projects;
}