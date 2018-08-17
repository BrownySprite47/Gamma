<?php

visitors_stat();

if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
    status_setUser($_SESSION['id_lid']);
}
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    $_SESSION['access']['info'] = true;
    $_SESSION['access']['tags'] = true;
    $_SESSION['access']['proj'] = true;
    $_SESSION['access']['recom'] = true;
}
