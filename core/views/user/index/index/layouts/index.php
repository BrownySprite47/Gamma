<div class="container-fluid">
    <div class="col-lg-3 wrap_user_info">
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
        <?php if ($_SESSION['access']['info']): ?>
            <div class="user_profile_info_box_top">
                <p class="user_fio"><?= ($data['user'][0]['fio'] == '') ? 'Не указано' : $data['user'][0]['fio'] ?></p>
                <?php if ($data["user"][0]["status"] == '0'): ?>
                    <p class="user_status register">Зарегистрированный  пользователь <img src="/assets/images/checkmark.svg" alt="check"></p>
                <?php else: ?>
                    <p class="user_status leader">Лидер <img src="/assets/images/briefcase.svg" alt="briefcase"></p>
                <?php endif; ?>
                <p class="user_complete_profile">Заполненность профиля: 10%</p>
                <p class="user_complete_progress"><progress value="10" max="100"></progress></p>
                <p class="edit_profile"><a href="/user/edit">Редактировать анкету <img src="/assets/images/edit_profile.svg" alt="edit_profile"></a></p>
                <div class="mobile_description_box"></div>
            </div>
            <div>
                <?php if ($data["user"][0]["status"] == '0'): ?>
                    <p><a class="add_to_comunity open-modal" href="javascript:void(0)">Войти в сообщество</a></p>
                <?php endif; ?>
            </div>
            <div class="user_profile_info_box">
                <p class="user_profile_info user_telephone"><img src="/assets/images/telephone.svg" alt="user_telephone"> <?= ($data['user'][0]['telephone'] == '') ? 'Не указано' : $data['user'][0]['telephone'] ?></p>
                <p class="user_profile_info user_email"><img src="/assets/images/mail.svg" alt="user_email"> <?= ($data['user'][0]['email'] == '') ? 'Не указано' : $data['user'][0]['email'] ?></p>
                <p class="user_profile_info user_city"><img src="/assets/images/coordinates.svg" alt="user_city"> <?= ($data['user'][0]['city'] == '') ? 'Не указано' : $data['user'][0]['city'] ?></p>
                <p class="user_profile_info user_contact_info"><img src="/assets/images/telephone-directory.svg" alt="user_contact_info"> <?= ($data['user'][0]['contact_info'] == '') ? 'Не указано' : $data['user'][0]['contact_info']  ?></p>
                <p class="user_profile_info user_birthday"><img src="/assets/images/Сake.svg" alt="user_birthday"> <?= ($data['user'][0]['birthday'] == '') ? 'Не указано' : $data['user'][0]['birthday']  ?></p>
            </div>
                <?php if (!empty($data['files']['leaders']) || !empty($data['files']['projects'])): ?>
                <?php if(!empty($data['files']['leaders'])): ?>
                <?php foreach ($data['files']['leaders'] as $key => $value): ?>
                    <?php if ($value['title'] == '') { $value['title'] = 'Без названия'; } ?>
                    <?php if ($value['ext'] == 'doc' || $value['ext'] == 'docx' || $value['ext'] == 'txt'): ?>
                        <div class="user_profile_info_box attach">
                            <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                <div class="col-xs-2"><img src="/assets/images/DOC.svg" alt="file"></div>
                                <div class="col-xs-8">
                                    <p class="titles_file_user"><?= $value['title'] ?></p>
                                    <p class="sizes_file_user"><?= $value['description'] ?></p>
                                    <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                </div>
                                <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                            </a>
                        </div>
                    <?php elseif ($value['ext'] == 'jpg' || $value['ext'] == 'png' || $value['ext'] == 'jpeg' || $value['ext'] == 'jpg'): ?>
                        <div class="user_profile_info_box attach">
                            <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                <div class="col-xs-2"><img src="/assets/images/JPG.svg" alt="file"></div>
                                <div class="col-xs-8">
                                    <p class="titles_file_user"><?= $value['title'] ?></p>
                                    <p class="sizes_file_user"><?= $value['description'] ?></p>
                                    <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                </div>
                                <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                            </a>
                        </div>
                    <?php elseif ($value['ext'] == 'pdf'): ?>
                        <div class="user_profile_info_box attach">
                            <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                <div class="col-xs-2"><img src="/assets/images/PDF.svg" alt="file"></div>
                                <div class="col-xs-8">
                                    <p class="titles_file_user"><?= $value['title'] ?></p>
                                    <p class="sizes_file_user"><?= $value['description'] ?></p>
                                    <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                </div>
                                <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="user_profile_info_box attach">
                            <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                <div class="col-xs-2"><img src="/assets/images/NONE.svg" alt="file"></div>
                                <div class="col-xs-8">
                                    <p class="titles_file_user"><?= $value['title'] ?></p>
                                    <p class="sizes_file_user"><?= $value['description'] ?></p>
                                    <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                </div>
                                <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php if(!empty($data['files']['projects'])): ?>
                <?php foreach ($data['files']['projects'] as $key => $value): ?>
                    <?php if ($value['title'] == '') { $value['title'] = 'Без названия'; } ?>
                    <?php if ($value['ext'] == 'doc' || $value['ext'] == 'docx' || $value['ext'] == 'txt'): ?>
                        <div class="user_profile_info_box attach">
                            <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                <div class="col-xs-2"><img src="/assets/images/DOC.svg" alt="file"></div>
                                <div class="col-xs-8">
                                    <p class="titles_file_user"><?= $value['title'] ?></p>
                                    <p class="sizes_file_user"><?= $value['description'] ?></p>
                                    <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                </div>
                                <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                            </a>
                        </div>
                    <?php elseif ($value['ext'] == 'jpg' || $value['ext'] == 'png' || $value['ext'] == 'jpeg' || $value['ext'] == 'jpg'): ?>
                        <div class="user_profile_info_box attach">
                            <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                <div class="col-xs-2"><img src="/assets/images/JPG.svg" alt="file"></div>
                                <div class="col-xs-8">
                                    <p class="titles_file_user"><?= $value['title'] ?></p>
                                    <p class="sizes_file_user"><?= $value['description'] ?></p>
                                    <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                </div>
                                <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                            </a>
                        </div>
                    <?php elseif ($value['ext'] == 'pdf'): ?>
                        <div class="user_profile_info_box attach">
                            <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                <div class="col-xs-2"><img src="/assets/images/PDF.svg" alt="file"></div>
                                <div class="col-xs-8">
                                    <p class="titles_file_user"><?= $value['title'] ?></p>
                                    <p class="sizes_file_user"><?= $value['description'] ?></p>
                                    <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                </div>
                                <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="user_profile_info_box attach">
                            <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                <div class="col-xs-2"><img src="/assets/images/NONE.svg" alt="file"></div>
                                <div class="col-xs-8">
                                    <p class="titles_file_user"><?= $value['title'] ?></p>
                                    <p class="sizes_file_user"><?= $value['description'] ?></p>
                                    <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                </div>
                                <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
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
            <?php if (!empty($data['links']['leaders']) || !empty($data['links']['projects'])): ?>
                <?php if (!empty($data['links']['leaders'])): ?>
                <?php foreach ($data['links']['leaders'] as $key => $value): ?>
                    <?php if ($value['title'] == '') { $value['title'] = 'Без названия'; } ?>
                    <div class="user_profile_info_box attach">
                        <a class="user_files" href="/index/comments/link?id=<?= $value['id'] ?>">
                            <div class="col-xs-2"><img src="/assets/images/HTML.svg" alt="file"></div>
                            <div class="col-xs-8">
                                <p class="titles_link_user"><?= $value['title'] ?></p>
                            </div>
                            <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                        </a>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php if (!empty($data['links']['projects'])): ?>
                    <?php foreach ($data['links']['projects'] as $key => $value): ?>
                        <?php if ($value['title'] == '') { $value['title'] = 'Без названия'; } ?>
                        <div class="user_profile_info_box attach">
                            <a class="user_files" href="/index/comments/link?id=<?= $value['id'] ?>">
                                <div class="col-xs-2"><img src="/assets/images/HTML.svg" alt="file"></div>
                                <div class="col-xs-8">
                                    <p class="titles_link_user"><?= $value['title'] ?></p>
                                </div>
                                <div class="col-xs-2 comment_img"><span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span></div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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
        <?php else: ?>
            <div class="user_profile_info_box_top">
                <p class="user_fio"><?= ($data['user'][0]['fio'] == '') ? 'Не указано' : $data['user'][0]['fio'] ?></p>
                <?php if ($data["user"][0]["status"] == '0'): ?>
                    <p class="user_status register">Зарегистрированный  пользователь <img src="/assets/images/checkmark.svg" alt="check"></p>
                <?php else: ?>
                    <p class="user_status leader">Лидер <img src="/assets/images/briefcase.svg" alt="briefcase"></p>
                <?php endif; ?>
                <p class="user_complete_profile">Заполненность профиля: 10%</p>
                <p class="user_complete_progress"><progress value="10" max="100"></progress></p>
                <p class="edit_profile"><a href="/user/edit">Редактировать анкету <img src="/assets/images/edit_profile.svg" alt="edit_profile"></a></p>
                <p><a class="add_to_comunity open-modal" href="javascript:void(0)">Войти в сообщество</a></p>
            </div>
            <div class="new_user">
                <p>Попадание в онлайн-сообщество Лидеров Инноваций в Образовании позволяет обращаться к сообществу за советом по актуальным вопросам, и получать запросы других участников. Чтобы стать членом сообщества, заполните анкету и найдите тех 2-х лидеров, которые порекомендуют вас как лидера инноваций в образовании</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-lg-9 mobile_social">
        <div class="col-lg-5 social_box">
            <div class="social_links_title"><span>Подключить социальные сети</span></div>
            <div class="social_links_box">
                <span><a href="javascript:void(0);"><img src="/assets/images/VK_Rectangle.svg" alt=""></a></span>
                <span><a href="javascript:void(0);"><img src="/assets/images/OK_Rectangle.svg" alt=""></a></span>
                <span><a href="javascript:void(0);"><img src="/assets/images/Mail_Rectangle.svg" alt=""></a></span>
                <span><a href="javascript:void(0);"><img src="/assets/images/Ya_Rectangle.svg" alt=""></a></span>
                <span><a href="javascript:void(0);"><img src="/assets/images/G_Rectangle.svg" alt=""></a></span>
                <span><a href="javascript:void(0);"><img src="/assets/images/FB_Rectangle.svg" alt=""></a></span>
            </div>
        </div>
        <div class="col-lg-7 recommend_box">
            <?php if (!$_SESSION['access']['info'] || !$_SESSION['access']['proj']): ?>
                <div class="recommend_link_title"><span>Ссылка для рекомендации</span><span></span></div>
                <div class="recommend_link_box">
                    <p class="new_user_recommend">Заполните анкету, и добавьте проект, чтобы получать рекомендации.</p>
                </div>
            <?php else: ?>
                    <div class="recommend_link_title"><span>Ссылка для рекомендации</span><span class="hidden-xs">Сейчас рекомендаций: <?= $_SESSION['access']['num_recom'] ?></span></div>
                    <div class="recommend_link_box">
                        <a id="copyLink" class="copy" href="javascript:void(0);">
                            <div class="recommend_link">
                                <span><?= SITE ?>/recommends/add?id=<?=$_SESSION['id_lid']?></span>
                                <img src="/assets/images/Copy.svg" alt="">
                            </div>
                        </a>
                        <p class="user_status register copy"><img src="/assets/images/checkmark.svg" alt="check">Скопировано</p>
                    </div>
                <div class="recommend_link_title visible-xs"><span>Сейчас рекомендаций: <?= $_SESSION['access']['num_recom'] ?></span></div>
            <?php endif; ?>
        </div>
        <div class="col-xs-12 mobile_projects">
            <div class="user_profile_info_box projects">
                <div class="projects_box">
                    <div class="projects_box_inner left">Мои проекты</div>
                    <?php if ($_SESSION['access']['info']): ?>
                        <div class="projects_box_inner right hidden-xs"><a href="/user/projects/add"><img src="/assets/images/Add_Line_Blue.svg" alt="add">Добавить проект</a></div>
                        <div class="projects_box_inner right visible-xs"><a href="/user/projects/add"><img src="/assets/images/Add_Line_Blue.svg" alt="add">Добавить</a></div>
                    <?php endif; ?>
                </div>
                <?php if ($_SESSION['access']['info']): ?>
                    <?php if (!empty($data['projects'])): ?>
                        <?php foreach ($data['projects'] as $key => $value): ?>
                        <div style="position: relative;">
                            <a class="link_project_leader" href="/user/projects/edit?id=<?= $value['id_proj'] ?>">
                                <div class="wrapper_projects">
                                    <div class="col-lg-2">
                                        <?php $pos = strripos($value['image_name'], 'http'); ?>
                                        <?php if ($pos === false) : ?>
                                            <?php if (!empty($value['image_name'])): ?>
                                                <span class="project_image" style="background-image: url('<?= CORE_IMG_PATH .  $value['image_name'] ?>')"></span>
                                            <?php else: ?>
                                                <span class="project_image" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if (!empty($value['image_name'])): ?>
                                                <span class="project_image" style="background-image: url('<?= $value['image_name'] ?>')"></span>
                                            <?php else: ?>
                                                <span class="project_image" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                            <?php endif; ?>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-lg-8 mobile_wrap_projects"><span class="projects_background"></span><span class="project_title"><?= $value['project_title'] ?></span><br><span class="project_description"><?= $value['project_description'] ?></span></div>
                                    <div class="col-lg-2"><span class="project_link"></span></div>
                                    <img class="edit_project" src="/assets/images/Edit_Project.svg" alt="edit">
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="projects_none">Нет проектов</span>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="projects_none">Заполните анкету, чтобы добавить проект.</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xs-12 mobile_tags">
            <div class="user_profile_info_box tags_box">
                <div class="projects_box links tags">
                    <div class="projects_box_inner left">Мои теги</div>
                    <?php if ($_SESSION['access']['info'] && $_SESSION['access']['proj'] && $_SESSION['access']['recom']): ?>
                        <div class="projects_box_inner right"><a href="/user/tags">Редактировать</a></div>
                    <?php endif; ?>
                </div>
                <?php if ($_SESSION['access']['info'] && $_SESSION['access']['proj'] && $_SESSION['access']['recom']): ?>
                        <div class="wr_tags">
                            <div class="col-lg-6">
                                <p class="i_want">Мне нужно</p>
                                <?php if (!empty($data['tags']['tag_i_want'])): ?>
                                    <?php foreach ($data['tags']['tag_i_want'] as $key => $value): ?>
                                        <span class="tag_i_want"><?= $value['tag_i_want'] ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="user_havnt_tag">Не указано</span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-6">
                                <p class="i_can">Могу поделиться</p>
                                <?php if (!empty($data['tags']['tag_i_can'])): ?>
                                    <?php foreach ($data['tags']['tag_i_can'] as $key => $value): ?>
                                        <span class="tag_i_can"><?= $value['tag_i_can'] ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="user_havnt_tag">Не указано</span>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php else: ?>
                    <div class="">
                        <span class="projects_none">Заполните анкету, добавьте проект и получите не менее 2-х рекомендаций, чтобы добавлять теги.</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xs-12 mobile_settings">
            <div class="user_profile_info_box private_box">
                <div class="projects_box">
                    <div class="projects_box_inner private">Настройки приватности профиля</div>
                </div>
                <div class="col-lg-12">
                    <span>
                        <label>
                            <input id="all" value="0" name="private" <?= ($data["user"][0]["actual"] == '0') ? 'checked' : '' ?> class="label_checkbox_1 filter_checkbox" type="radio">
                            <span></span>
                        </label>
                        <a id="checkbox_1" class="checkbox" href="javascript:void(0);">Видят все пользователи, включая посетителей</a><br>
                    </span>
                    <span>
                        <label>
                            <input id="register" value="1" name="private" <?= ($data["user"][0]["actual"] == '1') ? 'checked' : '' ?> class="label_checkbox_2 filter_checkbox" type="radio">
                            <span></span>
                        </label>
                        <a id="checkbox_2" class="checkbox" href="javascript:void(0);">Видят только зарегистрированные пользователи</a><br>
                    </span>
                    <span>
                        <label>
                            <input id="no_one" value="2" name="private" <?= ($data["user"][0]["actual"] == '2') ? 'checked' : '' ?> class="label_checkbox_3 filter_checkbox" type="radio">
                            <span></span>
                        </label>
                        <a id="checkbox_3" class="checkbox" href="javascript:void(0);">Не видит никто</a><br>
                    </span>
                    <button disabled class="save_private" id="save_private" href="javascript:void(0);">Сохранить</button>
                    <span id="result_visible"></span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div>
<?php if ($data["user"][0]["status"] == '0'): ?>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-dialog" style="margin: 120px auto !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="/assets/images/close.svg" alt="close"></button>
                        <h4 class="modal-title">Проверьте, что вы выполнили <br>все необходимые условия</h4>
                        <p>Анкета полностью заполнена:
                            <span class="connect_check_modal">
                                <?php if ($_SESSION['access']['info']): ?>
                                    <img src="/assets/images/check-circle.svg" alt="">
                                <?php else: ?>
                                    <img src="/assets/images/Close_circle.svg" alt="">
                                <?php endif; ?>
                            </span>
                        </p>
                        <p>Вы получили не менее 2-x рекомендаций:
                            <span class="connect_check_modal">
                                <?php if ($_SESSION['access']['recom']): ?>
                                    <img src="/assets/images/check-circle.svg" alt="">
                                <?php else: ?>
                                    <img src="/assets/images/Close_circle.svg" alt="">
                                <?php endif; ?>
                            </span>
                        </p>
                        <p>У вас есть как-минимум 1 проект:
                            <span class="connect_check_modal">
                                <?php if ($_SESSION['access']['proj']): ?>
                                    <img src="/assets/images/check-circle.svg" alt="">
                                <?php else: ?>
                                    <img src="/assets/images/Close_circle.svg" alt="">
                                <?php endif; ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.open-modal').click(function(){
            $('#myModal').modal('show');
        });
    </script>
<?php endif; ?>
<?php if (isset($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>
