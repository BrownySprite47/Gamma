<?php include CORE_DIR . '/core/views/layouts/header/index/index/index.php'; ?>
    <div id="content-main">
        <div class="wrap_admin_links">
            <div class="col-xs-3 back_to_profile">
                <a href="javascript:history.back()"><img src="/assets/images/arrow_blue.svg" alt=""><span>Вернуться назад</span></a>
            </div>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <div class="col-xs-6 admin_links">
                    <!--                    <a href="/projects/edit?id=--><?//= $_GET['id'] ?><!--"><span>Редактировать</span></a>-->
                </div>
                <div class="col-xs-2 admin_links">
                    <!--                        <a href="javascript:void(0);"><span>Удалить</span></a>-->
                </div>
            <?php endif; ?>
        </div>
        <form method="post" enctype="multipart/form-data" >
            <div class="col-xs-3">
                <div id="preview">
                    <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                    <input style="display: none" id="image_name" type="text" name="image_name" value=""/>
                </div>
                <p class="notice_load">Загрузите изображение для проекта:</p>
                <label for="user_picture" class="file_upload">
                    <span class="load_file">Выбрать файл</span>
                    <mark id="mark_img">файл не выбран</mark>
                    <input required id="user_picture" type="file" name="image_name" onchange="upload('img', 'user_picture', 'progressbar', 'preview');"/>
                </label>
                <progress id="progressbar" value="0" max="100" style="display: none;"></progress>
            </div>
            <div class="col-xs-7 info_box">
                <div class="wrapper profile">
                    <div class="info_box_title">
                        <span>Описание проекта</span>
                    </div>
                    <div class="col-xs-12 block_indent">
                        <label>Название проекта*</label>
                        <input required placeholder="Полное название проекта" type="text" class="form-control" name="project_title">
                    </div>
                    <div class="col-xs-6 block_indent">
                        <label>Краткое название</label>
                        <input placeholder="Используется на карте" type="text" class="form-control" name="short_title">
                    </div>
                    <div class="col-xs-6 block_indent">
                        <label>Сайт*</label>
                        <input required placeholder="Сайт или группа в соц. сетях" type="text" class="form-control valid_url" name="social">
                    </div>
                    <div class="col-xs-12 block_indent">
                        <label>Описание проекта</label>
                        <textarea placeholder="Краткая суть и инновационность проекта" rows="4" name="project_description" class="form-control"></textarea>
                    </div>
                    <div class="col-xs-12 block_indent">
                        <label>Метапредметная направленность проекта</label><br>
                        <?php foreach ($data['localizations']['metapredmets'] as $key => $value) : ?>
                            <div class="col-xs-4 wrap_metapredmets">
                                <div class="metapredmets">
                                    <span class="check_img_note_metapredmet"></span>
                                    <label for="<?= $key ?>" class="metapredmet_checkbox">
                                        <img src="/assets/images/<?= $key ?>_metapredmets.svg" alt="">
                                        <span class=""><?= $value ?></span>
                                        <input id="<?= $key ?>" type="checkbox" class="check_box" value="1" name="<?= $key ?>">
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-xs-12 block_indent">
                        <label>Предметная направленность проекта</label><br>
                        <?php foreach ($data['localizations']['predmets'] as $key => $value) : ?>
                            <div class="col-xs-6 wrap_predmets">
                                <div class="predmets">
                                    <span class="check_img_note_predmet"></span>
                                    <label for="<?= $key ?>" class="predmet_checkbox">
                                        <img src="/assets/images/<?= $key ?>_predmets.svg" alt="">
                                        <span class=""><?= $value ?></span>
                                        <input id="<?= $key ?>" type="checkbox" class="check_box" value="1" name="<?= $key ?>">
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-xs-12 block_indent">
                        <label class="full_width_checkbox_label">Конечные потребители* <span style="display: none" class="error_ages_field_project">Oбязательное поле</span></label><br>
                        <?php foreach ($data['localizations']['ages'] as $key => $value) : ?>
                            <div class="col-xs-2 wrap_ages">
                                <div class="ages">
                                    <span class="check_img_note_age"></span>
                                    <label for="<?= $key ?>" class="age_checkbox">
                                        <?= $value ?>
                                        <input id="<?= $key ?>" type="checkbox" class="check_box ages_field_project" value="1" name="<?= $key ?>">
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-xs-6 block_indent">
                        <label class="full_width_checkbox_label">Среда реализации* <span style="display: none" class="error_methods_field_project">Oбязательное поле</span></label><br>
                        <select id="method" data-live-search="true" class="selectpicker methods_field_project" name="methods">
                            <option value="all" class="title">Не выбрано</option>
                            <?php foreach ($data['localizations']['methods'] as $key => $value): ?>
                                <option value="<?= $key ?>"><?= $value ?></option>;
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xs-6 block_indent">
                        <label>Стадия проекта</label>
                        <select data-live-search="true" class="selectpicker" name="stage_of_project">
                            <option value="all" class="title">Не выбрано</option>
                            <?php foreach ($data['localizations']['stage_of_project'] as $key => $value): ?>
                                <option value="<?= $key ?>"><?= $value ?></option>;
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xs-12 block_indent">
                        <label class="full_width_checkbox_label">Уровень воздействия* <span style="display: none" class="error_levels_field_project">Oбязательное поле</span></label><br>
                        <?php foreach ($data['localizations']['levels'] as $key => $value) : ?>
                            <div class="col-xs-4 wrap_levels">
                                <div class="levels">
                                    <span class="check_img_note_levels"></span>
                                    <label for="<?= $key ?>" class="level_checkbox">
                                        <img src="/assets/images/<?= $key ?>_levels.svg" alt="levels">
                                        <span class=""><?= $value ?></span>
                                        <input value="1" id="<?= $key ?>" type="checkbox" class="check_box levels_field_project" name="<?= $key ?>">
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                     </div>
                </div>
                <div class="info_box">
                    <div class="wrapper profile">
                        <div class="info_box_title">
                            <span>Организация проекта</span>
                        </div>
                        <div class="col-xs-12 block_indent">
                            <label>Оператор/автор проекта*</label>
                            <input required placeholder="Наименование ЮЛ, ИП или нет фирмы" type="text" class="form-control" name="author">
                        </div>
                        <div class="col-xs-12 block_indent">
                            <label>Местоположение автора/головной компании*</label>
                            <input required placeholder="Город" type="text" class="form-control" name="author_location">
                        </div>
                        <div class="col-xs-12 block_indent">
                            <label>Год начала деятельности*</label>
                            <input maxlength="4" required placeholder="2018" type="text" class="form-control" name="start_year">
                        </div>
                        <div class="col-xs-6 block_indent organization">
                            <label>География оффлайн проекта</label>
                            <select data-live-search="true" class="selectpicker" name="geographys">
                                <option value="all" class="title">Не выбрано</option>
                                 <?php foreach ($data['localizations']['geographys'] as $key => $value): ?>
                                    <option value="<?= $value ?>"><?= $value ?></option>;
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="info_box">
                    <div class="wrapper">
                        <div class="info_box_title">
                            <span>Лидеры</span>
                        </div>
                        <div class="content_leader_main content_leader checkSizeLeader no_leaders_project no_leader_main">
                            <div class="col-xs-6">
                                <p>Нет добавленных лидеров</p>
                            </div>
                            <div class="col-xs-3">
                                <a class="add_leader" onclick="add_leader_block()" href="javascript:void(0)">Добавить лидера</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info_box">
                    <div class="wrapper">
                        <div class="info_box_title">
                            <span>Прикрепленные файлы</span>
                        </div>
                        <div class="content_file_main content_files_project checkSizeFile no_files_project no_file_main">
                            <div class="col-xs-6">
                                <p>Нет прикрепленных файлов</p>
                            </div>
                            <div class="col-xs-3">
                                <a class="add_file" onclick="add_file_block()" href="javascript:void(0)">Добавить файл</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper links_wrap">
                    <div class="col-xs-12 info_box_title">
                        <span>Ссылки на публикации</span>
                    </div>
                    <div class="content_link_main content_project_link checkSizeLink no_links_project no_link_main">
                        <div class="col-xs-6">
                            <p>Нет прикрепленных ссылок</p>
                        </div>
                        <div class="col-xs-3">
                            <a class="add_link" onclick="add_links_block()" href="javascript:void(0)">Добавить ссылку</a>
                        </div>
                    </div>
                </div>
                <div class="wrap_buttons">
                    <div class="col-xs-6 wrap_btn"><a href="javascript:void(0)"><input class="save_btn" type="submit" value="Сохранить все"></div>
                    <?php if($_SESSION['role'] == 'user'): ?>
                        <div class="col-xs-4 wrap_btn"><a class="back_btn" href="/user">Вернуться в профиль</a></div>
                    <?php else : ?>
                        <div class="col-xs-4 wrap_btn"><a class="back_btn" href="/user">Вернуться назад</a></div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
<?php include CORE_DIR . '/core/views/layouts/footer/index/index/index.php' ?>
