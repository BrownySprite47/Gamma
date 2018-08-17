<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>
    <div id="content-main">
        <div class="container-fluid">
            <div class="wrap_admin_links">
                <div class="col-lg-3 back_to_profile">
                    <a href="javascript:history.back()"><img src="/assets/images/arrow_blue.svg" alt=""><span>Вернуться назад</span></a>
                </div>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <div class="col-xs-6 admin_links">
                        <!--                    <a href="/index/projects/edit?id=--><?//= $_GET['id']?><!--"><span>Редактировать</span></a>-->
                    </div>
                    <div class="col-xs-2 admin_links">
<!--                        <a href="javascript:void(0);"><span>Удалить</span></a>-->
                    </div>
                <?php endif; ?>
            </div>
<!--            <div class="list-group-item title_menu_admin"><h2>ДОБАВЛЕНИЕ ЛИДЕРА</h2></div>-->
            <form method="post" enctype="multipart/form-data" >
                <div class="col-xs-3">
                    <div id="preview">
                        <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                        <input style="display: none" id="image_name" type="text" name="image_name" value=""/>
                    </div>

                    <label for="user_picture" class="file_upload">
                        <span class="load_file">Выбрать файл</span>
                        <mark>файл не выбран</mark>
                        <input id="user_picture" type="file" name="image_name" onchange="upload('img', 'user_picture', 'progressbar', 'preview');"/>
                    </label>
                    <progress id="progressbar" value="0" max="100" style="display: none;"></progress>
                </div>
                <div class="col-xs-7 info_box">
                    <div class="wrapper profile">
                        <div class="info_box_title">
                            <span>Информация профиля</span>
                        </div>
                        <div class="col-xs-4">
                            <label for="familya">Фамилия*</label>
                            <span class="error_message">Необходимо заполнить</span>
                            <input type="text" required name="familya" class="form-control" id="familya">
                        </div>
                        <div class="col-xs-4">
                            <label for="name">Имя*</label>
                            <span class="error_message">Необходимо заполнить</span>
                            <input type="text" required name="name" class="form-control" id="name">
                        </div>
                        <div class="col-xs-4">
                            <label for="otchestvo">Отчество</label>
                            <input type="text" name="otchestvo" class="form-control" id="otchestvo">
                        </div>
                        <div class="col-xs-12">
                            <label for="city">Город*</label>
                            <span class="error_message">Необходимо заполнить</span>
                            <input required placeholder="Например: Москва" type="text" name="city" class="form-control" id="city">
                        </div>
                        <div class="col-xs-12">
                            <label for="birthday">Дата рождения*</label>
                            <span class="error_message">Необходимо заполнить</span>
                            <div class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                                <input required placeholder="дд.мм.гггг" id="birthday" name="birthday" class="form-control" type="text" readonly>
                                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <span class="not_public">— не отображается в публичном профиле</span>
                        </div>
                        <div class="col-xs-12">
                            <label for="social">Страница в соцсетях</label>
                            <input placeholder="http://" type="text" name="social" class="form-control valid_url" id="social">
                        </div>
                        <div class="col-xs-12">
                            <label for="telephone">Телефон</label>
                            <input placeholder="+7 xxx xxx xxxx" type="text" name="telephone" class="form-control" id="telephone">
                            <span class="not_public">— не отображается в публичном профиле</span>
                        </div>
                        <div class="col-xs-12">
                            <label for="email">E-mail</label>
                            <input placeholder="E-mail" type="text" name="email" class="form-control" id="email">
                            <span class="not_public">— не отображается в публичном профиле</span>
                        </div>
                        <div class="col-xs-12">
                            <label for="contact_info">Дополнительная контактная информация</label>
                            <input placeholder="Дополнительная контактная информация" type="text" name="contact_info" class="form-control" id="contact_info">
                        </div>
                        <div class="col-xs-12">
                            <p class="required_fields">Поля, отмеченные * - обязательны для заполнения</p>
                        </div>
                    </div>
                    <div class="wrapper files_wrap">
                        <div class="col-xs-12 info_box_title">
                            <span>Прикрепленные файлы</span>
                        </div>
                        <div class="content_file_main content_leader_file checkSizeFile no_files_user no_file_main">
                            <div class="col-xs-6">
                                <p>Нет прикрепленных файлов</p>
                            </div>
                            <div class="col-xs-3">
                                <a class="add_file" onclick="add_file_block()" href="javascript:void(0)">Добавить файл</a>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper files_wrap">
                        <div class="col-xs-12 info_box_title">
                            <span>Ссылки на публикации</span>
                        </div>
                        <div class="content_link_main content_leader_link checkSizeLink no_links_user no_link_main">
                            <div class="col-xs-6">
                                <p>Нет прикрепленных ссылок</p>
                            </div>
                            <div class="col-xs-3">
                                <a class="add_link" onclick="add_links_block()" href="javascript:void(0)">Добавить ссылку</a>
                            </div>
                        </div>
                    </div>
                    <div class="wrap_buttons">
                        <div class="col-xs-6 wrap_btn"><a href="javascript:void(0)"><input class="save_btn" type="submit" value="Сохранить все"></a></div>
                    </div>
                </div>
                <div class="col-xs-2"></div>
            </form>
        </div>
    <div>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>
