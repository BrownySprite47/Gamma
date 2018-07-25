<?php
// добавление нового пользователя
function addNewUser($data){
    $login = $data['login'];
    $password = $data['password'];
    $email = $data['email'];
    return dbQuery("INSERT INTO `users`(`login`, `password`, `email`) VALUES ('{$login}', '{$password}', '{$email}')");
}
// получение данных о выбранном пользователе
function getUser($data){
    return dbQuery("SELECT * FROM users WHERE id = '{$data}' LIMIT 1");
}

// получение данных о выбранном пользователе
function getUserLogin($data){
    $email = $data['email'];
    $password = $data['password'];
    return dbQuery("SELECT id, role, login, password, email, avatar FROM `users` WHERE email = '{$email}' AND password = '{$password}' LIMIT 1");
}
//получаем данные по id
function getUserData($id_lid){
    return dbQuery("SELECT * FROM leaders WHERE id_lid = '{$id_lid}' LIMIT 1");
}

//получаем данные по id
function getUserDataFromId($user_id){
    return dbQuery("SELECT * FROM leaders WHERE user_id = '{$user_id}' LIMIT 1");
}

function getOneLeaderRecom($id){

    $user = getData(dbQuery("SELECT id_lid FROM leaders WHERE user_id = '{$_SESSION['id']}'"));
    $leader['recom'] = getData(dbQuery("SELECT * FROM recommend_leaders WHERE id_lid = '{$id}' AND user_id = '{$user[0]['id_lid']}'"));

    $leader['leaders'] = getData(dbQuery("SELECT * FROM leaders WHERE id_lid = '{$id}'"));
    return $leader;
}

//получаем данные по токену
function getUserDataFromToken($token){
    $user = getData(dbQuery("SELECT id_lid, user_id, fio, status FROM leaders WHERE token = '{$token}'"));
    return $user;
}

function getDataTableUser($id){
    return getData(dbQuery("SELECT * FROM users WHERE id = '".$id."'"));
}

function getCheckDouble(){
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

function getLeadersFioCheckDouble() {
    $filters['fio'] = clean(getData(dbQuery('SELECT id_lid, fio FROM leaders WHERE checked != "2" AND (status="3" OR status="2") AND user_id != "0" ORDER BY fio')));
    return $filters;
}

function checkDoubleRecom($leader, $user){
    $recom = getData(dbQuery("SELECT * FROM recommend_leaders WHERE id_lid = '{$leader}' AND user_id = '{$_SESSION['id_lid']}'"));
    return $recom;
}
