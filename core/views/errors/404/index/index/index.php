<?php $data['css'][] = 'css/errors/style.css'; ?>
<?php include CORE_DIR . '/core/views/layouts/header/index/index/index.php'; ?>
    <div id="content-main">
        <div class="container-fluid">
            <div class="col-xs-9">
                <p class="first_title">Добро пожаловать на «страницу 404»</p>
                <p class="second_title">К сожалению введенный вами адрес не доступен</p>
                <p class="reason">Скорее всего, это случилось по одной из следующих причин: <br>страница переехала, страницы больше нет, вы ошиблись
                    <br>в написании адреса или вам просто нравится изучать 404 страницы</p>
                <p class="links">Чтобы найти нужную страницу перейдите на главную или на страницу о проекте</p>
                <a class="left_link" href="/">На главную</a>
                <a class="right_link" href="/about">О проекте</a>
            </div>
            <div class="col-xs-3">
                <span class="image_error not_found"></span>
            </div>
        </div>
    </div>
<?php include CORE_DIR . '/core/views/layouts/footer/index/index/index.php' ?>
