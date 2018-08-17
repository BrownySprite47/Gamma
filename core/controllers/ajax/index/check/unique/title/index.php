<?php
/**
 * Page /ajax/index/check/unique/title
 */
function index()
{
    if (isset($_POST['project_title']) && !empty($_POST['project_title'])) {
        return main_uniqueTitle($_POST);
    }
}
