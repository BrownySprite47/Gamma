<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>
    <div id="content-main">
        <div class="container-fluid">
            <form method="post" enctype="multipart/form-data" >
                <div class="col-lg-3 mobile_wrap">
                    <div id="preview_img">
                        <div id="preview">
                            <?php $pos = strripos($data['user'][0]['image_name'], 'http'); ?>
                            <?php if ($pos === false) : ?>
                                <?php if (!empty($data['user'][0]['image_name'])): ?>
                                    <span class="image_name" style="background-image: url('<?= CORE_IMG_PATH . $data['user'][0]['image_name'] ?>')"></span>
                                <?php else: ?>
                                    <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if (!empty($data['user'][0]['image_name'])): ?>
                                    <span class="image_name" style="background-image: url('<?= $data['user'][0]['image_name'] ?>')"></span>
                                <?php else: ?>
                                    <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                <?php endif; ?>
                            <?php endif;?>
                        </div>
                        <input style="display: none" id="image_name" type="text" name="image_name" value="<?= $data['user'][0]['image_name'] ?>"/>
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
                            <input type="text" required name="familya" class="form-control" id="familya" value="<?= ($data['user'][0]['familya'] == '0') ? '' : $data['user'][0]['familya'] ?>">
                        </div>
                        <div class="col-lg-4">
                            <label for="name">Имя*</label>
                             <input type="text" required name="name" class="form-control" id="name" value="<?= ($data['user'][0]['name'] == '0') ? '' : $data['user'][0]['name'] ?>">
                        </div>
                        <div class="col-lg-4">
                            <label for="otchestvo">Отчество</label>
                            <input type="text" name="otchestvo" class="form-control" id="otchestvo" value="<?= ($data['user'][0]['otchestvo'] == '0') ? '' : $data['user'][0]['otchestvo'] ?>">
                        </div>
                        <div class="col-xs-12">
                            <label for="city">Город*</label>
                            <input required placeholder="Например: Москва" type="text" name="city" class="form-control" id="city" value="<?= ($data['user'][0]['city'] == '0') ? '' : $data['user'][0]['city'] ?>">
                        </div>
                        <div class="col-xs-12">
                            <label for="birthday">Дата рождения*</label>
                            <div class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                                <input required placeholder="дд.мм.гггг" id="birthday" name="birthday" class="form-control" type="text" value="<?= ($data['user'][0]['birthday'] == '0') ? '' : $data['user'][0]['birthday'] ?>" readonly>
                                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <span class="not_public">— не отображается в публичном профиле</span>
                        </div>
                        <div class="col-xs-12">
                            <label for="social">Страница в соцсетях*</label>
                            <input required placeholder="http://" type="text" name="social" class="form-control valid_required valid_url" id="social" value="<?= ($data['user'][0]['social'] == '0') ? '' : $data['user'][0]['social'] ?>">
                        </div>
                        <div class="col-xs-12">
                            <label for="video">Ссылка на видеообращение</label>
                            <input placeholder="http://" type="text" name="video" class="form-control valid_url" id="video" value="<?= $data['user'][0]['video'] ?>">
                        </div>
                        <div class="col-xs-12">
                            <label for="telephone">Телефон</label>
                            <input placeholder="+7 xxx xxx xxxx" type="text" name="telephone" class="form-control" id="telephone" value="<?= ($data['user'][0]['telephone'] == '0') ? '' : $data['user'][0]['telephone'] ?>">
                            <span class="not_public">— не отображается в публичном профиле</span>
                        </div>
                        <div class="col-xs-12">
                            <label for="email">E-mail</label>
                            <input placeholder="E-mail" type="text" name="email" class="form-control" id="email" value="<?= ($data['user'][0]['email'] == '0') ? '' : $data['user'][0]['email'] ?>">
                            <span class="not_public">— не отображается в публичном профиле</span>
                        </div>
                        <div class="col-xs-12">
                            <label for="contact_info">Дополнительная контактная информация</label>
                            <input placeholder="Дополнительная контактная информация" type="text" name="contact_info" class="form-control" id="contact_info" value="<?= ($data['user'][0]['contact_info'] == '0') ? '' : $data['user'][0]['contact_info'] ?>">
                        </div>
                        <div class="col-xs-12">
                            <p class="required_fields">Поля, отмеченные * - обязательны для заполнения</p>
                        </div>
                    </div>
                    <div class="wrapper files_wrap">
                        <div class="col-xs-12 info_box_title">
                            <span>Прикрепленные файлы</span>
                        </div>
                        <?php if (!empty($data['files']['leaders'])) :?>
                            <div class="content_file_main content_leader_file checkSizeFile no_files_user" style="display: none">
                                <div class="col-lg-6">
                                    <p>Нет прикрепленных файлов</p>
                                </div>
                                <div class="col-lg-3">
                                    <a class="add_file" href="javascript:void(0)">Добавить файл</a>
                                </div>
                            </div>
                            <?php $i = 0;?>
                            <?php foreach ($data['files']['leaders'] as $key => $value): ?>
                            <div class="content_file_main content_leader_file file<?= $i; ?> checkSizeFile">
                                <div class="col-lg-5">
                                    <label for="file_<?= $i ?>">Название</label>
                                    <input required id="file_<?= $i ?>" class="form-control" type="text" name="file[<?= $i; ?>][title]" value="<?= $value['title'] ?>">
                                </div>
                                <div class="col-lg-5">
                                    <label class="file_upload files">
                                        <span class="load_file">Выбрать файл</span>
                                        <mark id="mark_<?= $i ?>">файл не выбран</mark>
                                        <input required id="user_file_<?= $i ?>" type="file" onchange="upload('file', 'user_file_<?= $i ?>', 'progressbar_<?= $i ?>', 'preview_<?= $i ?>', <?= $i ?>);"/>
                                    </label>
                                    <progress id="progressbar_<?= $i ?>" value="0" max="100" style="display: none;"></progress>
                                    <div id="preview_<?= $i ?>" style="display: none">
                                        <input id="preview_file_<?= $i ?>" class="form-control" type="text" name="file[<?= $i; ?>][filename]" value="<?= $value['filename'] ?>">
                                        <input id="preview_file_size_<?= $i ?>" class='form-control' type='text' name="file[<?= $i ?>][size]" value="<?= $value['size'] ?>">
                                        <input id="preview_file_ext_<?= $i ?>" class='form-control' type='text' name="file[<?= $i ?>][ext]" value="<?= $value['ext'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 buttons hidden-xs">
                                    <a class="trash_btn" href="javascript:void(0)" onclick='AjaxCheckLeaderDbFile("del", ".file<?= $i; ?>");'></a>

                                    <a class="add_btn btn_file add_file" href="javascript:void(0)" onclick="add_file_block()"></a>
                                </div>
                                <div class="col-xs-12">
                                    <label for="description_<?= $i ?>">Описание</label>
                                    <textarea id="description_<?= $i ?>" class="form-control" name="file[<?= $i; ?>][description]" cols="30" rows="5"><?= $value['description'] ?></textarea>
                                </div>
                                <div class="col-lg-2 buttons visible-xs">
                                    <a class="trash_btn" href="javascript:void(0)" onclick='AjaxCheckLeaderDbFile("del", ".file<?= $i; ?>");'></a>

                                    <a class="add_btn btn_file add_file" href="javascript:void(0)" onclick="add_file_block()"></a>
                                </div>
                            </div>
                            <script>
                                function AjaxCheckLeaderDbFile($check, $id){
                                    if ($check == 'del') {
                                        $($id).remove();
                                    }
                                    if ($('.checkSizeFile').length == 1){
                                        $('.no_files_user').css('display', 'inline-block');
                                    }
                                }
                            </script>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div class="content_file_main content_leader_file checkSizeFile no_files_user no_file_main">
                                <div class="col-lg-6">
                                    <p>Нет прикрепленных файлов</p>
                                </div>
                                <div class="col-lg-3">
                                    <a class="add_file" href="javascript:void(0)">Добавить файл</a>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="wrapper links_wrap">
                        <div class="col-xs-12 info_box_title">
                            <span>Ссылки на публикации</span>
                        </div>
                        <?php if (!empty($data['links']['leaders'])) :?>
                            <div class="content_link_main content_leader_link checkSizeLink no_links_user no_link_main" style="display: none">
                                <div class="col-lg-6">
                                    <p>Нет прикрепленных ссылок</p>
                                </div>
                                <div class="col-lg-3">
                                    <a class="add_link" href="javascript:void(0)">Добавить ссылку</a>
                                </div>
                            </div>
                            <?php $i = 0;?>
                            <?php foreach ($data['links']['leaders'] as $key => $value): ?>
                            <div class="content_link_main content_leader_link link<?= $i; ?> checkSizeLink">
                                <div class="col-lg-10 col-xs-12">
                                    <label for="link_<?= $i ?>">Название</label>
                                    <input required id="link_<?= $i ?>" class="form-control" type="text" name="link[<?= $i; ?>][title]" value="<?= $value['title'] ?>">
                                </div>
                                <div class="col-xs-2 buttons hidden-xs">
                                    <a class="trash_btn" href="javascript:void(0)" onclick='trash(".link<?= $i; ?>");'></a>
                                    <a class="add_btn btn_link add_link" href="javascript:void(0)"></a>
                                </div>
                                <div class="col-xs-12">
                                    <label for="description_link_<?= $i ?>">Ссылка</label>
                                    <input required placeholder="http://" id="description_link_<?= $i ?>" class="form-control link_site valid_url" name="link[<?= $i; ?>][link]" value="<?= $value['link'] ?>">
                                </div>
                                <div class="col-xs-12 buttons visible-xs">
                                    <a class="trash_btn" href="javascript:void(0)" onclick='trash(".link<?= $i; ?>");'></a>
                                    <a class="add_btn btn_link add_link" href="javascript:void(0)"></a>
                                </div>
                            </div>

                        <?php $i++; ?>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div class="content_link_main content_leader_link checkSizeLink no_links_user no_link_main">
                                <div class="col-lg-6">
                                    <p>Нет прикрепленных ссылок</p>
                                </div>
                                <div class="col-lg-3">
                                    <a class="add_link" href="javascript:void(0)">Добавить ссылку</a>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="wrap_buttons">
                        <div class="col-lg-6 wrap_btn"><a href="javascript:void(0)"><input class="save_btn" type="submit" value="Сохранить все"></a></div>
                        <div class="col-lg-4 wrap_btn"><a class="back_btn" href="/user">Вернуться в профиль</a></div>
                    </div>
                </div>
                <div class="col-xs-2"></div>
            </form>
        </div>
    <div>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>
