<?php $data['title'] = 'Ошибка сервера'; ?>
<?php $data['css'][] = 'index/css/errors/index/style.css'; ?>
<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>
    <div id="content-main">
        <div class="container-fluid">
            <div class="col-xs-9">
                <p class="first_title">Добро пожаловать на «страницу 500»</p>
                <p class="second_title">При обработке запроса произошла ошибка на сервере</p>
                <p class="reason">Попробуйте повторить ваши действия снова</p>
                <p class="links server">Или перейдите на одну из страниц</p>
                <a class="left_link" href="/">На главную</a>
                <a class="right_link" href="/index/about">О проекте</a>
            </div>
            <div class="col-xs-3">
                <span class="image_error server"></span>
            </div>
        </div>
    </div>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>
