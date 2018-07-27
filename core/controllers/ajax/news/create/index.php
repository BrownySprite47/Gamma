<?php

function index()
{
    if ($_SESSION['role'] == 'admin') {
        $sql = "INSERT INTO news (title, prev_content, content, author_id, image) VALUES ('".checkChars($_POST['title'])."', '".checkChars($_POST['prev_content'])."', '".checkChars($_POST['content'])."', '".checkChars($_SESSION['id_lid'])."', '".checkChars($_POST['image_name'])."')";
        dbQuery($sql);
    }
}
