<?php
$_POST['id_lid']       = isset($_POST['id_lid'])       ? main_checkChars($_POST['id_lid'])       : '';
$_POST['familya']      = isset($_POST['familya'])      ? main_checkChars($_POST['familya'])      : '';
$_POST['name']         = isset($_POST['name'])         ? main_checkChars($_POST['name'])         : '';
$_POST['otchestvo']    = isset($_POST['otchestvo'])    ? main_checkChars($_POST['otchestvo'])    : '';
$_POST['city']         = isset($_POST['city'])         ? main_checkChars($_POST['city'])         : '';
$_POST['birthday']     = isset($_POST['birthday'])     ? main_checkChars($_POST['birthday'])     : '';
$_POST['social']       = isset($_POST['social'])       ? main_checkChars($_POST['social'])       : '';
$_POST['contact_info'] = isset($_POST['contact_info']) ? main_checkChars($_POST['contact_info']) : '';
$_POST['telephone']    = isset($_POST['telephone'])    ? main_checkChars($_POST['telephone'])    : '';
$_POST['email']        = isset($_POST['email'])        ? main_checkChars($_POST['email'])        : '';
$_POST['video']        = isset($_POST['video'])        ? main_checkChars($_POST['video'])        : '';


$fio = $_POST['familya']." ".$_POST['name']." ".$_POST['otchestvo'];
