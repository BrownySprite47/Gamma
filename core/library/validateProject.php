<?php

$_POST['general_online']  = (isset($_POST['methods']) && $_POST['methods'] == 'general_online')  ? 1 : '';
$_POST['only_online']     = (isset($_POST['methods']) && $_POST['methods'] == 'only_online')     ? 1 : '';
$_POST['general_offline'] = (isset($_POST['methods']) && $_POST['methods'] == 'general_offline') ? 1 : '';
$_POST['totally_offline'] = (isset($_POST['methods']) && $_POST['methods'] == 'totally_offline') ? 1 : '';

$_POST['first_level']  = (isset($_POST['first_level'])  && $_POST['first_level']  == '1') ? 1 : '';
$_POST['second_level'] = (isset($_POST['second_level']) && $_POST['second_level'] == '1') ? 1 : '';
$_POST['third_level']  = (isset($_POST['third_level'])  && $_POST['third_level']  == '1') ? 1 : '';

$_POST['geographys'] = isset($_POST['geographys']) && $_POST['geographys'] != 'all' ? main_checkChars($_POST['geographys']) : '';

$_POST['business']   = isset($_POST['business'])   ? main_checkChars($_POST['business'])   : '';
$_POST['engineer']   = isset($_POST['engineer'])   ? main_checkChars($_POST['engineer'])   : '';
$_POST['eq']         = isset($_POST['eq'])         ? main_checkChars($_POST['eq'])         : '';
$_POST['it_prof']    = isset($_POST['it_prof'])    ? main_checkChars($_POST['it_prof'])    : '';
$_POST['personal']   = isset($_POST['personal'])   ? main_checkChars($_POST['personal'])   : '';
$_POST['proforient'] = isset($_POST['proforient']) ? main_checkChars($_POST['proforient']) : '';


$_POST['arts']       = isset($_POST['arts'])       ? main_checkChars($_POST['arts'])       : '';
$_POST['lingvistic'] = isset($_POST['lingvistic']) ? main_checkChars($_POST['lingvistic']) : '';
$_POST['pedagogy']   = isset($_POST['pedagogy'])   ? main_checkChars($_POST['pedagogy'])   : '';
$_POST['sport']      = isset($_POST['sport'])      ? main_checkChars($_POST['sport'])      : '';
$_POST['social']     = isset($_POST['social'])     ? main_checkChars($_POST['social'])     : '';
$_POST['techno']     = isset($_POST['techno'])     ? main_checkChars($_POST['techno'])     : '';
$_POST['naturall']   = isset($_POST['naturall'])   ? main_checkChars($_POST['naturall'])   : '';


$_POST['r_00_07']    = isset($_POST['r_00_07'])    ? main_checkChars($_POST['r_00_07'])    : '';
$_POST['r_12_15']    = isset($_POST['r_12_15'])    ? main_checkChars($_POST['r_12_15'])    : '';
$_POST['r_16_18']    = isset($_POST['r_16_18'])    ? main_checkChars($_POST['r_16_18'])    : '';
$_POST['r_19_25']    = isset($_POST['r_19_25'])    ? main_checkChars($_POST['r_19_25'])    : '';
$_POST['r_08_11']    = isset($_POST['r_08_11'])    ? main_checkChars($_POST['r_08_11'])    : '';
$_POST['r_all_life'] = isset($_POST['r_all_life']) ? main_checkChars($_POST['r_all_life']) : '';
$_POST['r_others']   = isset($_POST['r_others'])   ? main_checkChars($_POST['r_others'])   : '';
$_POST['r_parents']  = isset($_POST['r_parents'])  ? main_checkChars($_POST['r_parents'])  : '';
$_POST['r_teachers'] = isset($_POST['r_teachers']) ? main_checkChars($_POST['r_teachers']) : '';


$_POST['project_title']       = isset($_POST['project_title'])       ? main_checkChars($_POST['project_title'])       : '';
$_POST['short_title']         = isset($_POST['short_title'])         ? main_checkChars($_POST['short_title'])         : '';
$_POST['project_description'] = isset($_POST['project_description']) ? main_checkChars($_POST['project_description']) : '';
$_POST['site']                = isset($_POST['site'])                ? main_checkChars($_POST['site'])                : '';
$_POST['author']              = isset($_POST['author'])              ? main_checkChars($_POST['author'])              : '';
$_POST['author_location']     = isset($_POST['author_location'])     ? main_checkChars($_POST['author_location'])     : '';
$_POST['start_year']          = isset($_POST['start_year'])          ? main_checkChars($_POST['start_year'])          : '';
$_POST['id_lid']              = isset($_POST['id_lid'])              ? main_checkChars($_POST['id_lid'])              : '';

$_POST['stage_of_project'] = (isset($_POST['stage_of_project']) && $_POST['stage_of_project'] != 'all') ? main_checkChars($_POST['stage_of_project']) : '';
