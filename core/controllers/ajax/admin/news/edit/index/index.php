<?php
/**
 * Page /ajax/admin/news/edit
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $prev_content = main_checkChars($_POST['prev_content']);
        $content = main_checkChars($_POST['content']);
        if ($_SESSION['role'] == 'admin') {
            if ($_POST['id_news'] == '') {
                dbQuery("UPDATE news SET title = '".main_checkChars($_POST['title'])."', prev_content = '".$prev_content."', content = '".$content."' WHERE id = '".main_checkChars($_POST['id_news'])."'");
            } else {
                dbQuery("UPDATE news SET title = '".main_checkChars($_POST['title'])."', prev_content = '".$prev_content."', content = '".$content."', image = '".main_checkChars($_POST['image_name'])."' WHERE id = '".main_checkChars($_POST['id_news'])."'");
            }
        }
        exit('success');
    }else{
        header('Location: /');
    }
}
