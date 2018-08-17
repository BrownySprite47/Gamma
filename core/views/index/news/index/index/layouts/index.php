<div class="container-fluid">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-xs-12">
                <?php if (isset($data['news'][0])): ?>
                    <a style="background-image: url(<?= !empty($data['news'][0]['image']) ? CORE_IMG_PATH . $data['news'][0]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)" class="news_main_link" href="/index/news/view?id=<?= $data['news'][0]['id'] ?>">
                        <div class="description_box">
                            <div class="inner">
                                <span class="important_news">Главное</span><span class="pubdate_news"><img src="/assets/images/news_clock.svg" alt=""><?= $data['news'][0]['pubdate'] ?></span><span class="author_news"><img src="/assets/images/news_autor.svg" alt=""><?= $data['news'][0]['fio'] ?></span>
                                <span class="news_title_main"><?= $data['news'][0]['title'] ?></span>
                                <span class="news_description_main"><?= $data['news'][0]['prev_content'] ?></span>
                            </div>
                        </div>
                    </a>
                <?php else: ?>
                    <p>На данный момент на проекте нет новостей. </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="wrapper_carousel_owl">
                <div class="inner_carousel_owl col-lg-12">
                    <a class="carousel-control left" href="javascript:void(0)" id="js-prev">
                        <img src="/assets/images/news_arrow_left.svg" alt=""><span class="sr-only">Предыдущий</span>
                    </a>
                    <a class="carousel-control right" href="javascript:void(0)" id="js-next">
                        <img src="/assets/images/news_arrow_right.svg" alt=""><span class="sr-only">Следующий</span>
                    </a>
                </div>
                <div id="carousel">
                    <?php if (!empty($data['news'])): ?>
                        <?php foreach ($data['news'] as $key => $news): ?>
                            <?php if (!empty($data['news'][$key]['title'])): ?>
                                <div class="carousel-element">
                                    <a class="news_small_link" href="/index/news/view?id=<?= $data['news'][$key]['id'] ?>">
                                        <div class="description_box">
                                            <span class="image_small_news" style="background-image: url(<?= !empty($data['news'][$key]['image']) ? CORE_IMG_PATH . $data['news'][$key]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                            <span class="pubdate_news_small"><img src="/assets/images/news_clock_blue.svg" alt=""><?= $data['news'][$key]['pubdate'] ?></span>
                                            <span class="news_title_small"><?= $data['news'][$key]['title'] ?></span>
                                            <span class="news_description_small"><?= $news['prev_content'] ?>...</span>
                                            <div class="over_box_background"></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div id="slide_1" class="item active">
                            <p>На данный момент на проекте нет новостей. </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="right_info"><img src="/assets/images/news_share.svg" alt=""><strong><?= $data['leaders_count'][0]['count_lid'] ?></strong><span>лидеров в базе Навигатора</span></div>
        <div class="right_info"><img src="/assets/images/news_user.svg" alt=""><strong><?= $data['recommends_count'][0]['count_recom'] ?></strong><span>рекомендаций в GAMMA</span></div>
        <div class="info_box">
            <div class="info_count">6 новых уведомлений</div>
        </div>
        <div class="right_info right_info_count">
            <?php if (!empty($data['events'])): ?>
                <?php foreach ($data['events'] as $event): ?>
                    <div class="row wrap_event_descr">
                        <?php switch ($event["event"]) {
                            case '3':
                                ?> <div class="col-xs-2"><img src="/assets/images/news_new_reg.svg" alt=""></div><div class="col-xs-9 event_descr">Новый зарегистрированный пользователь</div> <?php
                                break;
                            case '4':
                                ?> <div class="col-xs-2"><img src="/assets/images/news_new_reg.svg" alt=""></div><div class="col-xs-9 event_descr">Появилась новая рекомендация</div> <?php
                                break;
                            case '5':
                                ?> <div class="col-xs-2"><img src="/assets/images/news_autorize.svg" alt=""></div><div class="col-xs-9 event_descr">Авторизовался новый лидер <a href="/index/leaders/view?id=<?= $event["user"] ?>"><?= $event['leader_fio']?></a></div> <?php
                                break;
                            case '6':
                                ?> <div class="col-xs-2"><img src="<?= !empty($event["image_name"]) ? CORE_IMG_PATH . $event["image_name"] : CORE_IMG_PATH . 'img_not_found.png' ?>" alt=""></div><div class="col-xs-9 event_descr">Обновлена информация о проекте <a href="/index/projects/view?id=<?= $event["id_proj"] ?>"><?= $event['project_title']?></a></div> <?php
                                break;
                            case '10':
                                ?> <div class="col-xs-2"><img src="<?= !empty($event["image_name"]) ? CORE_IMG_PATH . $event["image_name"] : CORE_IMG_PATH . 'img_not_found.png' ?>" alt=""></div><div class="col-xs-9 event_descr">Новый файл <a target="_blank" href="<?= CORE_FILE_PATH . $event["filename"] ?>"><?= $event['title']?>.<?= $event['ext']?></a>
                                от <a href="/index/leaders/view?id=<?= $event["user"] ?>"><?= $event['leader_fio']?></a></div> <?php
                                break;
                            case '11':
                                ?> <div class="col-xs-2"><img src="<?= !empty($event["image_name"]) ? CORE_IMG_PATH . $event["image_name"] : CORE_IMG_PATH . 'img_not_found.png' ?>" alt=""></div><div class="col-xs-9 event_descr">Новая ссылка на ресурс <a target="_blank" href="<?= $event["link"] ?>"><?= $event['title']?></a> у лидера <a target="_blank" href="<?= $event["user"] ?>"><?= $event['leader_fio']?></a></div> <?php
                                break;
                            case '15':
                                ?> <div class="col-xs-2"><img src="<?= !empty($event["image_name"]) ? CORE_IMG_PATH . $event["image_name"] : CORE_IMG_PATH . 'img_not_found.png' ?>" alt=""></div><div class="col-xs-9 event_descr">Обновлена информация лидера <a href="/index/leaders/view?id=<?= $event["user"] ?>"><?= $event['leader_fio']?></a></div> <?php
                                break;
                            case '14':
                                ?> <div class="col-xs-2"><img src="<?= !empty($event["image_name"]) ? CORE_IMG_PATH . $event["image_name"] : CORE_IMG_PATH . 'img_not_found.png' ?>" alt=""></div><div class="col-xs-9 event_descr">Появился новый проект <a href="/index/projects/view?id=<?= $event["id_proj"] ?>"><?= $event['project_title']?></a></div> <?php
                                break;
                            case '16':
                                ?> <div class="col-xs-2"><img src="<?= !empty($event["image_name"]) ? CORE_IMG_PATH . $event["image_name"] : CORE_IMG_PATH . 'img_not_found.png' ?>" alt=""></div><div class="col-xs-9 event_descr">Новый файл <a target="_blank" href="<?= CORE_FILE_PATH . $event["filename"] ?>"><?= $event['title']?>.<?= $event['ext']?></a>
                                в проекте <a href="/index/projects/view?id=<?= $event["id_proj"] ?>"><?= $event['project_title']?></a></div> <?php
                                break;
                            case '17':
                                ?> <div class="col-xs-2"><img src="<?= !empty($event["image_name"]) ? CORE_IMG_PATH . $event["image_name"] : CORE_IMG_PATH . 'img_not_found.png' ?>" alt=""></div><div class="col-xs-9 event_descr">Новая ссылка на ресурс <a target="_blank" href="<?= $event["link"] ?>"><?= $event['title']?></a> в проекте <a href="/index/projects/view?id=<?= $event["id_proj"] ?>"><?= $event['project_title']?></a></div> <?php
                                break;
                        } ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>На данный момент на проекте нет активности. </p>
            <?php endif; ?>
        </div>
        <div class="info_box more">
            <div class="info_count"><a href="javascript:void(0)">Показать больше</a></div>
        </div>
    </div>
</div>

<?php if (isset($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>

