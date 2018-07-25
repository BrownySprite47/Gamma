<?php

//функция для получения данных по проектам из БД с заданными условиями по фильтру и лимитом по количеству проектов на странице
function getProjectsAdmin($checked = '', $where = '', $limit = '', $list = '') {
    if ($checked == '' && $where == '') {
        $where = '';
    }else{
        $checked = 'p.'.$checked;
        $where =  ($where == '') ? " WHERE ".$checked : $where." AND ".$checked;
    }
    if($list != '') $list = ' ORDER BY p.project_title ASC ';
    $sql = "SELECT p.id_proj, p.user_id, p.project_title, p.project_description, p.status, p.checked, l.id_lid, l.fio FROM projects AS p 
            LEFT JOIN leader_project AS lp ON p.id_proj = lp.id_proj 
            LEFT JOIN leaders AS l ON lp.id_lid = l.id_lid ".$where.$list.$limit;
    $projects = clean(getData(dbQuery($sql)));

    foreach ($projects as $key => $value){
        $sql = "SELECT l.id_lid, l.fio FROM leaders AS l 
                LEFT JOIN leader_project AS lp ON l.id_lid = lp.id_lid WHERE lp.id_proj =" . $value['id_proj'];
        $projects[$key]['leaders'] = clean(getData(dbQuery($sql)));
    }
    return $projects;
}

//функция для получения данных по новым зарегистровавшимся пользователям из БД с заданными условиями по фильтру и лимитом по количеству лидеров на странице
function getLeadersAdmin($checked = '', $where = '', $limit = '', $list = '') {
    if ($checked == '' && $where == '') {
        $where = " WHERE l.fio != '' AND l.fio IS NOT NULL ";
    }else{
        $checked = 'l.'.$checked;
        $where =  ($where == '') ? " WHERE l.fio != '' AND l.fio IS NOT NULL AND ".$checked : $where." AND l.fio != '' AND l.fio IS NOT NULL AND ".$checked;
    }
    if($list != '') $list = ' ORDER BY l.fio ASC ';
    $sql = "SELECT l.user_id, l.id_lid, l.fio, l.image_name, l.social, l.status, l.checked, l.user_id AS auth FROM leaders AS l ".$where.$list.$limit;
    $leaders = clean(getData(dbQuery($sql)));

    foreach ($leaders as $key => $value){
        $sql = "SELECT p.id_proj, p.project_title FROM projects AS p 
                LEFT JOIN leader_project AS lp ON p.id_proj = lp.id_proj WHERE lp.id_lid =" . $value['id_lid'];
        $leaders[$key]['projects'] = clean(getData(dbQuery($sql)));
    }
    return $leaders;
}

function getUserDataAdmin($id){
    return dbQuery("SELECT id_lid, user_id, fio, familya, name, status, otchestvo, telephone, email, city, social, 
           contact_info, birthday, checked, image_name FROM leaders WHERE id_lid = '" . checkChars($id) . "'");
}

function getUsersAdminDoubles($checked, $where = '', $limit = ''){
    if ($checked == '' && $where == '') {
        $where = '';
    }else{
        $checked = 'd.'.$checked;
        $where =  ($where == '') ? " WHERE ".$checked : $where." AND ".$checked;
    }

    $sql = "SELECT d.id, d.id_user, d.id_lid, d.email, d.telephone, d.checked, d.admin, d.datetime,
            lu.fio AS user_fio, lu.status AS user_status, lu.social AS user_social, ll.fio AS leader_fio,
            ll.status AS leader_status, ll.social AS leader_social, ll.email AS leader_email,
            ll.telephone AS leader_telephone FROM doubles AS d LEFT JOIN leaders AS lu ON lu.id_lid = d.id_user
            LEFT JOIN leaders AS ll ON ll.id_lid = d.id_lid ".$where.$limit;
    $doubles = getData(dbQuery($sql));
    array_pop($doubles);
    return $doubles;
}

function getUsersAdminDoublesUsers(){
    $doubles = getData(dbQuery("SELECT id_lid, fio, status, social, email, telephone FROM leaders WHERE status = '0' AND fio != '' AND user_id != '0'"));
    array_pop($doubles);
    return $doubles;
}

function getUsersAdminDoublesLeaders(){
    $doubles = getData(dbQuery("SELECT id_lid, fio, status, social, email, telephone FROM leaders WHERE user_id = '0' AND fio != '' AND status != '0'"));
    array_pop($doubles);
    return $doubles;
}

function getAdminRecommends($limit, $where, $group, $checked){
    if($where == ''){
        $where = " WHERE ".$checked;
    }else{
        $where = $where." AND ".$checked;
    }

    $sql = "SELECT DISTINCT r.id_lid, r.id, r.checked, r.user_id, r.last_modified, r.project_name, r.city, r.email, r.social, r.reason, r.admin, lu.fio AS user_fio, ll.fio AS leader_fio, pl.project_title AS leader_project_title, pu.project_title AS user_project_title FROM recommend_leaders AS r LEFT JOIN leaders AS lu ON r.user_id = lu.id_lid LEFT JOIN leaders AS ll ON r.id_lid = ll.id_lid LEFT JOIN leader_project AS lpu ON lu.id_lid = lpu.id_lid LEFT JOIN leader_project AS lpl ON ll.id_lid = lpl.id_lid LEFT JOIN projects AS pu ON lpu.id_proj = pu.id_proj LEFT JOIN projects AS pl ON lpl.id_proj = pl.id_proj" . $where . " GROUP BY r.id " . $limit;
    $recommend = getData(dbQuery($sql));
    array_pop($recommend);
    return $recommend;
}

function getAdminRecommendsFrom(){
    $sql = "SELECT DISTINCT r.user_id, p.id_proj AS user_id_proj, p.project_title AS user_project_title, l.fio AS user_fio FROM recommend_leaders AS r LEFT JOIN leaders AS l ON r.user_id = l.id_lid LEFT JOIN leader_project as lp ON l.id_lid = lp.id_lid LEFT JOIN projects AS p ON lp.id_proj = p.id_proj GROUP BY r.user_id ORDER BY l.fio ASC ";
    $recommend = getData(dbQuery($sql));
    array_pop($recommend);
    return $recommend;
}
function getAdminRecommendsTo(){
    $sql = "SELECT DISTINCT r.id_lid, p.id_proj AS leader_id_proj, p.project_title AS leader_project_title, l.fio AS leader_fio FROM recommend_leaders AS r LEFT JOIN leaders AS l ON r.id_lid = l.id_lid LEFT JOIN leader_project as lp ON l.id_lid = lp.id_lid LEFT JOIN projects AS p ON lp.id_proj = p.id_proj GROUP BY r.id_lid ORDER BY l.fio ASC";
    $recommend = getData(dbQuery($sql));
    array_pop($recommend);
    return $recommend;
}

function getUsersAdminRecommendsLeaders(){
    $sql = "SELECT DISTINCT l.id_lid, l.fio AS leader_fio, p.project_title AS leader_project_title, lp.id_proj FROM leaders AS l 
            LEFT JOIN leader_project AS lp ON lp.id_lid = l.id_lid 
            LEFT JOIN projects AS p ON p.id_proj = lp.id_proj WHERE l.checked !=2 AND l.fio != '' GROUP BY l.id_lid";
    $recommend = getData(dbQuery($sql));
    array_pop($recommend);
    return $recommend;
}
// ТУТ НАДО ИЗМЕНИТЬ КОГДА БУДУ СТАТИСИКТУ ДЕЛАТЬ
function adminGetGeneralStatistics($start='', $end='') {
    if(!empty($start) && !empty($end)){
        $sql = ($start == $end) ? " AND create_date >= '".$start."' AND create_date <= '".$end."'" : " AND create_date >= '".$start."' AND create_date < '".$end."'";
    }else{
        $sql = '';
    }

    $statistics['visit_general'] = getData(dbQuery("SELECT COUNT(*) as visit_general FROM logs_user WHERE event = '2' AND user ='0'".$sql));
    $statistics['visit_unical'] = getData(dbQuery("SELECT COUNT(DISTINCT user) as visit_unical FROM logs_user WHERE event = '2' AND user !='0'".$sql));
    $statistics['registration'] = getData(dbQuery("SELECT COUNT(*) FROM logs_user WHERE event = '3'".$sql));
    $rec1 = 0;
    $rec2 = 0;
    $tmp = "SELECT user, COUNT(user) FROM logs_user WHERE event = '4'".$sql.'  GROUP BY user';
    $recommendations = getData(dbQuery($tmp));
    array_pop($recommendations);

    foreach ($recommendations as $key => $value) {
        if ($value["COUNT(user)"] < 2) {
            $rec1 = $rec1+1;
        }
        if ($value["COUNT(user)"] > 1) {
            $rec2 = $rec2+1;
        }
    }

    $statistics['recommendations1'][0]["COUNT(user)"] = $rec1;
    $statistics['recommendations2'][0]["COUNT(user)"] = $rec2;
    $statistics['social'] = getData(dbQuery("SELECT COUNT(*) FROM logs_user WHERE event = '1'".$sql));
    $statistics['updated'] = getData(dbQuery("SELECT COUNT(*) FROM logs_user WHERE (event = '6' OR event = '15' OR event = '16' OR event = '9' OR event = '10' OR event = '11') ".$sql));
    $statistics['not_updated'] = getData(dbQuery("SELECT COUNT(*) FROM logs_user WHERE event = '7'".$sql));
    $statistics['authorized'] = getData(dbQuery("SELECT COUNT(*) FROM logs_user WHERE event = '5'".$sql));
    $tmp = "SELECT COUNT(*) FROM logs_user WHERE event = '8'".$sql;
    $statistics['not_authorized'] = getData(dbQuery($tmp));
    $statistics['start'] = $start;
    $statistics['end'] = $end;

    return $statistics;
}

function getNewProjectsAdmin($limit, $where){
    $sql = "SELECT DISTINCT l.id_lid, l.fio AS leader_fio, p.project_title AS leader_project_title, lp.id_proj FROM leaders AS l 
            LEFT JOIN leader_project AS lp ON lp.id_lid = l.id_lid 
            LEFT JOIN projects AS p ON p.id_proj = lp.id_proj" . $where . " ".$group . " ".$limit;
    $recommend = getData(dbQuery($sql));
    array_pop($recommend);
    return $recommend;
}

function getDetailStatistics($start, $end, $type){
    $sql = ($start == $end) ? " AND lu.create_date >= '".$start."' AND lu.create_date <= '".$end."'" : " AND lu.create_date >= '".$start."' AND lu.create_date < '".$end."'";

    $tmp = "SELECT lu.user, l.fio, p.project_title, p.id_proj, l.date_create FROM logs_user AS lu 
    LEFT JOIN leaders AS l ON l.id_lid = lu.user
    LEFT JOIN leader_project AS lp ON l.id_lid = lp.id_lid
    LEFT JOIN projects AS p ON lp.id_proj = p.id_proj
    WHERE lu.event = '".$type."'".$sql;

    $registration = getData(dbQuery($tmp));
    array_pop($registration);
    return $registration;
}
