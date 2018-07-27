<?php

function index()
{
    $prev_content = checkChars($_POST['prev_content']);
    $content = checkChars($_POST['content']);
    if ($_SESSION['role'] == 'admin') {
        if ($_POST['id_news'] == '') {
            dbQuery("UPDATE news SET title = '".checkChars($_POST['title'])."', prev_content = '".$prev_content."', content = '".$content."' WHERE id = '".checkChars($_POST['id_news'])."'");
        } else {
            dbQuery("UPDATE news SET title = '".checkChars($_POST['title'])."', prev_content = '".$prev_content."', content = '".$content."', image = '".checkChars($_POST['image_name'])."' WHERE id = '".checkChars($_POST['id_news'])."'");
        }
    }
    exit('success');
}
