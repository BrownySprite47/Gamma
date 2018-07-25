<?php

function index(){
    if ($_SESSION['role'] == 'user') {
        userLogs($_SESSION['id_lid'], '1', '', '', '', '');
        exit('success');
    }
}