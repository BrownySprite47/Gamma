<?php
/**
 * Page /index/logout
 */
function index()
{
    session_unset();
    session_destroy();
    header("location: /");
}
