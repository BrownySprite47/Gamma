<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>
    <input type="hidden" name="id_proj" id="id_proj" value="<?= $_GET['id'] ?>">
    <div id="content-main">
        <div class="container-fluid">
            <div class="wrap_admin_links">
                <div class="col-lg-3 back_to_profile">
                    <a href="javascript:history.back()"><img src="/assets/images/arrow_blue.svg" alt=""><span>Вернуться назад</span></a>
                </div>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <div class="col-xs-6 admin_links">
                        <a href="/admin/projects/edit?id=<?= $_GET['id'] ?>"><span>Редактировать</span></a>
                    </div>
                    <?php if($data['project'][0]['checked'] == '1'): ?>
                    <div class="col-xs-2 admin_links delete">
                        <a href="javascript:void(0);"><span>Удалить</span></a>
                    </div>
                    <?php elseif($data['project'][0]['checked'] == '2'): ?>
                        <div class="col-xs-2 admin_links recovery">
                        <a href="javascript:void(0);"><span>Восстановить</span></a>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 mobile_wrap">
                <?php if (!empty($data['project'][0]['image_name'])): ?>
                    <span class="project_image" style="background-image: url(<?= CORE_IMG_PATH . $data['project'][0]['image_name'] ?>);"></span>
                <?php else: ?>
                    <span class="project_image" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>);"></span>
                    <div class="mobile_description_box"></div>
                <?php endif; ?>
                <span class="project_title"><?= $data['project'][0]['project_title'] ?></span><br>
                <div class="project_info short">
                    <span class="short_title">Краткое название: </span><span><?= !empty($data['project'][0]['short_title']) ? $data['project'][0]['short_title'] : 'Не указано' ?></span><br>
                    <?php if (!empty($data['leaders'])): ?>
                        <span class="project_leaders">Лидеры: </span><br>
                        <?php foreach ($data['leaders'] as $key => $value): ?>
                            <span><a href="/index/leaders/view?id=<?= $value['id_lid'] ?>"><?= $value['fio'] ?></a></span><br>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="project_leaders">Лидеры: </span><span>У проекта нет лидеров</span><br>
                    <?php endif; ?>
                    <?php if (!empty($data['project'][0]['site'])): ?>
                        <span class="project_site">Сайт: </span><span class="mobile_site" style="max-width: 220px; display: flex;"><a class="max_length_limit" target="_blank" href="http://<?= $data['project'][0]['site'] ?>"><?= $data['project'][0]['site'] ?></a></span><br>
                    <?php else: ?>
                        <span class="project_site">Сайт: </span><span class="mobile_site">Не указано</span><br>
                    <?php endif; ?>
                </div>
                <div class="wrap_user_info">
                    <?php if (isset($data['files']) && !empty($data['files'])): ?>
                        <?php foreach ($data['files'] as $key => $value): ?>
                            <?php if ($value['title'] == '') $value['title'] = 'Без названия'; ?>
                            <?php if ($value['ext'] == 'doc' || $value['ext'] == 'docx' || $value['ext'] == 'txt'): ?>
                                <div class="user_profile_info_box">
                                    <a class="user_files" target="_blank" href="<?= CORE_FILE_PATH . $value['filename'] ?>">
                                        <div class="col-xs-2"><img src="/assets/images/DOC.svg" alt="file"></div>
                                        <div class="col-xs-8">
                                            <p class="titles_file_user"><?= $value['title'] ?></p>
                                            <p class="sizes_file_user"><?= $value['description'] ?></p>
                                            <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                        </div>
                                    </a>
                                    <a href="/index/comments/file?id=<?= $value['id'] ?>"><div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div></a>
                                </div>
                            <?php elseif ($value['ext'] == 'jpg' || $value['ext'] == 'png' || $value['ext'] == 'jpeg' || $value['ext'] == 'jpg'): ?>
                                <div class="user_profile_info_box">
                                    <a class="user_files" target="_blank" href="<?= CORE_FILE_PATH . $value['filename'] ?>">
                                        <div class="col-xs-2"><img src="/assets/images/JPG.svg" alt="file"></div>
                                        <div class="col-xs-8">
                                            <p class="titles_file_user"><?= $value['title'] ?></p>
                                            <p class="sizes_file_user"><?= $value['description'] ?></p>
                                            <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                        </div>
                                    </a>
                                    <a href="/index/comments/file?id=<?= $value['id'] ?>"><div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div></a>

                                </div>
                            <?php elseif ($value['ext'] == 'pdf'): ?>
                                <div class="user_profile_info_box">
                                    <a class="user_files" target="_blank" href="<?= CORE_FILE_PATH . $value['filename'] ?>">
                                        <div class="col-xs-2"><img src="/assets/images/PDF.svg" alt="file"></div>
                                        <div class="col-xs-8">
                                            <p class="titles_file_user"><?= $value['title'] ?></p>
                                            <p class="sizes_file_user"><?= $value['description'] ?></p>
                                            <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                        </div>
                                    </a>
                                    <a href="/index/comments/file?id=<?= $value['id'] ?>"><div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div></a>

                                </div>
                            <?php else: ?>
                                <div class="user_profile_info_box">
                                    <a class="user_files" target="_blank" href="<?= CORE_FILE_PATH . $value['filename'] ?>">
                                        <div class="col-xs-2"><img src="/assets/images/NONE.svg" alt="file"></div>
                                        <div class="col-xs-8">
                                            <p class="titles_file_user"><?= $value['title'] ?></p>
                                            <p class="sizes_file_user"><?= $value['description'] ?></p>
                                            <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                        </div>
                                    </a>
                                    <a href="/index/comments/file?id=<?= $value['id'] ?>"><div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div></a>

                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="user_profile_info_box">
                            <a class="user_files" href="javascript:void(0)">
                                <div class="col-xs-2 no_files_img"><img src="/assets/images/NONE.svg" alt="file"></div>
                                <div class="col-xs-10">
                                    <p class="titles_file_user no_files_title">Нет прикрепленных файлов</p>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($data['links']) && !empty($data['links'])): ?>
                        <?php foreach ($data['links'] as $key => $value): ?>
                            <?php if ($value['title'] == '') $value['title'] = 'Без названия'; ?>
                            <div class="user_profile_info_box">
                                <a class="user_files" target="_blank" href="<?= $value['link'] ?>">
                                    <div class="col-xs-2"><img src="/assets/images/HTML.svg" alt="file"></div>
                                    <div class="col-xs-8">
                                        <p class="titles_link_user"><?= $value['title'] ?></p>
                                    </div>
                                </a>
                                <a href="/index/comments/link?id=<?= $value['id'] ?>"><div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div></a>

                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="user_profile_info_box">
                            <a class="user_files" href="javascript:void(0)">
                                <div class="col-xs-2 no_files_img"><img src="/assets/images/NONE.svg" alt="file"></div>
                                <div class="col-xs-10">
                                    <p class="titles_link_user no_links_title">Нет прикрепленных ссылок</p>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-9 mobile_wrap">
                <div class="project_info">
                    <div class="col-xs-12 wrap_project_description">
                        <div class="project_description"><span>Описание проекта</span></div>
                        <div>
                            <?php if (!empty($data['project'][0]['project_description'])): ?>
                                <p class="description_main"><?= $data['project'][0]['project_description'] ?></p>
                            <?php else: ?>
                                <p class="description_main">Не указано</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-4 description">
                        <p class="project_title">Метапредметная направленность:</p>
                        <?php if (!empty($data['project'][0]['metapredmets'])): ?>
                            <?php foreach ($data['project'][0]['metapredmets'] as $key => $value): ?>
                                <p><?= $data['localizations']['metapredmets'][$key] ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>

                    </div>
                    <div class="col-lg-4">
                        <p class="title_info">Предметная направленность:</p>
                        <?php if (!empty($data['project'][0]['predmets'])): ?>
                            <?php foreach ($data['project'][0]['predmets'] as $key => $value): ?>
                                <p><?= $data['localizations']['predmets'][$key] ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4 consumers">
                        <p class="title_info">Конечные потребители:</p>
                        <?php if (!empty($data['project'][0]['ages'])): ?>
                            <?php foreach ($data['project'][0]['ages'] as $key => $value): ?>
                                <span><?= $data['localizations']['ages'][$key] ?></span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="project_info level wrapper_project_info">
                    <div class="col-lg-4 description">
                        <p class="title_info">Среда реализации:</p>
                        <?php if (!empty($data['project'][0]['method'])): ?>
                            <?php foreach ($data['project'][0]['method'] as $key => $value): ?>
                                <p><?= $data['localizations']['methods'][$key] ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4">
                        <p class="title_info">Уровень воздействия:</p>
                        <?php if (!empty($data['project'][0]['level'])): ?>
                            <?php foreach ($data['project'][0]['level'] as $key => $value): ?>
                                <p><?= $data['localizations']['levels'][$key] ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="project_info">
                    <div class="col-xs-12 wrap_project_description">
                        <div class="project_description"><span>Организация проекта</span></div>
                    </div>
                    <div class="col-lg-4 description">
                        <p class="title_info">Оператор/автор проекта:</p>
                        <?php if (!empty($data['project'][0]['author'])): ?>
                            <p><?= $data['project'][0]['author'] ?></p>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4">
                        <p class="title_info">Город:</p>
                        <?php if (!empty($data['project'][0]['author_location'])): ?>
                            <p><?= $data['project'][0]['author_location'] ?></p>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4">
                        <p class="title_info">Год начала деятельности:</p>
                        <?php if (!empty($data['project'][0]['start_year'])): ?>
                            <p><?= $data['project'][0]['start_year'] ?></p>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="project_info level wrapper_project_info">
                    <div class="col-lg-6 description">
                        <p class="title_info">Филиалы/франшизы оффлайн проекта:</p>
                        <?php if (!empty($data['project'][0]['filial'])): ?>
                            <p><?= $data['project'][0]['filial'] ?></p>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="project_info wrapper_project_info">
                    <div class="col-xs-12 wrap_project_description">
                        <div class="project_description"><span>Масштаб проекта</span></div>
                    </div>
                    <div class="col-lg-6 description">
                        <p class="title_info">География оффлайн проекта:</p>
                        <?php if (!empty($data['project'][0]['geography']['offline_geography'])): ?>
                            <p><?= $data['project'][0]['geography']['offline_geography'] ?></p>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6">
                        <p class="title_info">Стадия проекта:</p>
                        <?php if (!empty($data['project'][0]['stage_of_project'])): ?>
                            <p><?= $data['project'][0]['stage_of_project'] ?></p>
                        <?php else: ?>
                            <p>Не указано</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="project_info wrapper_project_info leaders">
                    <div class="col-xs-12 wrap_project_description mobile_lead_proj">
                        <div class="project_description"><span>Лидеры</span></div>
                    </div>
                    <?php if (!empty($data['leaders'])): ?>
                    <?php foreach ($data['leaders'] as $key => $value): ?>
                            <div class="inner_wrap">
                                <div class="col-lg-3 description">
                                    <p class="title_info">Фамилия, Имя лидера:</p>
                                    <p><a href="/index/leaders/view?id=<?= $value['id_lid'] ?>"><?= $value['fio'] ?></a></p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="title_info">Роль лидера:</p><br>
                                    <?php if ($value['role'] != ''): ?>
                                        <p><?= $value['role'] ?></p>
                                    <?php else: ?>
                                        <p>Не указано</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3">
                                    <p class="title_info">Старт работы над проектом:</p>
                                    <?php if ($value['start_year'] != ''): ?>
                                        <p><?= $value['start_year'] ?></p>
                                    <?php else: ?>
                                        <p>Не указано</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3">
                                    <p class="title_info">Окончание работы над проектом:</p>
                                    <?php if ($value['end_year'] != ''): ?>
                                        <p><?= $value['end_year'] ?></p>
                                    <?php else: ?>
                                        <p>Продолжает работать над проектом</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <div class="col-xs-12 wrap_project_description mobile_lead_proj">
                        <div class="project_description"><p>У проекта нет лидеров</p></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>
