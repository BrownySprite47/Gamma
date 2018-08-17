<?php
/**
 * Page /ajax/index/check/unique/site
 */
function index()
{
    if (isset($_POST['site']) && !empty($_POST['site'])) {
        return main_uniqueSite($_POST);
    }
}
