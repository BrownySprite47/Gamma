<?php

/**
 * @param $post
 * @return bool|int|mysqli_result|string
 */
function addCommentToProject($post)
{
    if ($_POST['comment'] == '') {
        exit();
    }

    $comment = checkCharsDb($_POST['comment']);

    $parent_comment_id = ($_POST['parent_comment_id'] != '') ? checkChars($_POST['parent_comment_id']) : '';
    $news_id = ($_POST['news_id'] != '') ? checkChars($_POST['news_id']) : null;
    $parent_author_id = ($_POST['parent_author_id'] != '') ? checkChars($_POST['parent_author_id']) : '';

    return dbQuery("INSERT INTO `comments`(`parent_comment_id`, `news_id`, `author_id`, `parent_author_id`, `comment`)
                  VALUES ('{$parent_comment_id}', '{$news_id}', '{$_SESSION['id_lid']}', '{$parent_author_id}', '{$comment}')", true);
}

/**
 * @param $news_id
 * @param string $limit
 * @return array
 */
function getComments($news_id, $limit = '')
{
    $comments = getData(dbQuery("SELECT c.*, l.fio, l.familya, l.name, l.image_name as image FROM comments as c LEFT JOIN leaders as l ON c.author_id = l.id_lid WHERE c.news_id = {$news_id} AND c.checked != 2 ORDER BY c.id DESC". $limit));


    foreach ($comments as $key => $value){
        $comments[$key]['pubdate'] = timeComments(strtotime($value['pubdate']));
    }

//view($comments);
//    view(timeComments(time()));
    array_pop($comments);
    return $comments;
}

/**
 * @param $news_id
 * @return array
 */
function getCountComments($news_id)
{
    $comments_count = getData(dbQuery("SELECT COUNT(*) as comments_count FROM comments WHERE news_id = {$news_id}"));

    array_pop($comments_count);
    return $comments_count;
}
