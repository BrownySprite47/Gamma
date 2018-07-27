<?php

function dbConnect()
{
    $db = require CORE_DIR . '/core/configs/database.php';
    $link = @mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);
    mysqli_set_charset($link, "utf8");
    if (!$link) {
        if (DEBUG_DB) {
            die(mysqli_error($link));
        } else {
            die(renderView('errors/500/index/index/index'));
        }
    }

    return $link;
}

function dbQuery($sql, $id = '')
{
    $link = dbConnect();
    $result = mysqli_query($link, $sql);

    if (!$result) {
        if (DEBUG_DB) {
            die(mysqli_error($link));
        } else {
            die(renderView('errors/500/index/index/index'));
        }
    } elseif ($id != '') {
        return mysqli_insert_id($link);
    }
    return $result;
}

function getData($data)
{
    while ($result[] = mysqli_fetch_assoc($data));

    return $result;
}
