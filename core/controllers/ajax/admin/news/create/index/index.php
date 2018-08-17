<?php
/**
 * Page /ajax/admin/news/create
 */
function index()
{
    if ($_SESSION['role'] == 'admin' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = "INSERT INTO news (title, prev_content, content, author_id, image) VALUES ('".main_checkChars($_POST['title'])."', '".main_checkChars($_POST['prev_content'])."', '".main_checkChars($_POST['content'])."', '".main_checkChars($_SESSION['id_lid'])."', '".main_checkChars($_POST['image_name'])."')";
        dbQuery($sql);
    }else{
        header('Location: /');
    }
}
