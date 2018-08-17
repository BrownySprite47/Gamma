<?php

/**
 * set the current status of the user in accordance with the level of occupancy of the profile and recommendations
 * @param $id
 */
function status_setUser($id)
{
    if (isset($_SESSION['id']) && $_SESSION['role'] == 'user') {
        $user = status_getLeaders($id);

        $info = ($user['info'][0]['fio'] == '' || $user['info'][0]['city'] == '' || $user['info'][0]['birthday'] == '' || $user['info'][0]['social'] == '') ? false : true;
        $tags = ($user['tags'][0]["COUNT(*)"] == '0') ? false : true;
        $proj = ($user['proj'][0]["COUNT(*)"] == '0') ? false : true;
        $recom = ($user['recom'][0]["COUNT(*)"] < 2) ? false : true;

        $str = [];
        $str[] = ($info)  ? "status_info  = '1'" : "status_info  = '0'";
        $str[] = ($tags)  ? "status_tags  = '1'" : "status_tags  = '0'";
        $str[] = ($proj)  ? "status_proj  = '1'" : "status_proj  = '0'";
        $str[] = ($recom) ? "status_recom = '1'" : "status_recom = '0'";

        if ($recom && $info && $tags && $proj) {
            $str[] = "status = '3'";
        } elseif ($recom && $info && $proj) {
            $str[] = "status = '2'";
        } else {
            $str[] = "status = '0'";
        }

        $statuses = implode(",", $str);

        dbQuery("UPDATE leaders SET ".$statuses." WHERE id_lid = '".$id."'");

        status_updateProject($id, $info, $proj, $recom, $user, $tags);

        if ($_SESSION['role'] == 'user') {
            $status = getData(dbQuery("SELECT status_info, status_tags, status_proj, status_recom FROM leaders WHERE id_lid = '".$_SESSION['id_lid']."' LIMIT 1"));
            $recom = getData(dbQuery("SELECT COUNT(*) FROM recommend_leaders WHERE id_lid = '".$_SESSION['id_lid']."' AND checked != '2'"));

            $_SESSION['access']['info'] = ($status[0]['status_info'] == 1) ? true : false;
            $_SESSION['access']['tags'] = ($status[0]['status_tags'] == 1) ? true : false;
            $_SESSION['access']['proj'] = ($status[0]['status_proj'] == 1) ? true : false;
            $_SESSION['access']['recom'] = ($status[0]['status_recom'] == 1) ? true : false;
            $_SESSION['access']['num_recom'] = $recom[0]["COUNT(*)"];
        }
    }
}


/**
 * set the current status of the user in accordance with the level of occupancy of the profile and recommendations
 * @param $id
 */
function status_setAdmin($id)
{
    if (isset($_SESSION['id'])) {
        $user = status_getLeaders($id);

        $info = ($user['info'][0]['fio'] == '' || $user['info'][0]['city'] == '' || $user['info'][0]['birthday'] == '' || $user['info'][0]['social'] == '') ? false : true;
        $tags = ($user['tags'][0]["COUNT(*)"] == '0') ? false : true;
        $proj = ($user['proj'][0]["COUNT(*)"] == '0') ? false : true;
        $recom = ($user['recom'][0]["COUNT(*)"] < 2) ? false : true;

        $str = [];
        $str[] = ($info)  ? "status_info  = '1'" : "status_info  = '0'";
        $str[] = ($tags)  ? "status_tags  = '1'" : "status_tags  = '0'";
        $str[] = ($proj)  ? "status_proj  = '1'" : "status_proj  = '0'";
        $str[] = ($recom) ? "status_recom = '1'" : "status_recom = '0'";

        $statuses = implode(",", $str);
        dbQuery("UPDATE leaders SET ".$statuses." WHERE id_lid = '".$id."'");

        status_updateProject($id, $info, $proj, $recom, $user, $tags);
    }
}

/**
 * get user data for subsequent status setting
 * @param $id
 * @return mixed
 */
function status_getLeaders($id)
{
    $user['info'] = getData(dbQuery("SELECT user_id, fio, city, birthday, social FROM leaders WHERE id_lid = '".$id."' LIMIT 1"));
    $user['tags'] = getData(dbQuery("SELECT COUNT(*) FROM tags_leaders WHERE id_lid = '".$id."'"));
    $user['proj'] = getData(dbQuery("SELECT COUNT(*) FROM leader_project WHERE id_lid = '".$id."' AND checked != '2'"));
    $user['recom'] = getData(dbQuery("SELECT COUNT(*) FROM recommend_leaders WHERE id_lid = '".$id."' AND checked != '2'"));
    $user['projects_id'] = getData(dbQuery("SELECT id_proj FROM leader_project WHERE id_lid = '".$id."'"));

    return $user;
}

/**
 * Updating the status of projects in accordance with the current status of the user
 * @param $id
 * @param string $info
 * @param string $proj
 * @param string $recom
 * @param string $user
 * @param string $tags
 */
function status_updateProject($id, $info = '', $proj = '', $recom = '', $user = '', $tags = '')
{
    if ($info && $proj && $recom && $tags) {
        dbQuery("UPDATE leaders SET status = '3' WHERE id_lid = '".$id."'");
        foreach ($user['projects_id'] as $key => $value) {
            if ($value !='') {
                dbQuery("UPDATE projects SET status = '3' WHERE id_proj = '" . $value['id_proj'] . "' AND user_id = " . $id);
                if ($_SESSION['role'] == 'user') {
                    $_SESSION['status'] = '3';
                }
            }
        }
    } elseif ($recom && $info && $proj) {
        dbQuery("UPDATE leaders SET status = '2' WHERE id_lid = '".$id."'");
        foreach ($user['projects_id'] as $key => $value) {
            if ($value !='') {
                dbQuery("UPDATE projects SET status = '2' WHERE id_proj = '" . $value['id_proj'] . "' AND user_id = " . $id);
                if ($_SESSION['role'] == 'user') {
                    $_SESSION['status'] = '2';
                }
            }
        }
    } else {
        dbQuery("UPDATE leaders SET status = '0' WHERE id_lid = '".$id."'");
        foreach ($user['projects_id'] as $key => $value) {
            if ($value !='') {
                dbQuery("UPDATE projects SET status = '0' WHERE id_proj = '" . $value['id_proj'] . "' AND user_id = " . $id);
                if ($_SESSION['role'] == 'user') {
                    $_SESSION['status'] = '0';
                }
            }
        }
    }
}
