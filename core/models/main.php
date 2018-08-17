<?php

/**
 * data cleaning function from the database
 * @param $array
 * @param null $el1
 * @param null $el2
 * @param null $el3
 * @param null $el4
 * @param null $el5
 * @return mixed
 */
function main_clean($array, $el1 = null, $el2 = null, $el3 = null, $el4 = null, $el5 = null)
{
    foreach ($array as $key => $value) {
        if ($value === $el1 || $value === $el2 || $value === $el3 || $value === $el4 || $value === $el5) {
            unset($array[$key]);
        }
    }
    return $array;
}

/**
 * function to get the correct LIMIT with SQL query
 * @param $start
 * @param $count
 * @return string
 */
function main_limit($start, $count)
{
    return $limit = ' LIMIT '.$start.', '.$count;
}

/**
 * turn all entered by users into a string
 * @param $value
 * @return string
 */
function main_checkChars($value)
{
    $link = dbConnect();

    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    $value = mysqli_real_escape_string($link, $value);

    return $value;
}

/**
 * turn all entered by users into a string, protection from scripts (simplified)
 * @param $value
 * @return string
 */
function main_checkCharsDb($value)
{
    $link = dbConnect();

    $value = mysqli_real_escape_string($link, $value);

    return $value;
}


function main_uniqueFio($post){
    $id_lid = getData(dbQuery("SELECT id_lid FROM leaders WHERE fio = '".main_checkChars($post['fio_lid'])."'"));

    if (isset($id_lid[0]['id_lid'])) {
        return "leader_exists";
    }
}

function main_uniqueTitle($post){

    $id_proj = getData(dbQuery("SELECT id_proj FROM projects WHERE project_title = '".main_checkChars($post['project_title'])."'"));

    if (isset($id_proj[0]['id_proj'])) {
        return "project_title_exists";
    }
}

function main_uniqueSite($post){
    $id_site = getData(dbQuery("SELECT id_proj FROM projects WHERE site = '".main_checkChars($post['site'])."'"));

    if (isset($id_site[0]['id_proj'])) {
        return "site_exists";
    }
}


/**
 * 1 - Клик по соцсети
 * 2 - Посещение
 * 2 - Уникальное посещение
 * 3 - Регистрация зарега
 * 4 - Получение рекомендации
 * 5 - Авторизовался лидер (привязка админом)
 * 6 - Обновили проект
 * 7 - Неавторизованные лидеры
 * 8 - Не обновляли информацию
 * 9 - Обновили теги
 * 10 - Загрузили файл
 * 11 - Загрузили ссылку
 * 12 - Неавторизованный лидер
 * 13 - Лидеры без изменений
 * 14 - Появился новый проект
 * 15 - Обновили карточку
 * 16 - Обновили рекомендацию
 */

/**
 * log events that occurred on the site
 * @param $user
 * @param $event
 * @param string $before_data
 * @param string $after_data
 * @param string $id_proj
 * @param string $id_recom
 * @param string $id_link
 * @param string $id_file
 */
function main_log($user, $event, $before_data = '', $after_data = '', $id_proj = '', $id_recom = '', $id_link = '', $id_file = '')
{
    $date = date("Y-m-d");
    dbQuery("INSERT INTO logs_user (user, event, create_date, before_data, after_data, id_proj, id_recom, id_link, id_file)
            VALUES ('".$user."', '".$event."', '".$date."', '".$before_data."', '".$after_data."', '".$id_proj."', '".$id_recom."', '".$id_link."', '".$id_file."')");
}


/**
 * check for ownership of the project to the user
 * @param $id_proj
 * @return bool
 */
function main_getProjectAccess($id_proj)
{
    if ($_SESSION['role'] == 'admin') {
        return true;
    }
    $id_proj = main_checkChars($id_proj);
    $id_project = getData(dbQuery("SELECT id FROM leader_project WHERE id_lid = '{$_SESSION['id_lid']}' AND id_proj = '{$id_proj}'"));
    return isset($id_project[0]) ? true : false;
}

/**
 * check for ownership of the recommend to the user
 * @param $id_lid
 * @return bool
 */
function main_getRecommendAccess($id_lid)
{
    if ($_SESSION['role'] == 'admin') {
        return true;
    }
    $id_lid = main_checkChars($id_lid);
    $id_leader = getData(dbQuery("SELECT id FROM recommend_leaders WHERE user_id = '{$_SESSION['id_lid']}' AND id_lid = '{$id_lid}'"));
    return isset($id_leader[0]) ? true : false;
}