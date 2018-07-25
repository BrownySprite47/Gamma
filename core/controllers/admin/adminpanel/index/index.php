<?php

function index(){
	if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
	    $data['adminpanel_link_admin'] = '';

        $data['css'][] = 'admin/css/common/style.css';
	    $data['js'][] = 'admin/js/ajax/script.js';

	    $data = [];
	    renderView('admin/adminpanel/index/index/index', $data);
    }else{
        header('Location: /');
    }
}