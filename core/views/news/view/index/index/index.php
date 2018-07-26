<?php include CORE_DIR . '/core/views/layouts/header/index/index/index.php'; ?>
<div id="content-main">
    <div class="container-fluid">
        <div class="wrap_admin_links">
            <div class="col-xs-3 back_to_profile">
                <a href="/news"><img src="/assets/images/arrow_blue.svg" alt=""><span>Вернуться к новостям</span></a>
            </div>
        </div>
        <?php foreach($data['news'] as $key => $news): ?>
        <?php if($_GET['id'] == $news['id']): ?>
                <div class="">
                    <a style="background-image: url(<?= !empty($news['image']) ? CORE_IMG_PATH . $news['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)" class="news_main_link">
                        <div class="description_box">
                            <div class="inner">
                                <span class="important_news">Главное</span><span class="pubdate_news"><img src="" alt=""><?= $news['pubdate'] ?></span><span class="author_news">Тут имя автора</span>
                                <span class="news_title_main"><?= $news['title'] ?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="description_inner">
                    <div class="col-xs-7 news_content"><?= $news['content'] ?></div>
                    <?php if(isset($data['news'][$key + 1])): ?>
                        <div class="col-xs-offset-2 col-xs-3">
                            <span class="next_news_notice">Следующая новость</span>
                            <a class="news_small_link" href="/news/view?id=<?= $data['news'][$key + 1]['id'] ?>">
                                <div class="description_box">
                                    <span class="image_small_news" style="background-image: url(<?= !empty($data['news'][$key + 1]['image']) ? CORE_IMG_PATH . $data['news'][$key + 1]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                    <span class="pubdate_news_small"><img src="" alt=""><?= $data['news'][$key + 1]['pubdate'] ?></span>
                                    <span class="news_title_small"><?= $data['news'][$key + 1]['title'] ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php break; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if($_GET['id'] == $news['id']): ?>
        <div class="inner_comments_box">
            <div class="comments_box">Комментарии</div>
            <div class="wrapper_comments col-xs-7">
                <?php if(isset($data['comments'][0])): ?>
                <?php foreach ($data['comments'] as $key => $comment): ?>
                     <?php if($comment['parent_comment_id'] == 0): ?>
                        <div class="inner_comment row">
                            <div class="col-xs-1"><a href="/leaders/view?id=<?= $comment['author_id'] ?>"><span class="image_comment" style="background-image: url('<?= !empty($comment['image']) ? CORE_IMG_PATH . $comment['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>')"></span></a></div>
                            <div class="col-xs-11 content_comment_wpap">
                                <p><a class="author_comment_name" href="/leaders/view?id=<?= $comment['author_id'] ?>"><?= $comment['fio'] ?></a></p>
                                <p><?= $comment['comment'] ?></p>
                            </div>
                        </div>
                        <?php foreach ($data['comments'] as $key2 => $comment2): ?>
                            <?php if($comment2['parent_comment_id'] != 0 && $comment2['parent_comment_id'] == $comment['id']): ?>
                                <div class="inner_comment answer">
                                    <div class="col-xs-1"><a href="/leaders/view?id=<?= $comment2['author_id'] ?>"><span class="image_comment" style="background-image: url('<?= !empty($comment2['image']) ? CORE_IMG_PATH . $comment2['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>')"></span></a></div>
                                    <div class="col-xs-11 content_comment_wpap">
                                        <p><a class="author_comment_name" href="/leaders/view?id=<?= $comment2['author_id'] ?>"><?= $comment2['fio'] ?></a></p>
                                        <p><?= $comment2['comment'] ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                 <?php endforeach; ?>
                <?php else: ?>
                    <span>К данной новости еще нет комментариев.</span>
                <?php endif; ?>
            </div>
            <?php if(isset($_SESSION['role'])): ?>
                <div class="col-xs-1 user_img_comment"><a href="/leaders/view?id=<?= $_SESSION['id_lid'] ?>"><span class="image_comment" style="background-image: url('<?= !empty($_SESSION['avatar']) ? $_SESSION['avatar'] : CORE_IMG_PATH . 'img_not_found.png' ?>')"></span></a></div>
                <div class="wrapper_comments col-xs-4">
                    <form>
                        <div>
                            <input type="hidden" name="parent_comment_id">
                            <input type="hidden" name="parent_author_id">
                            <input type="hidden" name="news_id" value="<?= $_GET['id'] ?>">
                            <input required name="comment" id="comment">
                            <div id="myEmojiField"></div>
                        </div>
                        <div>
                            <input class="add_btn_comment" type="submit" value="Отправить"><img src="/assets/images/check.svg" class="add_input_comment_img"><br>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div id="carousel" class="carousel slide" data-ride="carousel" style="display: inline-block;">
            <div class="carousel-inner">
                <?php $item = 1; ?>
                <?php $slide = 1; ?>
                <?php if(!empty($data['news'])): ?>
                <?php foreach($data['news'] as $key => $news): ?>
                    <?php if($_GET['id'] == $news['id']) continue ?>
                    <?php if(!empty($data['news'][$key]['title'])): ?>
                        <?php if($key == 0) continue; ?>
                        <?php if($item == 5) $item = 1 ?>
                        <?php if($item == 1): ?>
                            <div id="slide_<?= $slide ?>" class="item <?= ($slide == 1) ? 'active' : '' ?> row">
                        <?php endif; ?>
                        <div class="col-xs-3">
                            <a class="news_small_link" href="/news/view?id=<?= $data['news'][$key]['id'] ?>">
                                <div class="description_box">
                                    <span class="image_small_news" style="background-image: url(<?= !empty($data['news'][$key]['image']) ? CORE_IMG_PATH . $data['news'][$key]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                    <span class="pubdate_news_small"><img src="" alt=""><?= $data['news'][$key]['pubdate'] ?></span>
                                    <span class="news_title_small"><?= $data['news'][$key]['title'] ?></span>
                                    <span class="news_description_small"><?= $news['prev_content'] ?>...</span>
                                    <div class="over_box_background"></div>
                                </div>
                            </a>
                        </div>
                        <?php if($item == 4): ?>
                            <?php $slide++ ?>
                            </div>
                        <?php endif; ?>
                        <?php $item++ ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if($item != 4): ?>
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
            < <span class="sr-only">Предыдущий</span>
        </a>
        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
            > <span class="sr-only">Следующий</span>
        </a>
    </div>
</div>
<?php include CORE_DIR . '/core/views/layouts/footer/index/index/index.php' ?>

