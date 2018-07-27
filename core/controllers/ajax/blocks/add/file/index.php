<?php

function index()
{
    $counter = checkChars($_POST['counter']);

    include CORE_DIR . '/core/views/layouts/blocks/files/index/index.php';
}
