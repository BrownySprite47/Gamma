<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>

<div id="content-main">
    <div class="container-fluid">
        <div class="wrap_admin_links">
            <div class="col-lg-3 back_to_profile">
                <a href="/index/news"><img src="/assets/images/arrow_blue.svg" alt=""><span>Вернуться к новостям</span></a>
            </div>
        </div>
        <div>
            <a style="background-image: url(<?= !empty($news['image']) ? CORE_IMG_PATH . $news['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)" class="news_main_link">
                <div class="description_box">
                    <div class="inner">
                        <span class="important_news">Главное</span><span class="pubdate_news"><img src="/assets/images/news_clock.svg" alt=""><?= $data['current'][0]['pubdate'] ?></span><span class="author_news"><img src="/assets/images/news_autor.svg" alt=""><?= $data['current'][0]['fio'] ?></span>
                        <span class="news_title_main"><?= $data['current'][0]['title'] ?></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="description_inner">
            <div class="col-lg-7 news_content"><?= $data['current'][0]['content'] ?></div>
            <?php if (isset($data['next'][0]['title'])): ?>
                <div class="col-lg-offset-2 col-lg-3">
                    <span class="next_news_notice">Следующая новость</span>
                    <a class="news_small_link view" href="/index/news/view?id=<?= $data['next'][0]['id'] ?>">
                        <div class="description_box">
                            <span class="image_small_news" style="background-image: url(<?= !empty($data['next'][0]['image']) ? CORE_IMG_PATH . $data['next'][0]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                            <span class="pubdate_news_small"><img src="/assets/images/news_clock_blue.svg" alt=""><?= $data['next'][0]['pubdate'] ?></span>
                            <span class="news_title_small"><?= $data['next'][0]['title'] ?></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="description_inner">
            <div class="col-lg-4 views">
                <img src="/assets/images/news_eye.svg" alt=""><?= $data['current'][0]['views'] ?>
                <img class="comments" src="/assets/images/news_message.svg" alt=""><?= $data['comments_count'][0]['comments_count'] ?>
            </div>
            <div class="col-lg-4 social_links">
                <a href="javascript:void(0)"><img src="/assets/images/news_vk.svg" alt=""></a>
                <a href="javascript:void(0)"><img src="/assets/images/news_fb.svg" alt=""></a>
                <a href="javascript:void(0)"><img src="/assets/images/news_tw.svg" alt=""></a>
                <a href="javascript:void(0)"><img src="/assets/images/news_g+.svg" alt=""></a>
                <a href="javascript:void(0)"><img src="/assets/images/news_ok.svg" alt=""></a>
            </div>
            <div class="col-lg-4"></div>
        </div>
        <?php if ($_GET['id'] == $data['current'][0]['id']): ?>
            <div class="inner_comments_box">
                <div class="comments_box">Комментарии</div>
                <div id="comment_box" class="wrapper_comments col-lg-7">
                    <?php if (isset($data['comments'][0])): ?>
                        <?php foreach ($data['comments'] as $key => $comment): ?>
                            <?php if ($comment['parent_comment_id'] == 0): ?>
                                <div class="inner_comment row inner_comment_<?= $comment['id'] ?>">
                                    <button value="Insert node" onfocus="document.getElementById('editable').focus()" onclick="insertNodeAtCaret($(this), document.createTextNode('<?= $comment['name'] ?>, &nbsp;'))" id="bn_<?= $comment['id'] ?>" class="answer_btn"><img src="/assets/images/news_reply.svg" alt=""></button>
                                    <input class="author_id_bn_<?= $comment['id'] ?>" type="hidden" value="<?= $comment['author_id'] ?>">
                                    <input class="comment_id_bn_<?= $comment['id'] ?>" type="hidden" value="<?= $comment['id'] ?>">
                                    <div class="col-xs-1"><a href="/index/leaders/view?id="<?= $comment['author_id'] ?>"><span class="image_comment" style="background-image: url('<?= !empty($comment['image']) ? CORE_IMG_PATH . $comment['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>')"></span></a></div>
                                    <div class="col-xs-11 content_comment_wpap">
                                        <p><a class="author_comment_name" href="/index/leaders/view?id=<?= $comment['author_id'] ?>"><?= $comment['familya'] ?> <?= $comment['name'] ?></a><span class="pubdate"></span></p>
                                        <p><?= $comment['comment'] ?></p>
                                    </div>
                                </div>
                                <?php foreach ($data['comments'] as $key2 => $comment2): ?>
                                    <?php if ($comment2['parent_comment_id'] != 0 && $comment2['parent_comment_id'] == $comment['id']): ?>
                                        <div class="inner_comment answer row">
                                            <input class="author_id_bn_<?= $comment['id'] ?>" type="hidden" value="<?= $comment2['author_id'] ?>">
                                            <input class="comment_id_bn_<?= $comment['id'] ?>" type="hidden" value="<?= $comment['id'] ?>">
                                            <div class="col-xs-1"><a href="/index/leaders/view?id=<?= $comment2['author_id'] ?>"><span class="image_comment" style="background-image: url('<?= !empty($comment2['image']) ? CORE_IMG_PATH . $comment2['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>')"></span></a></div>
                                            <div class="col-xs-11 content_comment_wpap">
                                                <p><a class="author_comment_name" href="/index/leaders/view?id=<?= $comment2['author_id'] ?>"><?= $comment['familya'] ?> <?= $comment['name'] ?></a><span></span></p>
                                                <p><?= $comment2['comment'] ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="no_comments">К данной новости еще нет комментариев.</span>
                    <?php endif; ?>
                </div>
                <?php if (isset($_SESSION['status']) && $_SESSION['status'] != '0'): ?>
                    <div class="sticky_news_comments">
                        <div class="col-xs-1 user_img_comment"><a href="/index/leaders/view?id=<?= $_SESSION['id_lid'] ?>"><span class="image_comment" style="background-image: url('<?= !empty($_SESSION['avatar']) ? $_SESSION['avatar'] : CORE_IMG_PATH . 'img_not_found.png' ?>')"></span></a></div>
                        <div class="wrapper_comments col-xs-4">
                            <form>
                                <div>
                                    <input type="hidden" name="news_id" value="<?= $_GET['id'] ?>">
                                    <input id="parent_author_id" type="hidden" name="parent_author_id">
                                    <input id="parent_comment_id" type="hidden" name="parent_comment_id">
                                    <input type="text" required name="comment" id="comment">
                                    <div id="myEmojiField"></div>
                                </div>
                                <div>
                                    <input class="add_btn_comment" type="submit" value="Отправить"><img src="/assets/images/check.svg" class="add_input_comment_img"><br>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="sticky_news_comments comments_error_access"><div class="col-lg-5 inner_comments_error_access"><p>Станьте рекомендованным пользователем, чтобы оставлять комментарии</p></div></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
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
                    <?php if (!empty($data['all_news'])): ?>
                        <?php foreach ($data['all_news'] as $key => $news): ?>
                            <?php if (!empty($data['all_news'][$key]['title'])): ?>
                                <div class="carousel-element">
                                    <a class="news_small_link" href="/index/news/view?id=<?= $data['all_news'][$key]['id'] ?>">
                                        <div class="description_box">
                                            <span class="image_small_news" style="background-image: url(<?= !empty($data['all_news'][$key]['image']) ? CORE_IMG_PATH . $data['all_news'][$key]['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                                            <span class="pubdate_news_small"><img src="/assets/images/news_clock_blue.svg" alt=""><?= $data['all_news'][$key]['pubdate'] ?></span>
                                            <span class="news_title_small"><?= $data['all_news'][$key]['title'] ?></span>
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
</div>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>

