<?php
/**
 * Page /
 */
function index()
{
    /**
     * Page title
     */
    $data['title'] = 'Главная';

    /**
     * If the main page does not exist, then we redirect to the news page
     */
    header("Location: /index/news");
}
