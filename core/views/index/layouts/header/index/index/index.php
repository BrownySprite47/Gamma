    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="/assets/libs/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/libs/bootstrap/bootstrap-select.css">
        <link rel="stylesheet" href="/assets/libs/bootstrap/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="/assets/index/css/common/index/style.css">
        <link rel="stylesheet" href="/assets/index/css/common/index/media.css">

        <?php if (isset($data['css'])): ?>
            <?php foreach ($data['css'] as $css): ?>
                <link rel="stylesheet" href="/assets/<?=$css?>">
            <?php endforeach; ?>
        <?php endif; ?>
        <script src="/assets/libs/jquery/jquery-3.2.1.min.js"></script>
        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/assets/libs/jquery/jquery.validate.js"></script>
        <title><?= $data['title'] ?></title>
    </head>
    <body>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
        <div id="header_sidebar" class="header_sidebar hidden-xs">
            <ul class="nav">
                <li class="logo_cl logo"><a href="/index/news"><span class="logo_left"></span></a></li>
                <li class="logo_cl <?= isset($data['user_logo']) ? 'active_menu_sidebar' : '' ?> user_logo"><a href="/user"><img src="/assets/images/user.svg"><span></span></a></li>
                <li class="logo_cl <?= isset($data['recomendations']) ? 'active_menu_sidebar' : '' ?> logo_recomendations desktop"><a href="/user/recommends"><img src="/assets/images/recomendations.svg"><span></span></a></li>
                <li class="logo_cl <?= isset($data['change_experience']) ? 'active_menu_sidebar' : '' ?> logo_change_experience"><a href="/user/tags"><img src="/assets/images/change_experience.svg"><span></span></a></li>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
        <div id="header_sidebar" class="header_sidebar hidden-xs">
            <ul class="nav">
                <li class="logo"><a href="/index/news"><span class="logo_left"></span></a></li>
                <li class="logo_cl <?= isset($data['leaders_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_leaders_link_admin"><a href="/admin/leaders"><img src="/assets/images/change_experience.svg"><span></span></a></li>
                <li class="logo_cl admin_logo <?= isset($data['projects_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_projects_link_admin"><a href="/admin/projects"><img src="/assets/images/recomendations.svg"><span></span></a></li>
                <li class="logo_cl admin_logo <?= isset($data['recommend_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_recommend_link_admin"><a href="/admin/recommends"><img src="/assets/images/recomendations.svg"><span></span></a></li>
                <li class="logo_cl <?= isset($data['user_doubles_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_doubles_link_admin"><a href="/admin/doubles"><img src="/assets/images/user.svg"><span></span></a></li>
                <li class="logo_cl <?= isset($data['tags_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_tags_link_admin"><a href="/admin/tags"><img src="/assets/images/change_experience.svg"><span></span></a></li>
                <li class="logo_cl <?= isset($data['news_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_news_link_admin"><a href="/admin/news"><img src="/assets/images/user.svg"><span></span></a></li>
                <li class="logo_cl <?= isset($data['statistics_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_statistics_link_admin"><a href="/admin/statistics"><img src="/assets/images/user.svg"><span></span></a></li>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (!isset($_SESSION['role'])): ?>
        <div class="header_sidebar hidden-xs" style="height: 80px;">
            <ul class="nav">
                <li class="logo" style="height: 80px"><a href="/index/news"><span class="logo_left" style="border-bottom: 1px solid #e7e7e7;"></span></a></li>
            </ul>
        </div>
    <?php endif; ?>
    <nav class="navbar navbar-default header_nav_top navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div>
                <ul class="mobile_links_menu visible-xs">
                    <li class="logo_cl logo"><a href="/index/news"><span class="logo_left"></span></a></li>
                    <li class="dropdown bell visible-xs">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><img class="bell" src="/assets/images/bell.svg" alt="bell"></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                            <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                            <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                            <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                            <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="menu_links <?= isset($data['leaders_link']) ? 'active_menu' : '' ?>"><a href="/index/leaders">Лидеры</a></li>
                    <li class="menu_links <?= isset($data['projects_link']) ? 'active_menu' : '' ?>"><a href="/index/projects">Проекты</a></li>
                    <li class="menu_links <?= isset($data['news_link']) ? 'active_menu' : '' ?>"><a href="/index/news">Новости</a></li>
                </ul>
                <div id="header_sidebar" class="header_sidebar visible-xs">
                    <ul class="nav">
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
                            <li class="logo_cl <?= isset($data['user_logo']) ? 'active_menu_sidebar' : '' ?> user_logo">
                                <a href="/user"><img src="/assets/images/user-circle_blue.svg"><br><span>Профиль</span></a>
                            </li>
                            <li class="logo_cl <?= isset($data['recomendations']) ? 'active_menu_sidebar' : '' ?> logo_recomendations">
                                <a href="/user/recommends"><img src="/assets/images/share_blue.svg"><br><span>Рекомендации</span></a>
                            </li>
                            <li class="logo_cl <?= isset($data['change_experience']) ? 'active_menu_sidebar' : '' ?> logo_change_experience">
                                <a href="/user/tags"><img src="/assets/images/change_experience_blue.svg"><br><span>Обмен опытом</span></a>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <li class="col-xs-6 logo_cl <?= isset($data['leaders_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_leaders_link_admin">
                                <a href="/admin/leaders"><img src="/assets/images/change_experience.svg"><span>Лидеры</span></a>
                            </li>
                            <li class="col-xs-6 logo_cl admin_logo <?= isset($data['projects_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_projects_link_admin">
                                <a href="/admin/projects"><img src="/assets/images/recomendations.svg"><span>Проекты</span></a>
                            </li>
                            <li class="col-xs-6 logo_cl admin_logo <?= isset($data['recommend_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_recommend_link_admin">
                                <a href="/admin/recommends"><img src="/assets/images/recomendations.svg"><span>Рекомендации</span></a>
                            </li>
                            <li class="col-xs-6 logo_cl <?= isset($data['user_doubles_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_doubles_link_admin">
                                <a href="/admin/doubles"><img src="/assets/images/user.svg"><span>Привязки</span></a>
                            </li>
                            <li class="col-xs-6 logo_cl <?= isset($data['tags_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_tags_link_admin">
                                <a href="/admin/tags"><img src="/assets/images/change_experience.svg"><span>Теги</span></a>
                            </li>
                            <li class="col-xs-6 logo_cl <?= isset($data['news_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_news_link_admin">
                                <a href="/admin/news"><img src="/assets/images/user.svg"><span>Новости</span></a>
                            </li>
                            <li class="col-xs-6 logo_cl <?= isset($data['statistics_link_admin']) ? 'active_menu_sidebar' : '' ?> logo_statistics_link_admin">
                                <a href="/admin/statistics"><img src="/assets/images/user.svg"><span>Статистика</span></a>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['role'])): ?>
                            <li class="logo_img_li exit_mobile"><a href="/index/logout" class="dropdown-toggle"><span>Выход</span><img src="/assets/images/exit.svg"></a></li>
                        <?php else: ?>
                            <li class="logo_img_li"><a href="/index/login" class="dropdown-toggle"><span>Вход</span></a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['role'])): ?>
                        <?php if ($_SESSION['role'] == 'user'): ?>
                            <li class="dropdown bell hidden-xs">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><img class="bell" src="/assets/images/bell.svg" alt="bell"></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                                    <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                                    <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                                    <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                                    <li><a href="javascript:void(0);">Уведомление от администратора</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="dropdown exit_menu hidden-xs">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><span class="chevron-down"></span><span><?= $_SESSION['login'] ?></span></a>
                            <ul class="dropdown-menu exit">
                                <li><a href="/index/logout"><span>Выход</span><img src="/assets/images/exit.svg"></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
                        <li class="logo_img_li hidden-xs"><a href=""><span class="logo_img" style="background-image: url('<?= !empty($_SESSION['avatar']) ? $_SESSION['avatar'] : CORE_IMG_PATH . 'img_not_found.png' ?>');"></span></a></li>
                    <?php else: ?>
                        <li class="logo_img_li hidden-xs"><a href=""><span class="logo_img admin"></span></a></li>
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--   -->
    <div id="page-preloader"><span class="spinner"></span></div>

