<?php

function visitors_stat(){
    // Получаем IP-адрес посетителя и сохраняем текущую дату
    $visitor_ip = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d");

    if (isset($_SESSION['id'])) {
        if ($_SESSION['role'] == 'user') {
            $user = $_SESSION['id_lid'];
        }else{
             $user = '0';
        }
    }else{
        $user = '0';
    }
    if(!isset($_SESSION['role']) || $_SESSION['role'] == 'user'){
        // Узнаем, были ли посещения за сегодня
        $visit_id = getData(dbQuery("SELECT id FROM logs_user WHERE `create_date`='".$date."'"));
        // Если сегодня еще не было посещений
        if (!isset($visit_id[0]['id'])){
            // Очищаем таблицу ips
            dbQuery ("DELETE FROM `ips`");
            // Заносим в базу IP-адрес текущего посетителя
            dbQuery ("INSERT INTO `ips` SET `ip_address`='".$visitor_ip."'");
            // Заносим в базу дату посещения
            dbQuery ("INSERT INTO logs_user SET `create_date`='".$date."', event=2, user='".$user."'");
        }
        // Если посещения сегодня уже были
        else{
            // Проверяем, есть ли уже в базе IP-адрес, с которого происходит обращение
            $ip_id = getData(dbQuery ("SELECT `ip_id` FROM `ips` WHERE `ip_address`='".$visitor_ip."' AND user='".$user."'"));
            // Если сегодня такого IP-адреса еще не было
            if (!isset($ip_id[0]['ip_id'])){
                // Заносим в базу IP-адрес этого посетителя
                dbQuery ("INSERT INTO `ips` SET `ip_address`='".$visitor_ip."', `user`='".$user."'");
                // Добавляем в базу 
                dbQuery ("INSERT INTO logs_user SET `create_date`='".$date."', event=2, user='".$user."'");
            }
        }    
    }
}