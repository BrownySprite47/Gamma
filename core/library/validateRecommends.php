<?php
$_POST['id_lid']       = isset($_POST['id_lid'])       ? main_checkChars($_POST['id_lid'])       : '';
$_POST['familya']      = isset($_POST['familya'])      ? main_checkChars($_POST['familya'])      : '';
$_POST['name']         = isset($_POST['name'])         ? main_checkChars($_POST['name'])         : '';
$_POST['otchestvo']    = isset($_POST['otchestvo'])    ? main_checkChars($_POST['otchestvo'])    : '';
$_POST['birthday']     = isset($_POST['birthday'])     ? main_checkChars($_POST['birthday'])     : '';
$_POST['project']      = isset($_POST['project'])      ? main_checkChars($_POST['project'])      : '';
$_POST['city']         = isset($_POST['city'])         ? main_checkChars($_POST['city'])         : '';
$_POST['telephone']    = isset($_POST['telephone'])    ? main_checkChars($_POST['telephone'])    : '';
$_POST['contact_info'] = isset($_POST['contact_info']) ? main_checkChars($_POST['contact_info']) : '';
$_POST['email']        = isset($_POST['email'])        ? main_checkChars($_POST['email'])        : '';
$_POST['social']       = isset($_POST['social'])       ? main_checkChars($_POST['social'])       : '';
$_POST['reason']       = isset($_POST['reason'])       ? main_checkChars($_POST['reason'])       : '';
$_POST['image_name']   = isset($_POST['image_name'])   ? main_checkChars($_POST['image_name'])   : '';



$recommend = main_checkChars($_POST['id_lid']);
$familya = main_checkChars($_POST['familya']);
$name = main_checkChars($_POST['name']);
$otchestvo = main_checkChars($_POST['otchestvo']);
$birthday = main_checkChars($_POST['birthday']);
$project_name = main_checkChars($_POST['project']);
$city = main_checkChars($_POST['city']);
$telephone = main_checkChars($_POST['telephone']);
$contact_info = main_checkChars($_POST['contact_info']);
$email = main_checkChars($_POST['email']);
$social = main_checkChars($_POST['social']);
$reason = main_checkChars($_POST['reason']);
$image_name = main_checkChars($_POST['image_name']);
