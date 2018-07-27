<?php
(isset($_POST['id_lid'])       ? $id_lid = checkChars($_POST['id_lid'])             : $id_lid = '');
(isset($_POST['familya'])      ? $familya = checkChars($_POST['familya'])           : $familya = '');
(isset($_POST['name'])         ? $name = checkChars($_POST['name'])                 : $name = '');
(isset($_POST['otchestvo'])    ? $otchestvo = checkChars($_POST['otchestvo'])       : $otchestvo = '');
(isset($_POST['city'])         ? $city = checkChars($_POST['city'])                 : $city = '');
(isset($_POST['birthday'])     ? $birthday = checkChars($_POST['birthday'])         : $birthday = '');
(isset($_POST['social'])       ? $social = checkChars($_POST['social'])             : $social = '');
(isset($_POST['contact_info']) ? $contact_info = checkChars($_POST['contact_info']) : $contact_info = '');
(isset($_POST['telephone'])    ? $telephone = checkChars($_POST['telephone'])       : $telephone = '');
(isset($_POST['email'])        ? $email = checkChars($_POST['email'])               : $email = '');
(isset($_POST['video'])        ? $video = checkChars($_POST['video'])               : $video = '');


$fio = $familya." ".$name." ".$otchestvo;
