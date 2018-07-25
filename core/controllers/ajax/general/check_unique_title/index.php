<?php

function index(){
    if(isset($_GET['project_title']) && !empty($_GET['project_title'])){
        $myrow = mysqli_fetch_array(dbQuery("SELECT id_proj FROM projects WHERE project_title = '".checkChars($_GET['project_title'])."'"));
        if (!empty($myrow['id_proj'])) exit("project_title_exists");
    }
}