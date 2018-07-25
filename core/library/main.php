<?php

function db_count($table, $where = '', $where2 = '') {

    if ($where == '') {
        $where = ' WHERE checked != "2" AND (status="3" OR status="2") ';
    }else{
        $where = $where.' AND checked != "2" AND (status="3" OR status="2") ';
    }

    if ($where2 != '') {
        $where = $where2;
    }
    $result = dbQuery('SELECT COUNT(1) FROM '.$table.$where);

    $count = mysqli_fetch_array($result);

    return $count[0];
}
function db_count_want_need($where) {
    $count = mysqli_fetch_array(dbQuery('SELECT COUNT(1) FROM leaders as l LEFT JOIN tags_leaders as tl ON l.id_lid = tl.id_lid WHERE '.$where));
    return $count[0];
}


function getUrnSegments() {
    $urn = (isset($_GET['urn'])) ? strtolower($_GET['urn']) : '';

    $urn = explode('?', $urn);  
    $segments = $urn[0];  
    $segment = substr($segments, -1);
    if ($segment == '/') {
        $segments = substr($segments, 0, -1);

    }
    return $segments;
}

function show404page() {
    header('HTTP/1.1 404 Not Found');
    renderView('errors/404/index/index/index');
}

function renderView($name, $data = []) {
    require_once CORE_DIR . '/core/views/' . $name . '.php';
}

function view($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
function getSaveData($data){
	$utext = trim($data);
	$utext = strip_tags($utext);
	$utext = htmlspecialchars($utext,ENT_QUOTES);
	$utext = stripslashes($utext);

    $link = dbConnect();
    return mysqli_real_escape_string($link, $utext);
}

function normal_size($size) {
    $kb = 1024;         // Kilobyte
    $mb = 1024 * $kb;   // Megabyte
    $gb = 1024 * $mb;   // Gigabyte
    $tb = 1024 * $gb;   // Terabyte

    if($size < $kb) {
        return $size." B";
    }
    else if($size < $mb) {
        return round($size/$kb,2)." Kb";
    }
    else if($size < $gb) {
        return round($size/$mb,2)." Mb";
    }
    else if($size < $tb) {
        return round($size/$gb,2)." Gb";
    }
    else {
        return round($size/$tb,2)." Tb";
    }
}
