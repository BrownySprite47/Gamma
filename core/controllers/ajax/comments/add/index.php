<?php

function index(){
    addCommentToProject($_POST);
    exit('success');
}

