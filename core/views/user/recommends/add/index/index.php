<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>

<div id="content-main">
    <div class="container-fluid">
        <form method="post" enctype="multipart/form-data" >
            <input type="hidden" name="id_lid" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">
            <div class="col-lg-3 mobile_wrap">
                <div id="preview_img">
                    <div id="preview">
                        <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                    </div>
                    <input style="display: none" id="image_name" type="text" name="image_name"/>
                    <label for="user_picture" class="file_upload">
                        <span class="load_file">Выбрать файл</span>
                        <mark id="mark_img">файл не выбран</mark>
                        <input id="user_picture" type="file" name="image_name" onchange="upload('img', 'user_picture', 'progressbar', 'preview');"/>
                    </label>
                    <progress id="progressbar" value="0" max="100" style="display: none;"></progress>
                </div>
            </div>
            <div class="col-lg-7 info_box">
                <div class="wrapper profile">
                    <div class="info_box_title">
                        <span>Информация профиля</span>
                    </div>
                    <div class="col-lg-4">
                        <label for="familya">Фамилия*</label>
                        <input type="text" required name="familya" class="form-control" id="familya">
                    </div>
                    <div class="col-lg-4">
                        <label for="name">Имя*</label>
                        <input type="text" required name="name" class="form-control" id="name">
                    </div>
                    <div class="col-lg-4">
                        <label for="otchestvo">Отчество</label>
                        <input type="text" name="otchestvo" class="form-control" id="otchestvo">
                    </div>
                    <div class="col-lg-12">
                        <label for="project">Проект*</label>
                        <input type="text" required name="project" class="form-control" id="project">
                    </div>
                    <div class="col-lg-12">
                        <label for="city">Город*</label>
                        <input required placeholder="Например: Москва" type="text" name="city" class="form-control" id="city">
                    </div>
                    <div class="col-lg-12">
                        <label for="birthday">Дата рождения*</label>
                        <div class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                            <input required placeholder="дд.мм.гггг" id="birthday" name="birthday" class="form-control" type="text" readonly>
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        </div>
                        <span class="not_public">— не отображается в публичном профиле</span>
                    </div>
                    <div class="col-lg-12">
                        <label for="social">Страница в соцсетях*</label>
                        <input required placeholder="http://" type="text" name="social" class="form-control valid_required valid_url" id="social">
                    </div>
                    <div class="col-lg-12">
                        <label for="telephone">Телефон</label>
                        <input placeholder="+7 xxx xxx xxxx" type="text" name="telephone" class="form-control" id="telephone">
                        <span class="not_public">— не отображается в публичном профиле</span>
                    </div>
                    <div class="col-lg-12">
                        <label for="email">E-mail</label>
                        <input placeholder="E-mail" type="text" name="email" class="form-control" id="email">
                        <span class="not_public">— не отображается в публичном профиле</span>
                    </div>
                    <div class="col-lg-12">
                        <label for="contact_info">Дополнительная контактная информация</label>
                        <input placeholder="Дополнительная контактная информация" type="text" name="contact_info" class="form-control" id="contact_info">
                    </div>
                    <div class="col-lg-12">
                        <p class="required_fields">Причина рекомендации*</p>
                        <textarea class="form-control reason_edit_rec" required name="reason"></textarea>
                    </div>
                    <div class="col-lg-12">
                        <p class="required_fields">Поля, отмеченные * - обязательны для заполнения</p>
                    </div>

                </div>

                <div class="wrap_buttons">
                    <div class="col-lg-6 wrap_btn"><a href="javascript:void(0)"><input class="save_btn" type="submit" value="Сохранить все"></a></div>
                    <div class="col-lg-4 wrap_btn"><a class="back_btn" href="/user/recommends">Вернуться в рекомендации</a></div>
                </div>
            </div>
            <div class="col-xs-2"></div>
        </form>
    </div>
    <div>
        <?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>

