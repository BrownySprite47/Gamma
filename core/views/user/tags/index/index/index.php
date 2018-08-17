<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>
    <div id="content-main">
        <div class="container">
            <?php if (!$_SESSION['access']['info'] || !$_SESSION['access']['proj'] || !$_SESSION['access']['recom']): ?>
                <div class="col-xs-12">
                    <div class="user_profile_info_box title_main_header">
                        <p class="title_tags">Ощути Пульс Карты</p>
                        <p>Тэги видны только рекомендованным лидерам инноваций в образовании.</p>
                        <p>Чтобы увидеть, что сейчас важно другим, и чем они могут поделиться - заполните поля "Мне нужно" / "Могу поделиться"</p>
                        <p>Для того, чтобы иметь возможноcть добавлять теги - заполните анкету, добавьте проект и получите не менее 2-х рекомендаций</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-xs-12 tags mobile_popup_hidden">
                    <div class="user_profile_info_box title_main_header">
                        <p class="title_tags">Ощути Пульс Карты</p>
                        <p>Тэги видны только рекомендованным лидерам инноваций в образовании.</p>
                        <p>Чтобы увидеть, что сейчас важно другим, и чем они могут поделиться - заполните поля "Мне нужно" / "Могу поделиться"</p>
                    </div>
                </div>
                <div class="col-xs-12 tags mobile_popup_hidden">
                    <div class="user_profile_info_box tags">
                        <div class="tags_box">
                            <div class="tags_box_inner">Мои теги</div>
                        </div>
                        <div class="wrapper_inn_tags">
                            <div class="wrapper_projects">
                                <div class="col-lg-6">
                                    <div class="widget2">
                                        <div>
                                            <p>Мне нужно</p>
                                        </div>
                                    </div>
                                    <div class='widget-container' id='bootstrap1'>
                                        <?php foreach ($data['tags']['tag_i_want'] as $key => $value): ?>
                                            <div class='widget'>
                                                <div class='widget-head'>
                                                    <span class="tag_name" style="display: none;"><?= $value['name']?></span>
                                                    <span class="tag_tag_i_can" style="display: none;"><?= $value['tag_i_can']?></span>
                                                    <span class="tag_tag_i_want" style="display: none;"><?= $value['tag_i_want']?></span>
                                                </div>
                                                <input class='widget-head-id' name="item_<?= $value['id']?>" value="<?= $value['id']?>" style="display: none;">
                                            </div>
                                        <?php endforeach; ?>
                                        <div id="widget_empty_1" class='widget empty visible-xs'><span>+</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="widget2">
                                        <div>
                                            <p>Могу поделиться</p>
                                        </div>
                                    </div>
                                     <div class='widget-container' id='bootstrap2'>
                                        <?php foreach ($data['tags']['tag_i_can'] as $key => $value): ?>
                                            <div class='widget'>
                                                <div class='widget-head'>
                                                    <span class="tag_name" style="display: none;"><?= $value['name']?></span>
                                                    <span class="tag_tag_i_can" style="display: none;"><?= $value['tag_i_can']?></span>
                                                    <span class="tag_tag_i_want" style="display: none;"><?= $value['tag_i_want']?></span>
                                                </div>
                                                <input class='widget-head-id' name="item_<?= $value['id']?>" value="<?= $value['id']?>" style="display: none;">
                                            </div>
                                        <?php endforeach; ?>
                                         <div id="widget_empty_2" class='widget empty visible-xs'><span>+</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="place">
                </div>
                <div class="col-xs-12 mobile_list">
                    <div class="user_profile_info_box tags list">
                        <div class="tags_box">
                            <div class="tags_box_inner">Список тегов</div>
                        </div>
                        <div class="wrapper_projects">
                            <div class='widget-container' id='foundation'>
                                <?php foreach ($data['tags']['none'] as $key => $value): ?>
                                    <?php if ($value['checked'] == '1'): ?>
                                    <div class='widget old_tags'>
                                        <div class='widget-head'>
                                            <span class="tag_name" style="display: none;"><?= $value['name']?></span>
                                            <span class="tag_tag_i_can" style="display: none;"><?= $value['tag_i_can']?></span>
                                            <span class="tag_tag_i_want" style="display: none;"><?= $value['tag_i_want']?></span>
                                        </div>
                                        <input class='widget-head-id' name="item_<?= $value['id']?>" value="<?= $value['id']?>" style="display: none;">
                                    </div>
                                    <?php else: ?>
                                    <div class='widget new_tags'>
                                        <div class='widget-head-2'>
                                            <span class="tag_name" style="display: none;"><?= $value['name']?></span>
                                            <span class="tag_tag_i_can" style="display: none;"><?= $value['tag_i_can']?></span>
                                            <span class="tag_tag_i_want" style="display: none;"><?= $value['tag_i_want']?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div class="wrap_buttons visible-xs">
                                    <div class="col-xs-12 wrap_btn"><a id="close_widget_list" class="back_btn" href="javascript:void(0)">Вернуться назад</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 tags mobile_popup_hidden">
                    <div class="user_profile_info_box">
                        <div class="tags_box">
                            <div class="tags_box_inner">Предложить новый</div>
                        </div>
                        <div class="wrapper_tags_add">
                            <p>Название тега</p>
                            <input type="text" class="form-control add_input_tag" id="addUserTagId"><a onclick="add();" href="javascript:void(0)"><input class="add_btn_tag" type="submit" value="Отправить"></a>
                            <img class="add_input_tag_img" src="/assets/images/check.svg" alt="check"><span id="result_status_new_tag">Добавленный тэг станет активным, когда администратор добавит его в перечень тэгов.</span>
                        </div>
                    </div>
                    <div class="wrap_buttons">
                        <div class="col-lg-6 wrap_btn"><a onclick="send();" href="javascript:void(0)"><input class="save_btn" type="submit" value="Сохранить все"></a></div>
                        <div class="col-lg-4 wrap_btn"><a class="back_btn" href="/user">Вернуться в профиль</a></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'></script>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>
