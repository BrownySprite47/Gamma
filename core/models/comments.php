<?php

function addCommentToProject($post) {
    if ($_POST['comment'] == '') exit();
    $comment = checkChars($_POST['comment']);

    $parent_comment_id = ($_POST['parent_comment_id'] != '') ? checkChars($_POST['parent_comment_id']) : '';
    $news_id = ($_POST['news_id'] != '') ? checkChars($_POST['news_id']) : null;
    $parent_author_id = ($_POST['parent_author_id'] != '') ? checkChars($_POST['parent_author_id']) : '';

    view($_POST);

    return dbQuery("INSERT INTO `comments`(`parent_comment_id`, `news_id`, `author_id`, `parent_author_id`, `comment`)
                  VALUES ('{$parent_comment_id}', '{$news_id}', '{$_SESSION['id_lid']}', '{$parent_author_id}', '{$comment}')", true);
}
