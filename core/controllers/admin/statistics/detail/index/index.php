<?php

function index(){
	if(isset($_SESSION) && $_SESSION['role'] == 'admin'){
		$data['statistics_link_admin'] = '';

        $data['css'][] = 'admin/css/common/style.css';
	    $data['js'][] = 'admin/ajax_admin.js';

	    $data = [];
	    if (isset($_GET['type'])) {
	        $data = getDetailStatistics(checkChars($_GET['start']), checkChars($_GET['end']), checkChars($_GET['type']));        
	    }
	    
	    renderView('admin/statistics/detail_statistics', $data);
	}else{
        header('Location: /');
    }    
}
