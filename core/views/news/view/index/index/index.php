<?php include CORE_DIR . '/core/views/layouts/header/index/index/index.php'; ?>
<div id="content-main">
    <div class="container-fluid">
        <div class="wrap_admin_links">
            <div class="col-xs-3 back_to_profile">
                <a href="/news"><img src="/assets/images/arrow_blue.svg" alt=""><span>Вернуться к новостям</span></a>
            </div>
        </div>
        <div class="">
            <a style="background-image: url(<?= !empty($data['news'][0]['image']) ? CORE_IMG_PATH . $data['news'][0]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)" class="news_main_link">
                <div class="description_box">
                    <div class="inner">
                        <span class="important_news">Главное</span><span class="pubdate_news"><img src="" alt=""><?= $data['news'][0]['pubdate'] ?></span><span class="author_news">Тут имя автора</span>
                        <span class="news_title_main"><?= $data['news'][0]['title'] ?></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="description_inner">
            <div class="col-xs-7 news_content"><?= $data['news'][0]['content'] ?></div>
            <div class="col-xs-offset-2 col-xs-3">
                <?php if(isset($data['next_news'][0])): ?>
                    <span class="next_news_notice">Следующая новость</span>
                    <a class="news_small_link" href="/news/view?id=<?= $data['next_news'][0]['id'] ?>">
                        <div class="description_box">
                            <span class="image_small_news" style="background-image: url(<?= !empty($data['next_news'][0]['image']) ? CORE_IMG_PATH . $data['next_news'][0]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                            <span class="pubdate_news_small"><img src="" alt=""><?= $data['next_news'][0]['pubdate'] ?></span>
                            <span class="news_title_small"><?= $data['next_news'][0]['title'] ?></span>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include CORE_DIR . '/core/views/layouts/footer/index/index/index.php' ?>

