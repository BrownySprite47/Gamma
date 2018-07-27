<?php
/**
 * Page /login
 */
require_once 'lib/SocialAuther/autoload.php';
require_once 'config.inc.php';

if (!isset($_SESSION['redirect'])) {
    if (isset($_GET['recommend'])) {
        $_SESSION['redirect'] = $_GET['recommend'];
    }
}

$adapterConfigs = array(
    'vk' => array(
        'client_id'     => '6233715',
        'client_secret' => 'wBX2toD49ZkbHI5wXgJH',
        'redirect_uri'  => 'http://kakuchat.h1n.ru/auth/?provider=vk',
    ),
    'odnoklassniki' => array(
        'client_id'     => '1258439680',
        'client_secret' => 'CE103DF846BACA78A54811C1',
        'redirect_uri'  => 'http://kakuchat.h1n.ru/auth?provider=odnoklassniki',
        'public_key'    => 'CBAFEDAMEBABABABA'
    ),
    'mailru' => array(
        'client_id'     => '758188',
        'client_secret' => '37f339d324ccbe2c48448bc039d0429d',
        'redirect_uri'  => 'http://kakuchat.h1n.ru/auth/?provider=mailru',
    ),
    'yandex' => array(
        'client_id'     => '3272d2f091804fbabb89c007cd0f412b',
        'client_secret' => '6ae003cf124c438889ff93fc404226c3',
        'redirect_uri'  => 'http://kakuchat.h1n.ru/auth/?provider=yandex',
    ),
    'google' => array(
        'client_id'     => '529306401514-h62351b4kai0m3vsdumsmcq1cc4056j9.apps.googleusercontent.com',
        'client_secret' => 'sCSXPqY0ye3PHLIGsSsAVuHG',
        'redirect_uri'  => 'http://kakuchat.h1n.ru/auth?provider=google',
    ),
    'facebook' => array(
        'client_id'     => '291924507965005',
        'client_secret' => 'd35c45551b6c96ffe07570175b720fd0',
        'redirect_uri'  => 'http://kakuchat.h1n.ru/auth/?provider=facebook',
    )
);

$adapters = array();
foreach ($adapterConfigs as $adapter => $settings) {
    $class = 'SocialAuther\Adapter\\' . ucfirst($adapter);
    $adapters[$adapter] = new $class($settings);
}

if (isset($_GET['provider']) && array_key_exists($_GET['provider'], $adapters) && !isset($_SESSION['login'])) {
    $auther = new SocialAuther\SocialAuther($adapters[$_GET['provider']]);

    if ($auther->authenticate()) {
        $qu = "SELECT *  FROM users WHERE {$auther->getProvider()} = '{$auther->getSocialId()}' LIMIT 1";

        $result = mysql_query($qu);
        $record = mysql_fetch_array($result);

        $name_full  = $auther->getName();
        $pieces_name = explode(" ", $name_full);

        foreach ($pieces_name as $key => $value) {
            if ($value != '') {
                $pieces_name_actual[] = $value;
            }
        }

        $qu_1 = "SELECT * FROM leaders WHERE familya = '{$pieces_name_actual[0]}' AND name = '{$pieces_name_actual[1]}' AND user_id='0' LIMIT 1";
        $result_fio1 = mysql_query($qu_1);
        $result_fio_1 = mysql_fetch_assoc($result_fio1);

        if ($result_fio_1) {
            $_SESSION['fio_1'] = $result_fio_1['fio'];
            $_SESSION['id_lid_1'] = $result_fio_1['id_lid'];
            $_SESSION['image_name'] = $result_fio_1['image_name'];
        }


        $qu_1 = "SELECT * FROM leaders WHERE familya = '{$pieces_name_actual[1]}' AND name = '{$pieces_name_actual[0]}' AND user_id='0' LIMIT 1";
        $result_fio2 = mysql_query($qu_1);
        $result_fio_2 = mysql_fetch_assoc($result_fio2);

        if ($result_fio_2) {
            $_SESSION['fio_1'] = $result_fio_2['fio'];
            $_SESSION['id_lid_1'] = $result_fio_2['id_lid'];
            $_SESSION['image_name'] = $result_fio_2['image_name'];
        }

        $qu_1 = "SELECT * FROM leaders WHERE familya = '{$pieces_name_actual[1]}' AND name = '{$pieces_name_actual[0]}' AND user_id='0' LIMIT 1";
        $result_fio2 = mysql_query($qu_1);
        $result_fio_2 = mysql_fetch_assoc($result_fio2);

        if ($result_fio_2) {
            $_SESSION['fio_1'] = $result_fio_2['fio'];
            $_SESSION['id_lid_1'] = $result_fio_2['id_lid'];
            $_SESSION['image_name'] = $result_fio_2['image_name'];
        }

        $qu_1 = "SELECT * FROM leaders WHERE familya = '{$pieces_name_actual[1]}' AND name = '{$pieces_name_actual[0]}' AND user_id='0' LIMIT 1";
        $result_fio2 = mysql_query($qu_1);
        $result_fio_2 = mysql_fetch_assoc($result_fio2);

        if ($result_fio_2) {
            $_SESSION['fio_1'] = $result_fio_2['fio'];
            $_SESSION['id_lid_1'] = $result_fio_2['id_lid'];
            $_SESSION['image_name'] = $result_fio_2['image_name'];
        }
        if (!$record) {
            $values = array(
                $auther->getProvider(),
                $auther->getSocialId(),
                $auther->getName(),
                $auther->getEmail(),
                $auther->getSocialPage(),
                $auther->getSex(),
                date('Y-m-d', strtotime($auther->getBirthday())),
                $auther->getAvatar()
            );
            $query = "INSERT INTO users ({$auther->getProvider()}, avatar, name, page) VALUES ('{$auther->getSocialId()}', '{$auther->getAvatar()}', '{$auther->getName()}', '{$auther->getSocialPage()}')";

            $result = mysql_query($query);
            $name_full  = $auther->getName();
            $pieces_name = explode(" ", $name_full);

            foreach ($pieces_name as $key => $value) {
                if ($value != '') {
                    $pieces_name_actual_1[] = $value;
                }
            }
            $result1 = mysql_query("SELECT *  FROM users WHERE {$auther->getProvider()} = '{$auther->getSocialId()}' LIMIT 1");
            $record1 = mysql_fetch_array($result1);
            $query2 = "INSERT INTO leaders (user_id, fio, familya, name, image_name, social, email) VALUES ('".$record1['id']."', '{$auther->getName()}', '{$pieces_name_actual_1[1]}', '{$pieces_name_actual_1[0]}', '{$auther->getAvatar()}', '{$auther->getSocialPage()}', '{$auther->getEmail()}')";
            $result2 = mysql_query($query2);
            $_SESSION['id'] = $record1['id'];
            $_SESSION['role'] = $record1['role'];
            $_SESSION['new'] = 'true';
            $status1 = mysql_query("SELECT status, id_lid  FROM leaders WHERE user_id = '{$_SESSION['id']}' LIMIT 1");
            $status1 = mysql_fetch_array($status1);
            $_SESSION['status'] = $status1['status'];
            $_SESSION['id_lid'] = $status1['id_lid'];
            // userLogs($status1['id_lid'], '3');
            $date = date("Y-m-d");
            $res = mysql_query("SELECT id FROM logs_user WHERE event = '3' AND user = '".$_SESSION['id_lid']."' LIMIT 1");
            $res1 = mysql_fetch_array($res);
            if (!isset($res['id'])) {
                mysql_query("INSERT INTO logs_user (user, event, create_date) VALUES ('".$_SESSION['id_lid']."', '3', '".$date."')");
            }
        } else {
            $userFromDb = new stdClass();
            $userFromDb->provider   = $record['provider'];
            $userFromDb->socialId   = $record['social_id'];
            $userFromDb->name       = $record['name'];
            $userFromDb->email      = $record['email'];
            $userFromDb->socialPage = $record['social_page'];
            $userFromDb->sex        = $record['sex'];
            $userFromDb->birthday   = date('m.d.Y', strtotime($record['birthday']));
            $userFromDb->avatar     = $record['avatar'];
            $userFromDb->page     = $record['page'];
            $_SESSION['id'] = $record['id'];
            $_SESSION['role'] = $record['role'];
            $status1 = mysql_query("SELECT status, id_lid FROM leaders WHERE user_id = '{$_SESSION['id']}' LIMIT 1");
            $status1 = mysql_fetch_array($status1);
            $_SESSION['status'] = $status1['status'];
            $_SESSION['id_lid'] = $status1['id_lid'];
            $_SESSION['page'] = $record['page'];
        }

        $user = new stdClass();
        $user->provider   = $auther->getProvider();
        $user->socialId   = $auther->getSocialId();
        $user->name       = $auther->getName();
        $user->email      = $auther->getEmail();
        $user->socialPage = $auther->getSocialPage();
        $user->sex        = $auther->getSex();
        $user->birthday   = $auther->getBirthday();
        $user->avatar     = $auther->getAvatar();

        $_SESSION['login'] = $user->name;
        $_SESSION['avatar'] = $user->avatar;
        $_SESSION['page'] = $user->socialPage;

        if ($_SESSION['role'] == 'user') {
            if (isset($_SESSION['redirect'])) {
                header("location: /leaders/view?id=".$_SESSION['redirect']);
            } else {
                header("location: /user/");
            }
        } else {
            header("location: /");
        }
    }
}

if (isset($_GET['provider']) && array_key_exists($_GET['provider'], $adapters) && isset($_SESSION['login'])) {
    $auther1 = new SocialAuther\SocialAuther($adapters[$_GET['provider']]);

    if ($auther1->authenticate()) {
        $query = "UPDATE users SET {$auther1->getProvider()} = '{$auther1->getSocialId()}' WHERE id = '{$_SESSION['id']}'";
        $result = mysql_query($query);
    }
    if ($_SESSION['role'] == 'user') {
        if (isset($_SESSION['redirect'])) {
            header("location: /leaders/view?id=".$_SESSION['redirect']."&recom=true");
        } else {
            header("location: /user/");
        }
    } else {
        header("location: /");
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <script src="/assets/bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/css/registration.css">
    <?php if (ANALYTICS): ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-105077093-1', 'auto');
            ga('send', 'pageview');

        </script>
    <?php endif; ?>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <!-- <img src="images/xsbs_logo.png" alt="Как учат"> -->
                <p>Как учат</p>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">Назад</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3 class="success_reg">Вход</h3>
            <div class="panel panel-login">
                <div class="panel-body" style="text-align: center; padding: 80px;">
                    <?php if (isset($_SESSION['user'])): ?>
                        <?php header("location: /"); ?>
                    <?php elseif (!isset($_GET['code']) && !isset($_SESSION['user'])): ?>
                        <?php foreach ($adapters as $title => $adapter): ?>
                            <?php if (ucfirst($title) == 'Vk'):?>
                            <a href="<?=$adapter->getAuthUrl()?>" style="padding: 20px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/Vkontakte.png') no-repeat;"></a>
                        <?php else:?>
                            <a href="<?=$adapter->getAuthUrl()?>" style="padding: 20px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/<?=ucfirst($title)?>.png') no-repeat;"></a>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>