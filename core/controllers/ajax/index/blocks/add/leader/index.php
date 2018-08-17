<?php
/**
 * Page /ajax/index/blocks/leader
 */
function index()
{
    $leaders = leaders_getFioForProject();
    $counter = main_checkChars($_POST['counter']);

    include CORE_DIR . '/core/views/index/layouts/blocks/leaders/index/index.php';
}
