<?php
/**
 * Page /ajax/index/blocks/link
 */
function index()
{
    $counter = main_checkChars($_POST['counter']);

    include CORE_DIR . '/core/views/index/layouts/blocks/links/index/index.php';
}
