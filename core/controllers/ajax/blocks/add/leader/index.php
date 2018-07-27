<?php

function index()
{
    $leaders = getLeadersFioFromProject();
    $counter = checkChars($_POST['counter']);

    include CORE_DIR . '/core/views/layouts/blocks/leaders/index/index.php';
}
