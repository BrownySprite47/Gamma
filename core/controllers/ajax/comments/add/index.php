<?php

function index()
{
    $id = addCommentToProject($_POST);
    $user = getUserDataFio($_SESSION['id_lid']);

    include CORE_DIR . '/core/views/layouts/blocks/comments/index/index.php';
}
