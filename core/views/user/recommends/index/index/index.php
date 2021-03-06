<?php include CORE_DIR . '/core/views/layouts/header/index/index/index.php'; ?>
    <div id="content-main">
        <div class="container-fluid">
            <div class="col-xs-12">
                <div class="user_profile_info_box recommends">
                    <div class="recommends_box">
                        <div class="recommends_box_inner left">Рекомендованные лидеры</div>
                        <?php if(!empty($data['recommend'])): ?>
                            <div class="recommends_box_inner right"><a href="/leaders/add">Добавить рекомендацию</a></div>
                        <?php endif; ?>
                    </div>
                    <?php if(!empty($data['recommend'])): ?>
                        <?php foreach ($data['recommend'] as $key => $value): ?>
                            <div class="wrapper_recommends">
                                <div class="col-lg-2">
                                    <?php $pos = strripos($value['image_name'], 'http'); ?>
                                    <?php if ($pos === false) : ?>
                                        <?php if (!empty($value['image_name'])): ?>
                                            <span class="leaders_photo" style="background-image: url('<?= CORE_IMG_PATH . $value['image_name'] ?>')"></span>
                                        <?php else: ?>
                                            <span class="leaders_photo" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if (!empty($value['image_name'])): ?>
                                            <span class="leaders_photo" style="background-image: url('<?= $value['image_name'] ?>')"></span>
                                        <?php else: ?>
                                            <span class="leaders_photo" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                        <?php endif; ?>
                                    <?php endif;?>
                                </div>
                                <div class="col-lg-7"><span class="recommend_leader"><?= $value['fio'] ?></span><br>
                                    <span class="recommend_span">Причина рекомендации</span><br>
                                    <span class="recommend_reason"><?= $value['reason'] ?></span><br>
                                </div>
                                <div id="result_public_<?= $value['id_lid'] ?>" class="col-xs-3 buttons result_public">
                                    <a class="trash_btn" href="javascript:void(0)" onclick="deleteRecom('2', <?= $value['id_lid'] ?>)"></a>

                                    <a class="edit_btn" href="/recommends/edit?id=<?= $value['id_lid'] ?>"></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php if(!$_SESSION['access']['recom']): ?>
                            <div class="wrapper_recommends">
                                    <div class="col-lg-12">
                                        <p>Для того, чтобы иметь возможность рекомендовать других - получите не менее 2-х рекомендаций других лидеров.</p>
                                    </div>
                            </div>
                        <?php else: ?>
                            <div class="wrapper_recommends">
                                    <div class="col-lg-12">
                                        <p>Вы не рекомендовали лидеров.</p>
                                    </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php include CORE_DIR . '/core/views/layouts/footer/index/index/index.php' ?>






