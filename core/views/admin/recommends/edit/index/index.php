<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>
<div id="content-main">
    <div class="wrap_admin_links">
        <div class="col-lg-3 back_to_profile">
            <a href="javascript:history.back()"><img src="/assets/images/arrow_blue.svg" alt=""><span>Вернуться назад</span></a>
        </div>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <div class="col-xs-6 admin_links"></div>
            <div class="col-xs-2 admin_links">
                <a href="javascript:void(0);"><span>Удалить</span></a>
            </div>
        <?php endif; ?>
    </div>
    <form method="post" enctype="multipart/form-data" >
        <input type="text" style="display: none" name="id_proj" value="<?= $_GET['id'] ?>">
        <div class="col-lg-3 mobile_wrap">
            <div id="preview_img">
                <div id="preview">
                    <?php $pos = strripos($data['project'][0]['image_name'], 'http'); ?>
                    <?php if ($pos === false) : ?>
                        <?php if (!empty($data['project'][0]['image_name'])): ?>
                            <span class="image_name" style="background-image: url('<?= CORE_IMG_PATH . $data['project'][0]['image_name'] ?>')"></span>
                        <?php else: ?>
                            <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if (!empty($data['project'][0]['image_name'])): ?>
                            <span class="image_name" style="background-image: url('<?= $data['project'][0]['image_name'] ?>')"></span>
                        <?php else: ?>
                            <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                        <?php endif; ?>
                    <?php endif;?>
                </div>
                <input style="display: none" id="image_name" type="text" name="image_name" value="<?= $data['project'][0]['image_name'] ?>"/>
                <p class="notice_load">Загрузите изображение для проекта:</p>
                <label for="user_picture" class="file_upload">
                    <span class="load_file">Выбрать файл</span>
                    <mark id="mark_img">файл не выбран</mark>
                    <input required id="user_picture" type="file" name="image_name" onchange="upload('img', 'user_picture', 'progressbar', 'preview');"/>
                </label>
                <progress id="progressbar" value="0" max="100" style="display: none;"></progress>
            </div>
        </div>
        <div class="col-lg-7 info_box">
            <div class="wrapper profile">
                <div class="info_box_title">
                    <span>Описание проекта</span>
                </div>
                <div class="col-xs-12 block_indent">
                    <label>Название проекта*</label>
                    <input value="<?= $data['project'][0]['project_title'] ?>" required placeholder="Полное название проекта" type="text" class="form-control" name="project_title">
                </div>
                <div class="col-lg-6 block_indent">
                    <label>Краткое название</label>
                    <input value="<?= $data['project'][0]['short_title'] ?>" placeholder="Используется на карте" type="text" class="form-control" name="short_title">
                </div>
                <div class="col-lg-6 block_indent">
                    <label>Сайт*</label>
                    <input value="<?= $data['project'][0]['site'] ?>" required placeholder="Сайт или группа в соц. сетях" type="text" class="form-control valid_url" name="site">
                </div>
                <div class="col-xs-12 block_indent">
                    <label>Описание проекта</label>
                    <textarea placeholder="Краткая суть и инновационность проекта" rows="4" name="project_description" class="form-control"><?= $data['project'][0]['project_description'] ?></textarea>
                </div>
                <div class="col-xs-12 block_indent">
                    <label>Метапредметная направленность проекта</label><br>
                    <?php foreach ($data['localizations']['metapredmets'] as $key => $value) : ?>
                        <div class="col-lg-4 wrap_metapredmets">
                            <div class="metapredmets" <?= (isset($data['project'][0]["metapredmets"][$key])) ? 'style="opacity: 1; border: 2px solid rgb(62, 62, 162);"' : '' ?>>
                                <span <?= (isset($data['project'][0]["metapredmets"][$key])) ? 'style="opacity: 1;"' : '' ?> class="check_img_note_metapredmet"></span>
                                <label for="<?= $key ?>" class="metapredmet_checkbox" <?= (isset($data['project'][0]["metapredmets"][$key])) ? 'style="opacity: 1;"' : '' ?>>
                                    <img src="/assets/images/<?= $key ?>_metapredmets.svg" alt="">
                                    <span class=""><?= $value ?></span>
                                    <input <?= (isset($data['project'][0]["metapredmets"][$key])) ? 'checked' : '' ?> id="<?= $key ?>" type="checkbox" value="1" class="check_box" name="<?= $key ?>">
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-xs-12 block_indent">
                    <label>Предметная направленность проекта</label><br>
                    <?php foreach ($data['localizations']['predmets'] as $key => $value) : ?>
                        <div class="col-lg-6 wrap_predmets">
                            <div class="predmets" <?= (isset($data['project'][0]["predmets"][$key])) ? 'style="opacity: 1; border: 2px solid rgb(62, 62, 162);"' : '' ?>>
                                <span <?= (isset($data['project'][0]["predmets"][$key])) ? 'style="opacity: 1;"' : '' ?> class="check_img_note_predmet"></span>
                                <label for="<?= $key ?>" class="predmet_checkbox" <?= (isset($data['project'][0]["predmets"][$key])) ? 'style="opacity: 1;"' : '' ?>>
                                    <img src="/assets/images/<?= $key ?>_predmets.svg" alt="">
                                    <span class=""><?= $value ?></span>
                                    <input <?= (isset($data['project'][0]["predmets"][$key])) ? 'checked' : '' ?> id="<?= $key ?>" type="checkbox" value="1" class="check_box" name="<?= $key ?>">
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-xs-12 block_indent">
                    <label class="full_width_checkbox_label">Конечные потребители* <span style="display: none" class="error_ages_field_project">Oбязательное поле</span></label><br>
                    <?php foreach ($data['localizations']['ages'] as $key => $value) : ?>
                        <div class="col-xs-4 col-lg-2 wrap_ages">
                            <div class="ages" <?= (isset($data['project'][0]["ages"][$key])) ? 'style="border: 1px solid rgb(62, 62, 162); background: rgb(62, 62, 162);"' : '' ?>>
                                <span class="check_img_note_age"></span>
                                <label for="<?= $key ?>" class="age_checkbox" <?= (isset($data['project'][0]["ages"][$key])) ? 'style="color: rgb(255, 255, 255);"' : '' ?>>
                                    <?= $value ?>
                                    <input <?= (isset($data['project'][0]["ages"][$key])) ? 'checked' : '' ?> id="<?= $key ?>" type="checkbox" value="1" class="check_box ages_field_project" name="<?= $key ?>">
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-6 block_indent">
                    <label class="full_width_checkbox_label">Среда реализации* <span style="display: none" class="error_methods_field_project">Oбязательное поле</span></label><br>
                    <select required data-live-search="true" class="selectpicker methods_field_project" name="methods">
                        <option value="all" class="title">Не выбрано</option>
                        <?php foreach ($data['localizations']['methods'] as $key => $value): ?>
                            <option <?= (isset($data['project'][0]["method"][$key])) ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>;
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-6 block_indent">
                    <label>Стадия проекта</label>
                    <select data-live-search="true" class="selectpicker" name="stage_of_project">
                        <option value="all" class="title">Не выбрано</option>
                        <?php foreach ($data['localizations']['stage_of_project'] as $key => $value): ?>
                            <option <?= ($data['project'][0]["stage_of_project"] == $key) ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>;
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-xs-12 block_indent">
                    <label class="full_width_checkbox_label">Уровень воздействия* <span style="display: none" class="error_levels_field_project">Oбязательное поле</span></label><br>
                    <?php foreach ($data['localizations']['levels'] as $key => $value) : ?>
                        <div class="col-lg-4 wrap_levels">
                            <div class="levels" <?= (isset($data['project'][0]["level"][$key])) ? 'style="opacity: 1; border: 2px solid rgb(62, 62, 162);"' : '' ?>>
                                <span <?= (isset($data['project'][0]["level"][$key])) ? 'style="opacity: 1;"' : '' ?> class="check_img_note_levels"></span>
                                <label for="<?= $key ?>" class="level_checkbox">
                                    <img src="/assets/images/<?= $key ?>_levels.svg" alt="levels">
                                    <span class=""><?= $value ?></span>
                                    <input value="1" <?= (isset($data['project'][0]["level"][$key])) ? 'checked' : '' ?> id="<?= $key ?>" type="checkbox" class="check_box levels_field_project" name="<?= $key ?>">
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="">
                <div class="wrapper profile">
                    <div class="info_box_title">
                        <span>Организация проекта</span>
                    </div>
                    <div class="col-xs-12 block_indent">
                        <label>Оператор/автор проекта*</label>
                        <input value="<?= $data['project'][0]['author'] ?>" required placeholder="Наименование ЮЛ, ИП или нет фирмы" type="text" class="form-control" name="author">
                    </div>
                    <div class="col-xs-12 block_indent">
                        <label>Местоположение автора/головной компании*</label>
                        <input value="<?= $data['project'][0]['author_location'] ?>" required placeholder="Город" type="text" class="form-control" name="author_location">
                    </div>
                    <div class="col-xs-12 block_indent">
                        <label>Год начала деятельности*</label>
                        <input maxlength="4" value="<?= $data['project'][0]['start_year'] ?>" required placeholder="2018" type="text" class="form-control" name="start_year">
                    </div>
                    <div class="col-lg-6 block_indent organization">
                        <label>География оффлайн проекта</label>
                        <select data-live-search="true" class="selectpicker" name="geographys">
                            <option value="all" class="title">Не выбрано</option>
                            <?php foreach ($data['localizations']['geographys'] as $key => $value): ?>
                                <option <?= ($data['project'][0]["geography"]['offline_geography'] == $value) ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>;
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="wrapper">
                    <div class="info_box_title">
                        <span>Лидеры</span>
                    </div>
                    <?php if (!empty($data['leaders'])): ?>
                        <div style="display:none;" class="content_leader_main content_leader checkSizeLeader no_leaders_project no_leader_main mobile_wrap">
                            <div class="col-lg-6">
                                <p>Нет добавленных лидеров</p>
                            </div>
                            <div class="col-lg-3">
                                <a class="add_leader" onclick="add_leader_block()" href="javascript:void(0)">Добавить лидера</a>
                            </div>
                        </div>
                    <?php $counter = 0; ?>
                    <?php foreach ($data['leaders'] as $key => $value): ?>
                        <div class="content_leader_main content_leader leader<?= $counter; ?> checkSizeLeader col-xs-12 mobile_wrap">
                            <div class="col-lg-6 mobile_wrap">
                                <div class="col-xs-12">
                                    <label for="fio_<?= $counter ?>">Имя лидера*</label>
                                    <select id="fio_<?= $counter ?>" required data-live-search="true" class="selectpicker form-control" name="leader[<?= $counter; ?>][id_lid]">
                                        <option value="">Не выбрано</option>
                                        <?php foreach ($data['leaders_fio'] as $leader): ?>
                                            <option <?= ($data['leaders'][$key]['id_lid'] == $leader['id_lid']) ? 'selected' : '' ?> value="<?= $leader['id_lid'] ?>"><?= $leader['fio'] ?></option>;
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-xs-12">
                                    <label for="role_<?= $counter ?>">Роль лидера в проекте*</label>
                                    <input value="<?= $data['leaders'][$key]['role'] ?>" required id="role_<?= $counter ?>" class="form-control" type="text" name="leader[<?= $counter; ?>][role]">
                                </div>
                                <div class="col-xs-12">
                                    <label for="start_<?= $counter ?>">Старт работы над проектом*</label>
                                    <div class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                                        <input value="<?= $data['leaders'][$key]['start_year'] ?>" required id="start_<?= $counter ?>" name="leader[<?= $counter; ?>][start]" class="form-control" type="text" readonly>
                                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <label for="end_<?= $counter ?>">Окончание работы над проектом</label>
                                    <div style="<?= $data['leaders'][$key]['end_year'] == '' ? 'display:none' : '' ?>" id="end_<?= $counter ?>_box" class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                                        <input value="<?= $data['leaders'][$key]['end_year'] ?>" id="end_<?= $counter ?>" name="leader[<?= $counter; ?>][end]" class="form-control" type="text" readonly>
                                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <label class="still_work_main_label" for="still_work_<?= $counter ?>"><input <?= $data['leaders'][$key]['end_year'] == '' ? 'checked' : '' ?> id="still_work_<?= $counter ?>" class="form-control still_work still_work_label_<?= $counter ?>" type="checkbox" name="leader[<?= $counter; ?>][still_work]">
                                    <span style="font-size: 13px;"> Продолжаю работать над проектом</span></label>
                            </div>
                            <div class="col-lg-6 col-xs-12 buttons">
                                <a class="trash_btn" href="javascript:void(0)" onclick='trashLeader(".leader<?= $counter; ?>");'></a>

                                <a class="add_btn" onclick="add_leader_block()" href="javascript:void(0)"></a>
                            </div>
                        </div>
                        <script>
                            $('.still_work_label_<?= $counter; ?>').click(function () {
                                $('#end_<?= $counter; ?>').val('');
                                $('#end_<?= $counter; ?>_box').toggle();
                            });
                        </script>
                    <?php $counter++; ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <div class="content_leader_main content_leader checkSizeLeader no_leaders_project no_leader_main">
                            <div class="col-lg-6">
                                <p>Нет добавленных лидеров</p>
                            </div>
                            <div class="col-lg-3">
                                <a class="add_leader" onclick="add_leader_block()" href="javascript:void(0)">Добавить лидера</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="">
                <div class="wrapper">
                    <div class="info_box_title">
                        <span>Прикрепленные файлы</span>
                    </div>
                    <?php if (!empty($data['files'])): ?>
                        <div style="display:none;" class="content_file_main content_files_project checkSizeFile checkSizeFile no_files_project no_file_main">
                            <div class="col-lg-6">
                                <p>Нет прикрепленных файлов</p>
                            </div>
                            <div class="col-lg-3">
                                <a class="add_file" onclick="add_file_block()" href="javascript:void(0)">Добавить файл</a>
                            </div>
                        </div>
                        <?php $counter = 0; ?>
                        <?php foreach ($data['files'] as $key => $value): ?>
                            <div class="content_file_main content_leader_file content_files_project file<?= $counter; ?> checkSizeFile">
                                <div class="col-lg-5">
                                    <label for="file_<?= $counter ?>">Название*</label>
                                    <input value="<?= $data['files'][$key]['title'] ?>" required id="file_<?= $counter ?>" class="form-control" type="text" name="file[<?= $counter; ?>][title]">
                                </div>
                                <div class="col-lg-5">
                                    <label class="file_upload files">
                                        <span class="load_file">Выбрать файл*</span>
                                        <mark id="mark_<?= $counter ?>">файл не выбран</mark>
                                        <input id="user_file_<?= $counter ?>" type="file" onchange="upload('file', 'user_file_<?= $counter ?>', 'progressbar_<?= $counter ?>', 'preview_<?= $counter ?>', <?= $counter ?>);"/>
                                    </label>
                                    <progress id="progressbar_<?= $counter ?>" value="0" max="100" style="display: none;"></progress>
                                    <div id="preview_<?= $counter ?>" style="display: none">
                                        <input value="<?= $data['files'][$key]['filename'] ?>" id="preview_file_<?= $counter ?>" class="form-control" type="text" name="file[<?= $counter; ?>][filename]">
                                        <input value="<?= $data['files'][$key]['ext'] ?>" id="preview_file_<?= $counter ?>" class="form-control" type="text" name="file[<?= $counter; ?>][ext]">
                                        <input value="<?= $data['files'][$key]['size'] ?>" id="preview_file_<?= $counter ?>" class="form-control" type="text" name="file[<?= $counter; ?>][size]">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xs-12 buttons hidden-xs">
                                    <a class="trash_btn" href="javascript:void(0)" onclick='trashFile(".file<?= $counter; ?>");'></a>
                                    <a class="add_btn btn_file" onclick="add_file_block()" href="javascript:void(0)"></a>
                                </div>
                                <div class="col-xs-12">
                                    <label for="description_<?= $counter ?>">Описание*</label>
                                    <textarea required id="description_<?= $counter ?>" class="form-control" name="file[<?= $counter; ?>][description]" cols="30" rows="5"><?= $data['files'][$key]['description'] ?></textarea>
                                </div>
                                <div class="col-lg-2 col-xs-12 buttons visible-xs">
                                    <a class="trash_btn" href="javascript:void(0)" onclick='trashFile(".file<?= $counter; ?>");'></a>
                                    <a class="add_btn btn_file" onclick="add_file_block()" href="javascript:void(0)"></a>
                                </div>
                            </div>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="content_file_main content_files_project checkSizeFile checkSizeFile no_files_project no_file_main">
                            <div class="col-lg-6">
                                <p>Нет прикрепленных файлов</p>
                            </div>
                            <div class="col-lg-3">
                                <a class="add_file" onclick="add_file_block()" href="javascript:void(0)">Добавить файл</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="wrapper links_wrap">
                <div class="col-xs-12 info_box_title">
                    <span>Ссылки на публикации</span>
                </div>
                <?php if (!empty($data['links'])): ?>
                    <div style="display:none;" class="content_link_main content_project_link checkSizeLink no_links_project no_link_main">
                        <div class="col-lg-6">
                            <p>Нет прикрепленных ссылок</p>
                        </div>
                        <div class="col-lg-3">
                            <a class="add_link" onclick="add_links_block()" href="javascript:void(0)">Добавить ссылку</a>
                        </div>
                    </div>
                    <?php $counter = 0; ?>
                    <?php foreach ($data['links'] as $key => $value): ?>
                        <div class="content_link_main content_leader_link link<?= $counter; ?> checkSizeLink">
                            <div class="col-lg-10">
                                <label for="link_<?= $counter ?>">Название</label>
                                <input value="<?= $data['links'][$key]['title'] ?>" required id="link_<?= $counter ?>" class="form-control" type="text" name="link[<?= $counter; ?>][title]">
                            </div>
                            <div class="col-lg-2 col-xs-12 buttons hidden-xs">
                                <a class="trash_btn" href="javascript:void(0)" onclick='trashLink(".link<?= $counter; ?>");'></a>

                                <a class="add_btn btn_link" onclick="add_links_block()" href="javascript:void(0)"></a>
                            </div>
                            <div class="col-xs-12">
                                <label for="description_link_<?= $counter ?>">Ссылка*</label>
                                <input value="<?= $data['links'][$key]['link'] ?>" required placeholder="http://" id="description_link_<?= $counter ?>" class="form-control valid_url" name="link[<?= $counter; ?>][link]">
                            </div>
                            <div class="col-lg-2 col-xs-12 buttons visible-xs">
                                <a class="trash_btn" href="javascript:void(0)" onclick='trashLink(".link<?= $counter; ?>");'></a>

                                <a class="add_btn btn_link" onclick="add_links_block()" href="javascript:void(0)"></a>
                            </div>
                        </div>
                        <?php $counter++; ?>
                    <?php endforeach; ?>

                <?php else: ?>
                    <div class="content_link_main content_project_link checkSizeLink no_links_project no_link_main">
                        <div class="col-lg-6">
                            <p>Нет прикрепленных ссылок</p>
                        </div>
                        <div class="col-lg-3">
                            <a class="add_link" onclick="add_links_block()" href="javascript:void(0)">Добавить ссылку</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="wrap_buttons">
                <div class="col-lg-6 wrap_btn"><a href="javascript:void(0)"><input class="save_btn" type="submit" value="Сохранить все"></div>
                <?php if ($_SESSION['role'] == 'user'): ?>
                    <div class="col-lg-4 wrap_btn"><a class="back_btn" href="/user">Вернуться в профиль</a></div>
                <?php else : ?>
                    <div class="col-lg-4 wrap_btn back_link_admin"><a class="back_btn" href="/user">Вернуться назад</a></div>
                    <div class="col-lg-6 wrap_btn"><img class="add_input_tag_img" src="/assets/images/check.svg" alt="check"><span id="result_status_new_tag">Ваши изменения успешно сохранены.</span></div>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>
