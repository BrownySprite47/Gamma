<?php
/**
 * Page /ajax/admin/tags/edit
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_POST['id_tag']) && !empty($_POST['name_tag']) && !empty($_POST['tag_i_want']) && !empty($_POST['tag_i_can'])) {
            dbQuery ("UPDATE tags SET name = '".main_checkChars($_POST['name_tag'])."', tag_i_want = '".main_checkChars($_POST['tag_i_want'])."', tag_i_can= '".main_checkChars($_POST['tag_i_can'])."', checked = '1' WHERE id = '".main_checkChars($_POST['id_tag'])."'");
            exit('success');
        }
    }else{
        header('Location: /');
    }
}
