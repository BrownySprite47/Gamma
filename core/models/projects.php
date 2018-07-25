<?php

//функция для получения всех данных по выбранному проекту из таблицы проектов
function getProject($id_proj){
    $id_proj = checkChars($id_proj);
    $projects = clean(getData(dbQuery('SELECT id_proj, stage_of_project, project_title, short_title, project_description, site, author, author_location, start_year, checked, image_name FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $predmets = clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $metapredmets = clean(getData(dbQuery('SELECT business, engineer, eq, proforient, it_prof, personal FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $ages = clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $method = clean(getData(dbQuery('SELECT only_online, general_online, general_offline, totally_offline FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $level = clean(getData(dbQuery('SELECT first_level, second_level, third_level FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $geography = clean(getData(dbQuery('SELECT offline_geography FROM projects WHERE id_proj = "'.$id_proj.'"')));
    //чистим данные и удаляем связку ключ-значение из массива, если в значении присутствует '', '0', 0
    foreach ($projects as $key => $project) {
        $projects[$key]['predmets'] = clean($predmets[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['metapredmets'] = clean($metapredmets[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['ages'] = clean($ages[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['method'] = clean($method[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['level'] = clean($level[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['geography'] = $geography[$key];
    }
    return $projects;
}

//функция для получения ФИО и роли лидеров по выбранному проекту
function getOneProjectLeaders($id_proj){
    $result = [];
    $id_proj = checkChars($id_proj);
    $sql = 'SELECT id_lid, role, start_year, end_year FROM leader_project WHERE id_proj = "'.$id_proj.'" AND checked != "2"';
    $leader = clean(getData(dbQuery($sql)));
    if (!empty($leader)){
        foreach ($leader as $key => $value){
            $leaders = clean(getData(dbQuery('SELECT fio FROM leaders WHERE id_lid = "'.$value['id_lid'].'" AND fio != "0"')));
            // $result[$key]['id_lid'] = $leaders[0]['fio'];
            $result[$key]['id_lid'] = $value['id_lid'];
            $result[$key]['fio'] = $leaders[0]['fio'];
            $result[$key]['role'] = $value['role'];
            $result[$key]['start_year'] = $value['start_year'];
            $result[$key]['end_year'] = $value['end_year'];
        }        
    }
    return $result;
}

function getUserFiles($id_lid){
    $files = clean(getData(dbQuery('SELECT * FROM leaders_uploads WHERE id_lid = "'.$id_lid.'" AND deleted IS NULL')));
    return $files;
}

function getProjectFiles($id_proj){
    $files = clean(getData(dbQuery('SELECT * FROM projects_uploads WHERE id_proj = "'.$id_proj.'"')));
    return $files;
}

function getUserLinks($id_lid){
    $links = clean(getData(dbQuery('SELECT * FROM leaders_links WHERE id_lid = "'.$id_lid.'" AND deleted IS NULL')));
    return $links;
}
function getProjectLinks($id_proj){
    $links = clean(getData(dbQuery('SELECT * FROM projects_links WHERE id_proj = "'.$id_proj.'"')));
    return $links;
}

function getUserRecommendsCount($id_lid){
    $recommends = clean(getData(dbQuery('SELECT COUNT(*) as "0" FROM recommend_leaders WHERE id_lid = "'.$id_lid.'"')));
    return $recommends;
}

function getProjectsFromUser($id_lid) {
    $projects = clean(getData(dbQuery('SELECT id_proj FROM leader_project WHERE id_lid = "'.$id_lid.'"')));
    $result=[];
    foreach ($projects as $key => $value) {
        $projects = clean(getData(dbQuery('SELECT id_proj, project_title, project_description, checked, image_name FROM projects WHERE id_proj = "'.$value['id_proj'].'"')));
        $result[$key]['project_title'] = $projects[0]['project_title'];
        $result[$key]['id_proj'] = $value['id_proj'];
        $result[$key]['project_description'] = $projects[0]['project_description'];
        $result[$key]['checked'] = $projects[0]['checked'];
        $result[$key]['image_name'] = $projects[0]['image_name'];
    }
    return $result;
}