<?php
/**
 * Page /confidential
 */
function index()
{
    /**
     * Page title
     */
    $data['title'] = 'Политика конфиденциальности';

    /**
     * Require view
     */
    renderView('index/confidential/index/index/index', $data);
}
