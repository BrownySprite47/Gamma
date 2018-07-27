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
    renderView('confidential/index/index/index/index');
}
