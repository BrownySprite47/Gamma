<?php
/**
 * Page /ajax/index/status/change/news
 */
function index()
{
    if (isset($_POST['id_news']) && $_POST['id_news'] != '') {
        dbQuery("UPDATE news SET checked = '".main_checkChars($_POST['status'])."' WHERE id = '".main_checkChars($_POST['id_news'])."'");

        exit('news_update_success');    }

}
