<?php

function index()
{
    $id_lid = getData(dbQuery("SELECT status, email, telephone, social FROM leaders WHERE id_lid = '".$_POST['data_doubles']."'"));
    if ($id_lid[0]['status'] == 0) {
        $id_lid[0]['status'] = 'Зарег';
    }
    if ($id_lid[0]['status'] == 2) {
        $id_lid[0]['status'] = 'ЛИО-';
    }
    if ($id_lid[0]['status'] == 3) {
        $id_lid[0]['status'] = 'ЛИО';
    }
    if (isset($id_lid[0])) {
        echo '<p style="margin-top: 20px;"><span>Статус: </span>'. $id_lid[0]['status'] .'</p>
        <p><span>Карточка лидера: </span> <a  href="/leaders/view?id='. $_POST['data_doubles'] .'">Ссылка</a></p>
        <p><span>Email: </span>'. $id_lid[0]['email'] .'</p>
        <p><span>Телефон: </span>'. $id_lid[0]['telephone'] .'</p>
        <p><span>Соцсеть: </span> <a target="_blank" href="'. $id_lid[0]['social'] .'">Ссылка</a></p>';
    }

    setStatusAndAccessAdminOnline($_POST['data_doubles']);
    setStatusAndAccessUserOnline($_SESSION['id_lid']);
}
