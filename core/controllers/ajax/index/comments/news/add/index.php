<?php
/**
 * Page /ajax/index/comments/news/add
 */
function index()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = comments_add($_POST);
        $user = user_get($_SESSION['id_lid']);

        include CORE_DIR . '/core/views/index/layouts/blocks/comments/index/index.php';
    } else {
        header('Location: /');
    }
}