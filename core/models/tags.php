<?php

function tags_add($post){
    dbQuery("INSERT INTO tags SET name = '".main_checkChars($post['name_tag'])."', who_is_add = '".$_SESSION['id_lid']."'");
}

function tags_edit($post){
    if (isset($post['tags']['tag_i_can'])) {
        foreach ($post['tags']['tag_i_can'] as $key => $value) {
            $tags_id[0][] = main_checkChars($value);
        }
    } else {
        $tags_id[0] = [];
    }
    if (isset($post['tags']['tag_i_want'])) {
        foreach ($post['tags']['tag_i_want'] as $key => $value) {
            $tags_id[1][] = main_checkChars($value);
        }
    } else {
        $tags_id[1] = [];
    }
    dbQuery("DELETE FROM tags_leaders WHERE id_lid = '".$_SESSION['id_lid']."'");

    foreach ($tags_id[0] as $key => $value) {
        dbQuery("INSERT INTO tags_leaders SET id_tag = '".$value."', id_lid = '".$_SESSION['id_lid']."', type = '1'");
    }
    foreach ($tags_id[1] as $key => $value) {
        dbQuery("INSERT INTO tags_leaders SET id_tag = '".$value."', id_lid = '".$_SESSION['id_lid']."', type = '0'");
    }
}

/**
 * getting a list of leader tags in accordance with the conditions of sampling and limit
 * @param $checked
 * @param $where
 * @param $limit
 * @return array
 */
function tags_get($checked, $where, $limit)
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
