<?php

/**
 * adding a new user
 * @param $data
 * @return bool|int|mysqli_result|string
 */
function addNewUser($data)
{
    $login = $data['login'];
    $password = $data['password'];
    $email = $data['email'];
    return dbQuery("INSERT INTO `users`(`login`, `password`, `email`) VALUES ('{$login}', '{$password}', '{$email}')");
}

/**
 * receiving data about the selected user through id
 * @param $data
 * @return bool|int|mysqli_result|string
 */
function getUser($data)
{
    return dbQuery("SELECT * FROM users WHERE id = '{$data}' LIMIT 1");
}

/**
 * retrieve data about the selected user via email and password
 * @param $data
 * @return bool|int|mysqli_result|string
 */
function getUserLogin($data)
{
    $email = $data['email'];
    $password = $data['password'];
    return dbQuery("SELECT id, role, login, password, email, avatar FROM `users` WHERE email = '{$email}' AND password = '{$password}' LIMIT 1");
}

/**
 * getting information about the chosen leader through id
 * @param $id_lid
 * @return bool|int|mysqli_result|string
 */
function getUserData($id_lid)
{
    return dbQuery("SELECT * FROM leaders WHERE id_lid = '{$id_lid}' LIMIT 1");
}

/**
 * getting information about the chosen leader through id_lid
 * @param $id_lid
 * @return array
 */
function getUserDataFio($id_lid)
{
    return getData(dbQuery("SELECT * FROM leaders WHERE id_lid = '{$id_lid}' LIMIT 1"));
}

/**
 * getting information about the chosen leader through user_id
 * @param $user_id
 * @return bool|int|mysqli_result|string
 */
function getUserDataFromId($user_id)
{
    return dbQuery("SELECT * FROM leaders WHERE user_id = '{$user_id}' LIMIT 1");
}

/**
 * getting user recommendations
 * @param $id
 * @return mixed
 */
function getOneLeaderRecom($id)
{
    $user = getData(dbQuery("SELECT id_lid FROM leaders WHERE user_id = '{$_SESSION['id']}'"));
    $leader['recom'] = getData(dbQuery("SELECT * FROM recommend_leaders WHERE id_lid = '{$id}' AND user_id = '{$user[0]['id_lid']}'"));

    $leader['leaders'] = getData(dbQuery("SELECT * FROM leaders WHERE id_lid = '{$id}'"));
    return $leader;
}

/**
 * Verification of the existence of unauthorized leaders with a name and a name as the user
 * @return array
 */
function getCheckDouble()
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

/**
 * check for ownership of the project to the user
 * @param $id_proj
 * @return bool
 */
function getUserProjectsAccess($id_proj)
{
    if ($_SESSION['role'] == 'admin') {
        return true;
    }
    $id_proj = checkChars($id_proj);
    $id_project = getData(dbQuery("SELECT id FROM leader_project WHERE id_lid = '{$_SESSION['id_lid']}' AND id_proj = '{$id_proj}'"));
    return isset($id_project[0]) ? true : false;
}

/**
 * check for ownership of the recommend to the user
 * @param $id_lid
 * @return bool
 */
function getUserRecommendsAccess($id_lid)
{
    if ($_SESSION['role'] == 'admin') {
        return true;
    }
    $id_lid = checkChars($id_lid);
    $id_leader = getData(dbQuery("SELECT id FROM recommend_leaders WHERE user_id = '{$_SESSION['id_lid']}' AND id_lid = '{$id_lid}'"));
    return isset($id_leader[0]) ? true : false;
}
