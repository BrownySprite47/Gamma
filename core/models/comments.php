<?php

/**
 * @param $post
 * @return bool|int|mysqli_result|string
 */
function comments_add($post)
{
    if ($post['comment'] == '') {
        exit();
    }

    $comment = main_checkCharsDb($post['comment']);

    $parent_comment_id = ($post['parent_comment_id'] != '') ? main_checkChars($post['parent_comment_id']) : '';
    $news_id = ($post['news_id'] != '') ? main_checkChars($post['news_id']) : null;
    $parent_author_id = ($post['parent_author_id'] != '') ? main_checkChars($post['parent_author_id']) : '';

    return dbQuery("INSERT INTO `news_comments`(`parent_comment_id`, `news_id`, `author_id`, `parent_author_id`, `comment`)
                  VALUES ('{$parent_comment_id}', '{$news_id}', '{$_SESSION['id_lid']}', '{$parent_author_id}', '{$comment}')", true);
}

/**
 * @param $news_id
 * @param string $limit
 * @return array
 */
function comments_get($news_id, $limit = '')
{
    $comments = getData(dbQuery("SELECT c.*, l.fio, l.familya, l.name, l.image_name as image FROM news_comments as c LEFT JOIN leaders as l ON c.author_id = l.id_lid WHERE c.news_id = {$news_id} AND c.checked != 2 ORDER BY c.id DESC". $limit));

    foreach ($comments as $key => $value){
        $comments[$key]['pubdate'] = comments_timeComments(strtotime($value['pubdate']));
    }
    array_pop($comments);
    return $comments;
}

/**
 * @param $news_id
 * @return array
 */
function comments_countNews($news_id)
{
    $comments_count = getData(dbQuery("SELECT COUNT(*) as comments_count FROM news_comments WHERE news_id = {$news_id}"));

    array_pop($comments_count);
    return $comments_count;
}

/**
 * @param $post
 * @return bool|int|mysqli_result|string
 */
function comments_addToFile($post)
{
    if ($post['comment'] == '') {
        exit();
    }

    $comment = main_checkCharsDb($post['comment']);

    $parent_comment_id = ($post['parent_comment_id'] != '') ? main_checkChars($post['parent_comment_id']) : '';
    $file_id = ($post['news_id'] != '') ? main_checkChars($post['news_id']) : null;
    $parent_author_id = ($post['parent_author_id'] != '') ? main_checkChars($post['parent_author_id']) : '';

    return dbQuery("INSERT INTO `files_comments`(`parent_comment_id`, `file_id`, `author_id`, `parent_author_id`, `comment`)
                  VALUES ('{$parent_comment_id}', '{$file_id}', '{$_SESSION['id_lid']}', '{$parent_author_id}', '{$comment}')", true);
}


/**
 * @param $file_id
 * @param string $limit
 * @return array
 */
function comments_getToFiles($file_id, $limit = '')
{
    $comments = getData(dbQuery("SELECT c.*, l.fio, l.familya, l.name, l.image_name as image FROM files_comments as c LEFT JOIN leaders as l ON c.author_id = l.id_lid WHERE c.file_id = {$file_id} AND c.checked != 2 ORDER BY c.id DESC". $limit));

    foreach ($comments as $key => $value){
        $comments[$key]['pubdate'] = comments_timeComments(strtotime($value['pubdate']));
    }

    array_pop($comments);

    return $comments;
}

/**
 * @param $post
 * @return bool|int|mysqli_result|string
 */
function comments_addToLink($post)
{
    if ($post['comment'] == '') {
        exit();
    }

    $comment = main_checkCharsDb($post['comment']);

    $parent_comment_id = ($post['parent_comment_id'] != '') ? main_checkChars($post['parent_comment_id']) : '';
    $link_id = ($post['news_id'] != '') ? main_checkChars($post['news_id']) : null;
    $parent_author_id = ($post['parent_author_id'] != '') ? main_checkChars($post['parent_author_id']) : '';

    return dbQuery("INSERT INTO `links_comments`(`parent_comment_id`, `link_id`, `author_id`, `parent_author_id`, `comment`)
                  VALUES ('{$parent_comment_id}', '{$link_id}', '{$_SESSION['id_lid']}', '{$parent_author_id}', '{$comment}')", true);
}


/**
 * @param $link_id
 * @param string $limit
 * @return array
 */
function comments_getToLink($link_id, $limit = '')
{
    $comments = getData(dbQuery("SELECT c.*, l.fio, l.familya, l.name, l.image_name as image FROM links_comments as c LEFT JOIN leaders as l ON c.author_id = l.id_lid WHERE c.link_id = {$link_id} AND c.checked != 2 ORDER BY c.id DESC". $limit));

    foreach ($comments as $key => $value){
        $comments[$key]['pubdate'] = comments_timeComments(strtotime($value['pubdate']));
    }

    array_pop($comments);

    return $comments;
}



/**
 * Receiving time elapsed since publication
 * @param $time
 * @return string
 */
function comments_timeComments($time) {
    $month_name = array(
        1  => 'января',
        2  => 'февраля',
        3  => 'марта',
        4  => 'апреля',
        5  => 'мая',
        6  => 'июня',
        7  => 'июля',
        8  => 'августа',
        9  => 'сентября',
        10 => 'октября',
        11 => 'ноября',
        12 => 'декабря'
    );

    $month = $month_name[date('n', $time)];
    $day = date('j', $time);
    $year = date('Y', $time);
    $hour = date('G', $time);
    $min = date('i', $time);
    $date = $day. ' '.$month. ' '.$year. ' г. в '.$hour. ':'.$min;
    $dif = time() - $time;

    if ($dif < 59) {
        return $dif. " сек.";
    } elseif($dif / 60 > 1 and $dif / 60 < 59) {
        return round($dif / 60). " мин.";
    } elseif($dif / 3600 > 1 and $dif / 3600 < 23) {
        return round($dif / 3600). " час.";
    }else{
        return $date;
    }
}
