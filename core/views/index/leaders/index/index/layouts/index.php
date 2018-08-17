<div class="container-fluid">
    <div class="col-xs-12 visible-xs">
        <div class="wrapper_leaders_filter main_mobile" onclick="main_filter_leaders()">
            <select id="min_filter"class="selectpicker"><option value="all" class="title">Фильтры</option></select>
        </div>
    </div>
    <div class="mobile_filter">
        <div class="col-xs-12">
            <div class="wrapper_leaders_filter">
                <select id="fio_filter" data-live-search="true" class="selectpicker" onchange="FilterLeaders();">
                    <option value="all" class="title">Выберите лидера</option>
                    <?php if (!empty($data['filter']['fio'])): ?>
                        <?php foreach ($data['filter']['fio'] as $filter): ?>
                        <?php if ($filter['fio'] == "") continue; ?>
                            <option <?= (isset($_POST['fio_filter']) && $_POST['fio_filter'] == $filter['fio']) ? 'selected' : '' ?> value="<?= $filter['fio']?>"><?=$filter['fio']?></option>;
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="all">Нет данных</option>
                    <?php endif; ?>
                </select>
                <select id="city_filter" data-live-search="true" class="selectpicker" onchange="FilterLeaders();">
                    <option value="all" class="title">Выберите город</option>
                    <?php if (!empty($data['filter']['city'])): ?>
                        <?php foreach ($data['filter']['city'] as $filter) : ?>
                            <?php if ($filter['city'] == "") continue; ?>
                                <option <?= (isset($_POST['city_filter']) && $_POST['city_filter'] == $filter['city']) ? 'selected' : '' ?> value="<?=$filter['city']?>"><?= $filter['city'] ?></option>;
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="all">Нет данных</option>
                    <?php endif; ?>
                </select>
                <select id="want_filter" data-live-search="true" class="selectpicker" <?= (!$data['access_full'] ? 'disabled' : '') ?> onchange="FilterLeaders();">
                    <option value="all" class="title">Лидер хочет</option>
                    <?php if (!empty($data['filter']['tag_i_want'])): ?>
                        <?php foreach ($data['filter']['tag_i_want'] as $filter) : ?>
                            <?php if ($filter['tag_i_want'] == "") continue; ?>
                                <option <?= (isset($_POST['want_filter']) && $_POST['want_filter'] == $filter['id']) ? 'selected' : '' ?> value="<?= $filter['id'] ?>"><?= $filter['tag_i_want'] ?></option>;
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="all">Нет данных</option>
                    <?php endif; ?>
                </select>
                <select id="can_filter" data-live-search="true" class="selectpicker" <?= (!$data['access_full'] ? 'disabled' : '') ?> onchange="FilterLeaders();">
                    <option value="all" class="title">Лидер может</option>
                    <?php if (!empty($data['filter']['tag_i_can'])): ?>
                        <?php foreach ($data['filter']['tag_i_can'] as $filter) : ?>
                            <?php if ($filter['tag_i_can'] == "") continue; ?>
                                <option <?= (isset($_POST['can_filter']) && $_POST['can_filter'] == $filter['id']) ? 'selected' : '' ?> value="<?= $filter['id']?>"><?= $filter['tag_i_can'] ?></option>;
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="all">Нет данных</option>
                    <?php endif; ?>
                </select>
                <a class="clear_filter hidden-xs" href="javascript:void(0);" onclick="ClearFilter();">Сбросить фильтр</a>
            </div>
        </div>
        <div class="col-xs-12 checkbox_box">
            <span><label><input <?= (!$data['access_full'] ? 'disabled' : '') ?> id="help_to_me" <?= ((isset($_POST['help_to_me']) && $_POST['help_to_me'] == '1') ? 'checked' : '') ?> class="label_checkbox_1 filter_checkbox" type="radio" name="helper"><span></span></label> <a id="checkbox_1" class="<?= (!$data['access_full'] ? 'checkbox_not_auth' : 'checkbox') ?>" href="javascript:void(0);">Сначала кто полезен мне</a></span>
            <span><label><input <?= (!$data['access_full'] ? 'disabled' : '') ?> id="i_can_help" <?= ((isset($_POST['i_can_help']) && $_POST['i_can_help'] == '1') ? 'checked' : '') ?> class="label_checkbox_2 filter_checkbox" type="radio" name="helper"><span></span></label> <a id="checkbox_2" class="<?= (!$data['access_full'] ? 'checkbox_not_auth' : 'checkbox') ?>" href="javascript:void(0);">Сначала кому полезен я</a></span>
            <span><label><input id="a_z" <?= ((isset($_POST['a_z']) && $_POST['a_z'] == '1') ? 'checked' : '') ?> class="label_checkbox_3 filter_checkbox" type="radio" name="helper"><span></span></label> <a id="checkbox_3" class="checkbox" href="javascript:void(0);">А-Я</a></span>
            <span><label><input id="z_a" <?= ((isset($_POST['z_a']) && $_POST['z_a'] == '1') ? 'checked' : '') ?> class="label_checkbox_4 filter_checkbox" type="radio" name="helper"><span></span></label> <a id="checkbox_4" class="checkbox" href="javascript:void(0);">Я-А</a></span>
            <a class="clear_filter visible-xs" href="javascript:void(0);" onclick="ClearFilter();">Сбросить фильтр</a>
            <a href="javascript:void(0)" class="close_main_filter visible-xs">Вернуться назад</a>
        </div>
    </div>
    <?php if (!empty($data['leader'])): ?>
        <?php foreach ($data['leader'] as $leader): ?>
            <div class="col-xs-12 leaders_block">
                <div id="leaders_info_<?=$leader['id_lid']?>" class="wrapper_leaders_info leaders_info">
                    <div class="col-xs-12 col-lg-3">

                        <?php $pos = strripos($leader['image_name'], 'http'); ?>
                        <?php if ($pos === false) : ?>
                            <?php if (!empty($leader['image_name'])): ?>
                                <span class="leader_image" style="background-image: url('<?= CORE_IMG_PATH . $leader['image_name'] ?>')"></span>
                            <?php else: ?>
                                <span class="leader_image" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if (!empty($leader['image_name'])): ?>
                                <span class="leader_image" style="background-image: url('<?= $leader['image_name'] ?>')"></span>
                            <?php else: ?>
                                <span class="leader_image" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                            <?php endif; ?>
                        <?php endif;?>
                        <div class="leaders_info_mobile visible-xs">
                            <?php if ($leader['user_id'] == '0'): ?>
                                <span class="leaders_fio visible-xs"><?= $leader['fio'] ?></span><span class="auth not_auth visible-xs">Не авторизован</span><br>
                            <?php else: ?>
                                <span class="leaders_fio visible-xs"><?= $leader['fio'] ?></span><span class="auth visible-xs">Авторизован</span><br>
                            <?php endif; ?>
                            <?php if (!empty($leader['city'])): ?>
                                <span class="leaders_city visible-xs"><?= $leader['city'] ?></span><br>
                            <?php else: ?>
                                <span class="leaders_city visible-xs">Не указано</span><br>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-7 leader_info_box_width">
                        <?php if ($leader['user_id'] == '0'): ?>
                            <span class="leaders_fio hidden-xs"><?= $leader['fio'] ?><span class="auth not_auth hidden-xs">Не авторизован</span></span><br>
                        <?php else: ?>
                            <span class="leaders_fio hidden-xs"><?= $leader['fio'] ?><span class="auth hidden-xs">Авторизован</span></span><br>
                        <?php endif; ?>
                        <?php if (!empty($leader['city'])): ?>
                            <span class="leaders_city hidden-xs"><?= $leader['city'] ?></span><br>
                        <?php else: ?>
                            <span class="leaders_city hidden-xs">Не указано</span><br>
                        <?php endif; ?>

                        <span class="leaders_files_number"><img src="/assets/images/paperclip.svg" alt=""> <?= (isset($leader['files']) ? $leader['files'][0]["COUNT(*)"] : '') ?></span><span class="leaders_files"> прикрепленных файлов и </span> <?= (isset($leader['links']) ? $leader['links'][0]["COUNT(*)"] : '') ?><span class="leaders_files">ссылок</span><br>
                        <?php if (isset($_SESSION['id']) && $_SESSION['role'] == 'user' && !$_SESSION['access']['tags']): ?>
                            <span class="leaders_tags"><img src="/assets/images/experience.svg" alt=""> Заполните <a href="">Хочу / Могу</a> в своем профиле,<br>чтобы просматривать их у других лидеров</span>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['id']) && ($_SESSION['access']['tags'] || $_SESSION['role'] == 'admin')): ?>
                            <div class="wrapper_tags">
                                <?php if (!empty($leader["tag_i_can"][0])): ?>
                                    <?php foreach ($leader["tag_i_can"] as $key => $value): ?>
                                        <?php if ($value != ''): ?>
                                            <span class="tags leaders_tag_i_can"><?= $value['tag_i_can'] ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if (!empty($leader["tag_i_want"][0])): ?>
                                    <?php foreach ($leader["tag_i_want"] as $key => $value): ?>
                                        <?php if ($value != ''): ?>
                                            <span class="tags leaders_tag_i_want"><?= $value['tag_i_want'] ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['id'])): ?>
                                <span class="leaders_tags"><img src="/assets/images/experience.svg" alt=""> Для просмотра данной информации пожалуйста, <a href="/login">авторизуйтесь</a> на сайте и заполните Хочу/Могу в своем профиле</span>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-2">
                        <span class="leader_projects">Проекты у лидера:</span><br>
                        <?php if (isset($leader['projects'])): ?>
                            <?php foreach ($leader['projects'] as $key => $value): ?>
                                <span class="leader_project_name"><a href="/index/projects/view?id=<?= $value['id_proj'] ?>"><?= $value['project_title'] ?></a></span>
                                <br>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="leader_project_name">Нет проектов</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="leader_detail_info leaders_info_<?= $leader['id_lid'] ?>_detail">
                    <div class="wrapper_leaders_info_detail">
                        <div class="inner_wrap_detail_info"><span class="arrow_left_detail_info"></span></div>
                        <?php if (isset($_SESSION['id'])): ?>
                            <?php if (isset($_SESSION['id'])): ?>
                                <?php if (!empty($leader['friends']) && ($_SESSION['status'] =='3' or $_SESSION['status'] =='2') && $_SESSION['role'] == 'user'): ?>
                                    <span class="leader_experience">Связь с лидером:</span><br>
                                    <?php foreach ($leader['friends'] as $key1 => $value1) : ?>
                                        <div class="wrap_leaders_connect link_<?=$key1?>">
                                            <span class="round_six_friends"></span><span>Я</span><br>
                                            <?php foreach ($value1 as $key2 => $value2): ?>
                                                <?php if ($key2 != $_SESSION['id_lid']): ?>
                                                    <span class="vertical_leaders_connect"></span><br>
                                                    <span class="round_six_friends"></span><a href="/index/leaders/view?id=<?= $key2 ?>"><?= $value2[0] ?></a>
                                                    <br>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php if (isset($leader['friends'][1])): ?>
                                        <div class="see_more">
                                            <a href="javascript:void(0);" class="">Показать больше</a>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif (empty($leader['friends']) && ($_SESSION['status'] =='3' or $_SESSION['status'] =='2') && $_SESSION['role'] == 'user'): ?>
                                    <span class="leader_experience">Связь с лидером:</span> <span>К сожалению, через 1-2 рукопожатия вы не связаны</span><br>
                                <?php elseif ($_SESSION['status'] != '3' or $_SESSION['status'] != '2'): ?>
                                    <span class="leader_experience">Связь с лидером:</span> <span>Cтаньте рекомендованным лидером, чтобы видеть как вы связаны</span><br>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="leader_experience">Связь с лидером:</span> <span>Пожалуйста, <a href="/auth">авторизуйтесь</a> на сайте</span><br>
                            <?php endif; ?>
                        <span class="leader_experience leader_social">Страница в социальных сетях:
                            <?php if (isset($leader['social_user']) && (!empty($leader['social_user']['vk']) || !empty($leader['social_user']['facebook']) || !empty($leader['social_user']['google']) || !empty($leader['social_user']['vk_old']) || !empty($leader['social_user']['facebook_old']) || !empty($leader['social_user']['google_old']))): ?>
                                    <?php if (!empty($leader['social_user']['vk'])): ?>
                                        <a target="_blank" href="https://vk.com/id<?= $leader['social_user']['vk'] ?>"><img src="/assets/images/VK.svg" alt="vk"></a>
                                    <?php endif; ?>
                                    <?php if (!empty($leader['social_user']['facebook'])): ?>
                                        <a target="_blank" href="https://www.facebook.com/<?= $leader['social_user']['facebook'] ?>"><img src="/assets/images/FB.svg" alt="v"></a>
                                    <?php endif; ?>
                                    <?php if (!empty($leader['social_user']['google'])): ?>
                                        <a target="_blank" href="https://plus.google.com/<?= $leader['social_user']['google'] ?>"><img src="/assets/images/G+.svg" alt="google"></a>
                                    <?php endif; ?>
                                    <?php if (!empty($leader['social_user']['vk_old'])): ?>
                                        <a target="_blank" href="<?= $leader['social_user']['vk_old'] ?>"><img src="/assets/images/VK.svg" alt="vk_old"></a>
                                    <?php endif; ?>
                                    <?php if (!empty($leader['social_user']['facebook_old'])): ?>
                                        <a target="_blank" href="<?= $leader['social_user']['facebook_old'] ?>"><img src="/assets/images/FB.svg" alt="v"></a>
                                    <?php endif; ?>
                                    <?php if (!empty($leader['social_user']['google_old'])): ?>
                                        <a target="_blank" href="<?= $leader['social_user']['google_old'] ?>"><img src="/assets/images/G+.svg" alt="google_old"></a>
                                    <?php endif; ?>
                            <?php else:?>
                                <span> Не указано</span>
                            <?php endif; ?>
                        </span><br>
                        <?php else: ?>
                            <span class="leader_experience">Связь с лидером:</span> <span>Для просмотра данной информации, пожалуйста <a href="/index/login">авторизуйтесь</a></span><br>
                        <?php endif; ?>
                        <?php if (!empty($leader['video'])): ?>
                            <a class="look_video" href="javascript:void(0);" onclick="lookVideo('<?= $leader['video'] ?>')"><img class="look_video_img" src="/assets/images/video.svg" alt="look_video_img">Смотреть видеообращение</a><br>
                        <?php endif; ?>
                        <a class="open_profile_leader_btn" href="/index/leaders/view?id=<?= $leader['id_lid'] ?>"><span>Открыть профиль</span></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div id="videoModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        <?php if ($data['countpages'] > 1): ?>
            <div class="container-fluid">
                <div id="navigation" class="col-xs-12">
                    <nav class="nav_page" aria-label="Page navigation" style="text-align: center;">
                        <ul class="pagination">

                            <li <?= ($data['numpage'] <= 1 ? 'class="disabled"' : '') ?>>
                                <a href="javascript:void(0);" onclick="FilterLeaders(1); return up();" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <?php
                            $limit = ($data['countpages'] < 5) ? $data['countpages'] : 5;
                            $left = $data['numpage'] - 2;
                            $right = $data['numpage'] + 2;

                            if ($left < 1) {
                                $left = 1;
                                $right = $left + $limit - 1;
                            }
                            if ($right > $data['countpages']) {
                                $right = $data['countpages'];
                                $left = $right - $limit + 1;
                            }
                            ?>

                            <?php for ($i = $left; $i <= $right; $i++): ?>
                                <li <?= ($data['numpage'] == $i ? 'class="active"' : '') ?>>
                                    <a href="javascript:void(0);" onclick="FilterLeaders(<?= $i ?>); return up();"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <li <?= ($data['numpage'] == $data['countpages'] ? 'class="disabled"' : '') ?>>
                                <a href="javascript:void(0);" onclick="FilterLeaders(<?= $data['countpages'] ?>); return up();" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
    <div class="col-xs-12 leaders_block">
        <div>
            <span class="not_found">По вашему запросу ничего не найдено</span>
        </div>
    </div>
    <?php endif; ?>
</div>
<div id="videoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<script>
    $('.selectpicker').selectpicker('refresh');
    $('.selectpicker').selectpicker({ size: 8 });
</script>
<?php if (isset($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>
<!--<script src="/assets/js/leaders/index/script.js"></script>-->