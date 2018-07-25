<?php
$db = mysql_connect('localhost', 'kakuchat_suppor1k_vtemp', 'G3xx*yWq');
mysql_select_db('kakuchat_suppor1k_vtemp');

mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER SET 'utf8'");
mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");
session_start();