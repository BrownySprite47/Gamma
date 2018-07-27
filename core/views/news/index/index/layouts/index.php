<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8">
            <div class="col-xs-12">
                <?php if (isset($data['news'][0])): ?>
                    <a style="background-image: url(<?= !empty($data['news'][0]['image']) ? CORE_IMG_PATH . $data['news'][0]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)" class="news_main_link" href="/news/view?id=<?= $data['news'][0]['id'] ?>">
                        <div class="description_box">
                            <div class="inner">
                                <span class="important_news">Главное</span><span class="pubdate_news"><img src="/assets/images/news_clock.svg" alt=""><?= $data['news'][0]['pubdate'] ?></span><span class="author_news"><img src="/assets/images/news_autor.svg" alt="">Тут имя автора</span>
                                <span class="news_title_main"><?= $data['news'][0]['title'] ?></span>
                                <span class="news_description_main"><?= $data['news'][0]['prev_content'] ?></span>
                            </div>
                        </div>
                    </a>
                <?php else: ?>
                    <p>На данный момент на проекте нет новостей. </p>
                <?php endif; ?>
            </div>
            <div id="carousel" class="carousel slide" data-ride="carousel" style="display: inline-block;">
                <div class="carousel-inner">
                    <?php $item = 1; ?>
                    <?php $slide = 1; ?>
                    <?php if (!empty($data['news'])): ?>
                        <?php foreach ($data['news'] as $key => $news): ?>
                            <?php if (!empty($data['news'][$key]['title'])): ?>
                                <?php if ($key == 0) {
    continue;
} ?>
                                <?php if ($item == 4) {
    $item = 1;
} ?>
                                <?php if ($item == 1): ?>
                                    <div id="slide_<?= $slide ?>" class="item <?= ($slide == 1) ? 'active' : '' ?>">
                                <?php endif; ?>
                                <div class="col-xs-4">
                                    <a class="news_small_link" href="/news/view?id=<?= $data['news'][$key]['id'] ?>">
                                        <div class="description_box">
                                            <span class="image_small_news" style="background-image: url(<?= !empty($data['news'][$key]['image']) ? CORE_IMG_PATH . $data['news'][$key]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                            <span class="pubdate_news_small"><img src="/assets/images/news_clock.svg" alt=""><?= $data['news'][$key]['pubdate'] ?></span>
                                            <span class="news_title_small"><?= $data['news'][$key]['title'] ?></span>
                                            <span class="news_description_small"><?= $news['prev_content'] ?>...</span>
                                            <div class="over_box_backgrount"></div>
                                        </div>
                                    </a>
                                </div>
                                <?php if ($item == 3): ?>
                                    <?php $slide++ ?>
                                    </div>
                                <?php endif; ?>
                                <?php $item++ ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php if ($item != 4): ?>
                        </div>
                    <?php endif; ?>
                    <?php else: ?>
                        <div id="slide_1" class="item active">
                            <p>На данный момент на проекте нет новостей. </p>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Элементы управления -->
                <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                    <img src="/assets/images/news_arrow_left.svg" alt=""><span class="sr-only">Предыдущий</span>
                </a>
                <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                    <img src="/assets/images/news_arrow_right.svg" alt=""><span class="sr-only">Следующий</span>
                </a>
            </div>
        </div>

        <div class="col-xs-4">
            <div class="right_info"><img src="" alt=""><strong><?= $data['leaders_count'][0]['count_lid'] ?></strong><span>лидеров в базе Навигатора</span></div>
            <div class="right_info"><img src="" alt=""><strong><?= $data['recommends_count'][0]['count_recom'] ?></strong><span>рекомендаций в GAMMA</span></div>
            <div class="info_box">
                <div class="info_count">6 новых уведомлений</div>
            </div>
            <div class="right_info right_info_count">
                <?php if (!empty($data['events'])): ?>
                    <?php foreach ($data['events'] as $event): ?>
                        <?php switch ($event["event"]) {
                            case '3':
                                ?> <p>Новый зарегистрированный пользователь</p> <?php
                                break;
                            case '4':
                                ?> <p>Появилась новая рекомендация</p> <?php
                                break;
                            case '5':
                                ?> <p>Авторизовался новый лидер <a href="/leaders/view?id=<?= $event["user"] ?>"><?= $event['leader_fio']?></a></p> <?php
                                break;
                            case '6':
                                ?> <p>Обновлена информация о проекте <a href="/projects/view?id=<?= $event["id_proj"] ?>"><?= $event['project_title']?></a></p> <?php
                                break;
                            case '10':
                                ?> <p>Новый файл <a target="_blank" href="<?= CORE_FILE_PATH . $event["filename"] ?>"><?= $event['title']?>.<?= $event['ext']?></a>
                                от <a href="/leaders/view?id=<?= $event["user"] ?>"><?= $event['leader_fio']?></a></p> <?php
                                break;
                            case '11':
                                ?> <p>Новая ссылка на ресурс <a target="_blank" href="<?= $event["link"] ?>"><?= $event['title']?></a> у лидера <a target="_blank" href="<?= $event["user"] ?>"><?= $event['leader_fio']?></a></p> <?php
                                break;
                            case '15':
                                ?> <p>Обновлена информация лидера <a href="/leaders/view?id=<?= $event["user"] ?>"><?= $event['leader_fio']?></a></p> <?php
                                break;
                            case '14':
                                ?> <p>Появился новый проект <a href="/projects/view?id=<?= $event["id_proj"] ?>"><?= $event['project_title']?></a></p> <?php
                                break;
                            case '16':
                                ?> <p>Новый файл <a target="_blank" href="<?= CORE_FILE_PATH . $event["filename"] ?>"><?= $event['title']?>.<?= $event['ext']?></a>
                                в проекте <a href="/projects/view?id=<?= $event["id_proj"] ?>"><?= $event['project_title']?></a></p> <?php
                                break;
                            case '17':
                                ?> <p>Новая ссылка на ресурс <a target="_blank" href="<?= $event["link"] ?>"><?= $event['title']?></a> в проекте <a href="/projects/view?id=<?= $event["id_proj"] ?>"><?= $event['project_title']?></a></p> <?php
                                break;
                        } ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>На данный момент на проекте нет активности. </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php if (isset($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>

