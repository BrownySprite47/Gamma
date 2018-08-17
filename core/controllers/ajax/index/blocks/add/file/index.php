<?php
/**
 * Page /ajax/index/blocks/add
 */
function index()
{
    $counter = main_checkChars($_POST['counter']);

    include CORE_DIR . '/core/views/index/layouts/blocks/files/index/index.php';
}
