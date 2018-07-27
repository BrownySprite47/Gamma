<?php

function index()
{
    if (!empty($_POST['id_tag']) && !empty($_POST['name_tag']) && !empty($_POST['want_tag']) && !empty($_POST['need_tag'])) {
        dbQuery("UPDATE tags SET name = '".checkChars($_POST['name_tag'])."', 
            tag_i_can = '".checkChars($_POST['want_tag'])."', tag_i_want = '".checkChars($_POST['need_tag'])."', 
            checked = '1' WHERE id = '".checkChars($_POST['id_tag'])."'");
        exit('success');
    }

    exit('error');
}
