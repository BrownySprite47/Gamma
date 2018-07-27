<?php

function index()
{
    if (!empty($_POST['id_tag']) && !empty($_POST['checked'])) {
        $tags = getData(dbQuery("SELECT id FROM tags_leaders WHERE id_tag='".checkChars($_POST['id_tag'])."'"));
        if (!isset($tags[0]['id'])) {
            dbQuery("UPDATE tags SET checked = '".checkChars($_POST['checked'])."' WHERE id = '".checkChars($_POST['id_tag'])."'");
            exit('success');
        } else {
            exit('exist');
        }
    }
}
