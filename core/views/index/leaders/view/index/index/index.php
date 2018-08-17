<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>
<input type="hidden" name="id_lid" id="id_lid" value="<?= $_GET['id'] ?>">
    <div id="content-main">
        <div class="container-fluid">
            <div class="wrap_admin_links">
                <div class="col-lg-3 back_to_profile">
                    <a href="javascript:history.back()"><img src="/assets/images/arrow_blue.svg" alt=""><span>Вернуться назад</span></a>
                </div>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <div class="col-xs-6 admin_links">
                        <a href="/admin/leaders/edit?id=<?= $_GET['id'] ?>"><span>Редактировать</span></a>
                    </div>
                    <?php if($data['leader'][0]['checked'] == '1'): ?>
                    <div class="col-xs-2 admin_links delete">
                        <a href="javascript:void(0);"><span>Удалить</span></a>
                    </div>
                    <?php elseif($data['leader'][0]['checked'] == '2'): ?>
                        <div class="col-xs-2 admin_links recovery">
                        <a href="javascript:void(0);"><span>Восстановить</span></a>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 wrap_user_info">
                <?php $pos = strripos($data['leader'][0]['image_name'], 'http'); ?>
                <?php if ($pos === false) : ?>
                    <?php if (!empty($data['leader'][0]['image_name'])): ?>
                        <span class="image_name" style="background-image: url('<?= CORE_IMG_PATH . $data['leader'][0]['image_name'] ?>')"></span>
                    <?php else: ?>
                        <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if (!empty($data['leader'][0]['image_name'])): ?>
                        <span class="image_name" style="background-image: url('<?= $data['leader'][0]['image_name'] ?>')"></span>
                    <?php else: ?>
                        <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                    <?php endif; ?>
                <?php endif;?>
                <div class="user_profile_info_box_top">
                    <p class="user_fio"><?= ($data['leader'][0]['fio'] == '') ? 'Не указано' : $data['leader'][0]['fio'] ?></p>
                    <?php if ($data["leader"][0]["status"] == '0'): ?>
                        <p class="user_status register">Зарегистрированный  пользователь <img src="/assets/images/checkmark.svg" alt="check"></p>
                    <?php else: ?>
                        <p class="user_status leader">Лидер <img src="/assets/images/briefcase.svg" alt="briefcase"></p>
                    <?php endif; ?>
                    <div class="mobile_description_box"></div>
                    <p class="user_complete_profile">Заполненность профиля: 10%</p>
                    <p class="user_complete_progress"><progress value="10" max="100"></progress></p>

                    <?php if (!empty($data['leader'][0]['video'])): ?>
                    <div class="wrapper_leaders_info_detail">
                        <a class="look_video" href="javascript:void(0);" onclick="lookVideo('<?= $data['leader'][0]['video'] ?>')"><img class="look_video_img" src="/assets/images/video.svg" alt="look_video_img">Смотреть видеообращение</a><br>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['id'])): ?>
                        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == '3' || $_SESSION['status'] == '2'): ?>
                            <a id="connect_to_leader" class="hidden-xs" href="javascript:void(0);">Связаться</a>
                            <p class="edit_profile"><span class="visible-xs">Напишите мне:</span>
                                <span class="triangle"></span>
                                <span class="leader_experience leader_social">
                                    <?php if (isset($data['leader']['social_user']) && (!empty($data['leader']['social_user']['vk']) || !empty($data['leader']['social_user']['facebook']) || !empty($data['leader']['social_user']['google']) || !empty($data['leader']['social_user']['vk_old']) || !empty($data['leader']['social_user']['facebook_old']) || !empty($data['leader']['social_user']['google_old']))): ?>
                                        <?php if (!empty($data['leader']['social_user']['vk'])): ?>
                                            <a target="_blank" onclick="socialClickLog()"  href="https://vk.com/id<?= $data['leader']['social_user']['vk'] ?>"><img src="/assets/images/VK.svg" alt="vk"></a>
                                        <?php endif; ?>
                                            <?php if (!empty($data['leader']['social_user']['facebook'])): ?>
                                            <a target="_blank" onclick="socialClickLog()"  href="https://www.facebook.com/<?= $data['leader']['social_user']['facebook'] ?>"><img src="/assets/images/FB.svg" alt="v"></a>
                                        <?php endif; ?>
                                            <?php if (!empty($data['leader']['social_user']['google'])): ?>
                                            <a target="_blank" onclick="socialClickLog()"  href="https://plus.google.com/<?= $data['leader']['social_user']['google'] ?>"><img src="/assets/images/G+.svg" alt="google"></a>
                                        <?php endif; ?>
                                            <?php if (!empty($data['leader']['social_user']['vk_old'])): ?>
                                            <a target="_blank" onclick="socialClickLog()"  href="<?= $data['leader']['social_user']['vk_old'] ?>"><img src="/assets/images/VK.svg" alt="vk_old"></a>
                                        <?php endif; ?>
                                            <?php if (!empty($data['leader']['social_user']['facebook_old'])): ?>
                                            <a target="_blank" onclick="socialClickLog()"  href="<?= $data['leader']['social_user']['facebook_old'] ?>"><img src="/assets/images/FB.svg" alt="v"></a>
                                        <?php endif; ?>
                                            <?php if (!empty($data['leader']['social_user']['google_old'])): ?>
                                            <a target="_blank" onclick="socialClickLog()"  href="<?= $data['leader']['social_user']['google_old'] ?>"><img src="/assets/images/G+.svg" alt="google_old"></a>
                                        <?php endif; ?>
                                    <?php else:?>
                                        <span> Не указано</span>
                                    <?php endif; ?>
                                </span><br>
                            </p>
                        <?php else: ?>
                            <span class="connect_to_leader">Связаться: </span><br><span class="no_auth">Для просмора данной информации, станьте рекомендованным лидером</span><br>
                        <?php endif; ?>
                    <?php else: ?>
                        <span>Для просмотра данной информации, пожалуйста <a href="/login">авторизуйтесь</a></span><br>
                    <?php endif; ?>
                </div>
                <div class="user_profile_info_box">
                    <p class="user_profile_info user_city"><img src="/assets/images/coordinates.svg" alt="user_city"> <?= ($data['leader'][0]['city'] == '') ? 'Не указано' : $data['leader'][0]['city'] ?></p>
                    <p class="user_profile_info user_contact_info"><img src="/assets/images/telephone-directory.svg" alt="user_contact_info"> <?= ($data['leader'][0]['contact_info'] == '') ? 'Не указано' : $data['leader'][0]['contact_info']  ?></p>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <p class="user_profile_info user_telephone"><img src="/assets/images/telephone.svg" alt="user_telephone"> <?= ($data['leader'][0]['telephone'] == '') ? 'Не указано' : $data['leader'][0]['telephone'] ?></p>
                        <p class="user_profile_info user_email"><img src="/assets/images/mail.svg" alt="user_email"> <?= ($data['leader'][0]['email'] == '') ? 'Не указано' : $data['leader'][0]['email'] ?></p>
                        <p class="user_profile_info user_birthday"><img src="/assets/images/telephone-directory.svg" alt="user_birthday"> <?= ($data['leader'][0]['birthday'] == '') ? 'Не указано' : $data['leader'][0]['birthday']  ?></p>
                    <?php endif; ?>
                </div>
                <div class="user_profile_info_box">
                    <p class="leaders_connect">
                        <span>Связи с лидером</span><br>
                        <?php if (isset($_SESSION['id'])): ?>
                            <?php if (!empty($data['six_friends_small']) && ($_SESSION['status'] =='3' or $_SESSION['status'] =='2') && $_SESSION['role'] == 'user'): ?>
                                <?php foreach ($data['six_friends_small'] as $key1 => $value1) : ?>
                                    <div class="wrap_leaders_connect link_<?=$key1?>">
                                        <span class="round_six_friends"></span><span>Я</span><br>
                                        <?php foreach ($value1 as $key2 => $value2) : ?>
                                            <?php if ($key2 != $data['user'][0]['id_lid']):?>
                                                <span class="vertical_leaders_connect"></span><br>
                                            <span class="round_six_friends"></span><a href="/index/leaders/view?id=<?= $key2 ?>"><?= $value2[0] ?></a>
                                            <br>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                                <?php if (isset($data['six_friends_small'][1])): ?>
                                <div class="see_more">
                                    <a href="javascript:void(0);" class="">Показать больше</a>
                                </div>
                                <?php endif; ?>
                            <?php elseif (empty($data['six_friends_small']) && ($_SESSION['status'] =='3' or $_SESSION['status'] =='2') && $_SESSION['role'] == 'user'): ?>
                                <p class="no_auth">К сожалению, через 1-2 рукопожатия вы не связаны</p>
                            <?php elseif ($_SESSION['status'] !='3' or $_SESSION['status'] !='2'): ?>
                                <p class="no_auth">Cтаньте рекомендованным лидером, чтобы видеть как вы связаны с лидером</p>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="no_auth">Пожалуйста, <a href="/auth">авторизуйтесь</a> на сайте</p>
                        <?php endif; ?>
                    </p>
                </div>
                <?php if (!empty($data['files']['leaders']) || !empty($data['files']['projects'])): ?>
                <?php if (!empty($data['files']['leaders'])): ?>
                    <?php foreach ($data['files']['leaders'] as $key => $value): ?>
                        <?php if ($value['title'] == '') $value['title'] = 'Без названия'; ?>
                        <?php if ($value['ext'] == 'doc' || $value['ext'] == 'docx' || $value['ext'] == 'txt'): ?>
                            <div class="user_profile_info_box">
                                <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                    <div class="col-xs-2"><img src="/assets/images/DOC.svg" alt="file"></div>
                                    <div class="col-xs-8">
                                        <p class="titles_file_user"><?= $value['title'] ?></p>
                                        <p class="sizes_file_user"><?= $value['description'] ?></p>
                                        <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                    </div>
                                    <div class="col-xs-2 comment_img">
                                        <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php elseif ($value['ext'] == 'jpg' || $value['ext'] == 'png' || $value['ext'] == 'jpeg' || $value['ext'] == 'jpg'): ?>
                            <div class="user_profile_info_box">
                                <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                    <div class="col-xs-2"><img src="/assets/images/JPG.svg" alt="file"></div>
                                    <div class="col-xs-8">
                                        <p class="titles_file_user"><?= $value['title'] ?></p>
                                        <p class="sizes_file_user"><?= $value['description'] ?></p>
                                        <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                    </div>
                                    <div class="col-xs-2 comment_img">
                                        <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php elseif ($value['ext'] == 'pdf'): ?>
                            <div class="user_profile_info_box">
                                <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                    <div class="col-xs-2"><img src="/assets/images/PDF.svg" alt="file"></div>
                                    <div class="col-xs-8">
                                        <p class="titles_file_user"><?= $value['title'] ?></p>
                                        <p class="sizes_file_user"><?= $value['description'] ?></p>
                                        <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                    </div>
                                    <div class="col-xs-2 comment_img">
                                        <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="user_profile_info_box">
                                <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                    <div class="col-xs-2"><img src="/assets/images/NONE.svg" alt="file"></div>
                                    <div class="col-xs-8">
                                        <p class="titles_file_user"><?= $value['title'] ?></p>
                                        <p class="sizes_file_user"><?= $value['description'] ?></p>
                                        <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                    </div>
                                    <div class="col-xs-2 comment_img">
                                        <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (!empty($data['files']['projects'])): ?>
                        <?php foreach ($data['files']['projects'] as $key => $value): ?>
                            <?php if ($value['title'] == '') $value['title'] = 'Без названия'; ?>
                            <?php if ($value['ext'] == 'doc' || $value['ext'] == 'docx' || $value['ext'] == 'txt'): ?>
                                <div class="user_profile_info_box">
                                    <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                        <div class="col-xs-2"><img src="/assets/images/DOC.svg" alt="file"></div>
                                        <div class="col-xs-8">
                                            <p class="titles_file_user"><?= $value['title'] ?></p>
                                            <p class="sizes_file_user"><?= $value['description'] ?></p>
                                            <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                        </div>
                                        <div class="col-xs-2 comment_img">
                                            <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                        </div>
                                    </a>
                                </div>
                            <?php elseif ($value['ext'] == 'jpg' || $value['ext'] == 'png' || $value['ext'] == 'jpeg' || $value['ext'] == 'jpg'): ?>
                                <div class="user_profile_info_box">
                                    <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                        <div class="col-xs-2"><img src="/assets/images/JPG.svg" alt="file"></div>
                                        <div class="col-xs-8">
                                            <p class="titles_file_user"><?= $value['title'] ?></p>
                                            <p class="sizes_file_user"><?= $value['description'] ?></p>
                                            <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                        </div>
                                        <div class="col-xs-2 comment_img">
                                            <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                        </div>
                                    </a>
                                </div>
                            <?php elseif ($value['ext'] == 'pdf'): ?>
                                <div class="user_profile_info_box">
                                    <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                        <div class="col-xs-2"><img src="/assets/images/PDF.svg" alt="file"></div>
                                        <div class="col-xs-8">
                                            <p class="titles_file_user"><?= $value['title'] ?></p>
                                            <p class="sizes_file_user"><?= $value['description'] ?></p>
                                            <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                        </div>
                                        <div class="col-xs-2 comment_img">
                                            <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                        </div>
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="user_profile_info_box">
                                    <a class="user_files" href="/index/comments/file?id=<?= $value['id'] ?>">
                                        <div class="col-xs-2"><img src="/assets/images/NONE.svg" alt="file"></div>
                                        <div class="col-xs-8">
                                            <p class="titles_file_user"><?= $value['title'] ?></p>
                                            <p class="sizes_file_user"><?= $value['description'] ?></p>
                                            <p class="sizes_file_user"><?= normal_size($value['size']) ?></p>
                                        </div>
                                        <div class="col-xs-2 comment_img">
                                            <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="user_profile_info_box">
                        <a class="user_files" href="javascript:void(0)">
                            <div class="col-xs-2 no_files_img"><img src="/assets/images/NONE.svg" alt="file"></div>
                            <div class="col-xs-8">
                                <p class="titles_file_user no_files_title">Нет прикрепленных файлов</p>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($data['links']['leaders']) || !empty($data['links']['projects'])): ?>
                     <?php if (!empty($data['links']['leaders'])): ?>
                        <?php foreach ($data['links']['leaders'] as $key => $value): ?>
                            <?php if ($value['title'] == '') $value['title'] = 'Без названия'; ?>
                            <div class="user_profile_info_box">
                                <a class="user_files" href="/index/comments/link?id=<?= $value['id'] ?>">
                                    <div class="col-xs-2"><img src="/assets/images/HTML.svg" alt="file"></div>
                                    <div class="col-xs-8">
                                        <p class="titles_link_user"><?= $value['title'] ?></p>
                                    </div>
                                    <div class="col-xs-2 comment_img">
                                        <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (!empty($data['links']['projects'])): ?>
                        <?php foreach ($data['links']['projects'] as $key => $value): ?>
                            <?php if ($value['title'] == '') $value['title'] = 'Без названия'; ?>
                            <div class="user_profile_info_box">
                                <a class="user_files" href="/index/comments/link?id=<?= $value['id'] ?>">
                                    <div class="col-xs-2"><img src="/assets/images/HTML.svg" alt="file"></div>
                                    <div class="col-xs-8">
                                        <p class="titles_link_user"><?= $value['title'] ?></p>
                                    </div>
                                    <div class="col-xs-2 comment_img">
                                        <span class="comments"><img src="/assets/images/news_message.svg" alt=""><?= $value['count'][0]['comments_count'] ?></span>
                                    </div>
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
            </div>
            <div class="col-lg-9 mobile">
                <div class="user_profile_info_box projects">
                    <div class="projects_box">Проекты лидера</div>
                    <?php if (!empty($data['projects'][0]['project_title'])): ?>
                        <?php foreach ($data['projects'] as $key => $value): ?>
                        <a class="link_project_leader" href="/index/projects/view?id=<?= $value['id_proj'] ?>">
                            <div class="wrapper_projects">
                                <div class="col-lg-2">
                                        <?php $pos = strripos($value['image_name'], 'http'); ?>
                                        <?php if ($pos === false) : ?>
                                            <?php if (!empty($value['image_name'])): ?>
                                                <span class="project_image" style="background-image: url('<?= CORE_IMG_PATH . $value['image_name'] ?>')"></span>
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
                                <div class="col-lg-9"><span class="projects_background"></span><span class="project_title"><?= $value['project_title'] ?></span><br><span class="project_description"><?= $value['project_description'] ?></span></div>
                                <div class="col-lg-1"><span class="project_link"></span></div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="projects_none">Нет проектов</span>
                    <?php endif; ?>
                </div>
                <div class="user_profile_info_box tags_box">
                    <div class="projects_box links tags">Обмен опытом</div>
<!--                    --><?php //if (empty($data['tags']['tag_i_want']) && empty($data['tags']['tag_i_can'])): ?>
<!--                        <div class="col-lg-12"><span class="no_tags_leader_notice">Не указано</span></div>-->
<!--                    --><?php //else: ?>
                        <div class="col-lg-6">
                            <p class="i_want">Мне нужно</p>
                            <?php if (!empty($data['tags']['tag_i_want'])): ?>
                                <?php foreach ($data['tags']['tag_i_want'] as $key => $value): ?>
                                    <span class="tag_i_want"><?= $value['tag_i_want'] ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="leader_havnt_tag">Не указано</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <p class="i_can">Могу поделиться</p>
                            <?php if (!empty($data['tags']['tag_i_can'])): ?>
                                <?php foreach ($data['tags']['tag_i_can'] as $key => $value): ?>
                                    <span class="tag_i_can"><?= $value['tag_i_can'] ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="leader_havnt_tag">Не указано</span>
                            <?php endif; ?>
                        </div>
<!--                    --><?php //endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-dialog" style="margin: 120px auto !important;">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="videoModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>