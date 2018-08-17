<?php

/**
 * getting information about the news
 * @param string $checked
 * @param null $edit
 * @param null $limit
 * @return array
 */
function news_get($checked = '', $edit = null, $limit = null)
{
    if($checked != ''){
        $checked = ' WHERE news.checked = ' . $checked;
    }

    $news = getData(dbQuery("SELECT news.*, leaders.fio FROM news LEFT JOIN leaders ON news.author_id = leaders.id_lid " . main_checkChars($checked) . " ORDER BY news.id DESC ". $limit));

    array_pop($news);

    if ($edit) {
        foreach ($news as $key => $value) {
            $news[$key]['prev_content'] = nl2br(news_stringToLink($value['prev_content']));
            $news[$key]['content'] = nl2br(news_stringToLink($value['content']));
        }
    }

    return $news;
}

/**
 * getting information about the news
 * @param string $checked
 * @param null $edit
 * @param null $limit
 * @return array
 */
function news_getById($id, $checked = '', $edit = null, $limit = null)
{
    if($checked != ''){
        $checked = ' WHERE news.checked = ' . $checked . ' AND news.id = ' . $id;
    }

    $news = getData(dbQuery("SELECT news.*, leaders.fio FROM news LEFT JOIN leaders ON news.author_id = leaders.id_lid " . main_checkChars($checked) . " ORDER BY news.id DESC ". $limit));

    array_pop($news);

    if ($edit) {
        foreach ($news as $key => $value) {
            $news[$key]['prev_content'] = nl2br(news_stringToLink($value['prev_content']));
            $news[$key]['content'] = nl2br(news_stringToLink($value['content']));
        }
    }

    return $news;
}

/**
 * receive information about events on the news page
 * @return array
 */
function news_getEvents()
{
    $events = getData(dbQuery("SELECT * FROM logs_user WHERE event != '2' ORDER BY id DESC LIMIT 6"));

    array_pop($events);

    foreach ($events as $key => $event) {
        switch ($event["event"]) {
            case '3':
               $result = getData(dbQuery("SELECT fio, image_name FROM leaders WHERE id_lid = '".$event["user"]."' LIMIT 1"));
                $events[$key]['leader_fio']  = $result[0]['fio'];
                $events[$key]['image_name']  = $result[0]['image_name'];
                break;
            case '4':
                //$result = getData(dbQuery("SELECT fio FROM leaders WHERE id_lid = '".$event["user"]."' LIMIT 1"));
                //$events[$key]['leader_fio']  = $result[0]['fio'];
                break;
            case '5':
                $result = getData(dbQuery("SELECT fio, image_name FROM leaders WHERE id_lid = '".$event["user"]."' LIMIT 1"));
                $events[$key]['leader_fio']  = $result[0]['fio'];
                $events[$key]['image_name']  = $result[0]['image_name'];
                break;
            case '6':
                $result = getData(dbQuery("SELECT project_title, image_name FROM projects WHERE id_proj = '".$event["id_proj"]."' LIMIT 1"));
                $events[$key]['project_title']  = $result[0]['project_title'];
                $events[$key]['image_name']  = $result[0]['image_name'];
                break;
            case '10':
                $result = getData(dbQuery("SELECT * FROM leaders_uploads WHERE deleted IS NULL AND id = '".$event["id_file"]."' LIMIT 1"));
                $events[$key]['filename']  = $result[0]['filename'];
                $events[$key]['title']  = $result[0]['title'];
                $events[$key]['ext']  = $result[0]['ext'];
                $result = getData(dbQuery("SELECT fio, image_name FROM leaders WHERE id_lid = '".$event["user"]."' LIMIT 1"));
                $events[$key]['leader_fio']  = $result[0]['fio'];
                $events[$key]['image_name']  = $result[0]['image_name'];
                break;
            case '11':
                $result = getData(dbQuery("SELECT * FROM leaders_links WHERE id = '".$event["id_link"]."' LIMIT 1"));
                $events[$key]['link']  = $result[0]['link'];
                $events[$key]['title']  = $result[0]['title'];
                $result = getData(dbQuery("SELECT fio, image_name FROM leaders WHERE id_lid = '".$event["user"]."' LIMIT 1"));
                $events[$key]['leader_fio']  = $result[0]['fio'];
                $events[$key]['image_name']  = $result[0]['image_name'];
                break;
            case '14':
                $result = getData(dbQuery("SELECT project_title, image_name FROM projects WHERE id_proj = '".$event["id_proj"]."' LIMIT 1"));
                $events[$key]['project_title']  = $result[0]['project_title'];
                $events[$key]['image_name']  = $result[0]['image_name'];
                break;
            case '15':
                $result = getData(dbQuery("SELECT fio, image_name FROM leaders WHERE id_lid = '".$event["user"]."' LIMIT 1"));
                $events[$key]['leader_fio']  = $result[0]['fio'];
                $events[$key]['image_name']  = $result[0]['image_name'];
                break;
            case '16':
                $result = getData(dbQuery("SELECT * FROM projects_uploads WHERE deleted IS NULL AND id = '".$event["id_file"]."' LIMIT 1"));
                $events[$key]['filename']  = $result[0]['filename'];
                $events[$key]['title']  = $result[0]['title'];
                $events[$key]['ext']  = $result[0]['ext'];
                $result = getData(dbQuery("SELECT project_title, image_name FROM projects WHERE id_proj = '".$event["id_proj"]."' LIMIT 1"));
                $events[$key]['project_title']  = $result[0]['project_title'];
                $events[$key]['image_name']  = $result[0]['image_name'];
                break;
            case '17':
                $result = getData(dbQuery("SELECT * FROM projects_links WHERE id = '".$event["id_link"]."' LIMIT 1"));
                $events[$key]['link']  = $result[0]['link'];
                $events[$key]['title']  = $result[0]['title'];
                $result = getData(dbQuery("SELECT project_title, image_name FROM projects WHERE id_proj = '".$event["id_proj"]."' LIMIT 1"));
                $events[$key]['project_title']  = $result[0]['project_title'];
                $events[$key]['image_name']  = $result[0]['image_name'];
                break;
        }
    }

    return $events;
}

/**
 * text-to-link conversion
 * @param $text
 * @return null|string|string[]
 */
function news_stringToLink($text)
{
    $text = preg_replace("/(([a-z]+:\/\/)?(?:[a-zа-я0-9@:_-]+\.)+[a-zа-я0-9]{2,4}(?(2)|\/).*?)([-.,:]?(?:\\s|\$))/is", '<a target="_blank" href="$1">$1</a> ', $text);

    return $text;
}

/**
 * Getting the total number of leaders
 * @return array
 */
function news_getCountLeaders()
{
    $count = getData(dbQuery("SELECT COUNT(*) as count_lid FROM leaders WHERE (status = '2' OR status = '3')"));

    return $count;
}

/**
 * Gaining the total number of recommends
 * @return array
 */
function news_getCountRecommends()
{
    $count = getData(dbQuery("SELECT COUNT(*) as count_recom FROM recommend_leaders WHERE actual != '2' AND checked != '2'"));

    return $count;
}

/**
 * Fixing a page view of news
 * @param $id
 */
function news_addView($id){
    dbQuery("UPDATE `news` SET `views` = `views` + 1 WHERE id = '".main_checkChars($id)."'");
}
