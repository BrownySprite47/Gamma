<?php

/**
 * Редактирование пользователем набора своих тегов
 */

function index()
{
    if (isset($_POST['tags'])) {
        if (isset($_POST['tags']['tag_i_can'])) {
            foreach ($_POST['tags']['tag_i_can'] as $key => $value) {
                $tags_id[0][] = checkChars($value);
            }
        } else {
            $tags_id[0] = [];
        }
        if (isset($_POST['tags']['tag_i_want'])) {
            foreach ($_POST['tags']['tag_i_want'] as $key => $value) {
                $tags_id[1][] = checkChars($value);
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

        setStatusAndAccessUserOnline($_SESSION['id_lid']);
        exit('success');
    }
}
