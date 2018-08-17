<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>

<div id="content-main">
    <div class="container-fluid">
        <div class="wrap_admin_links">
            <div class="col-lg-3 back_to_profile">
                <a href="javascript:history.back()"><img src="/assets/images/arrow_blue.svg" alt=""><span>Вернуться назад</span></a>
            </div>
        </div>
        <div class="wrap_admin_links">
            <div class="col-xs-12"><p>Название: <?= $data['link'][0]['title'] ?></p></div>
            <div class="col-xs-12">
                <p>Ссылка:
                    <a class="user_files" target="_blank" href="/uploads/files/<?= $data['link'][0]['link'] ?>">
                        <?= $data['link'][0]['link'] ?>
                    </a>
                </p>
            </div>
            <div class="col-xs-12"><p><a target="_blank" href="<?= $data['link'][0]['link'] ?>">Открыть</a></p></div>
        </div>
        <div class="inner_comments_box">
            <div class="comments_box">Комментарии</div>
            <div id="comment_box" class="wrapper_comments col-lg-7">
                <?php if (isset($data['comments'][0])): ?>
                    <?php foreach ($data['comments'] as $key => $comment): ?>
                        <?php if ($comment['parent_comment_id'] == 0): ?>
                            <div class="inner_comment row inner_comment_<?= $comment['id'] ?>">
                                <button value="Insert node" onfocus="document.getElementById('editable').focus()" onclick="insertNodeAtCaret($(this), document.createTextNode('<?= $comment['name'] ?>, &nbsp;'))" id="bn_<?= $comment['id'] ?>" class="answer_btn"><img src="/assets/images/news_reply.svg" alt=""></button>
                                <input class="author_id_bn_<?= $comment['id'] ?>" type="hidden" value="<?= $comment['author_id'] ?>">
                                <!--                            <input class="author_name" type="hidden" value="--><?//= $comment['fio'] ?><!--">-->
                                <input class="comment_id_bn_<?= $comment['id'] ?>" type="hidden" value="<?= $comment['id'] ?>">

                                <div class="col-xs-1"><a href="/index/leaders/view?id="<?= $comment['author_id'] ?>"><span class="image_comment" style="background-image: url('<?= !empty($comment['image']) ? CORE_IMG_PATH . $comment['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>')"></span></a></div>
                                <div class="col-xs-11 content_comment_wpap">
                                    <p><a class="author_comment_name" href="/index/leaders/view?id=<?= $comment['author_id'] ?>"><?= $comment['familya'] ?> <?= $comment['name'] ?></a><span class="pubdate"><?php //echo $comment['pubdate'] ?></span></p>
                                    <p><?= $comment['comment'] ?></p>
                                </div>
                            </div>
                            <?php foreach ($data['comments'] as $key2 => $comment2): ?>
                                <?php if ($comment2['parent_comment_id'] != 0 && $comment2['parent_comment_id'] == $comment['id']): ?>
                                    <div class="inner_comment answer row">
                                        <input class="author_id_bn_<?= $comment['id'] ?>" type="hidden" value="<?= $comment2['author_id'] ?>">
                                        <!--                            <input class="author_name" type="hidden" value="--><?//= $comment['fio'] ?><!--">-->
                                        <input class="comment_id_bn_<?= $comment['id'] ?>" type="hidden" value="<?= $comment['id'] ?>">

                                        <div class="col-xs-1"><a href="/index/leaders/view?id=<?= $comment2['author_id'] ?>"><span class="image_comment" style="background-image: url('<?= !empty($comment2['image']) ? CORE_IMG_PATH . $comment2['image'] : CORE_IMG_PATH . 'img_not_found.png' ?>')"></span></a></div>
                                        <div class="col-xs-11 content_comment_wpap">
                                            <p><a class="author_comment_name" href="/index/leaders/view?id=<?= $comment2['author_id'] ?>"><?= $comment['familya'] ?> <?= $comment['name'] ?></a><span><?php //echo $comment['pubdate'] ?></span></p>
                                            <p><?= $comment2['comment'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="no_comments">К данной ссылке еще нет комментариев.</span>
                <?php endif; ?>
            </div>
            <?php if (isset($_SESSION['status']) && $_SESSION['status'] != '0'): ?>
                <div class="sticky_news_comments">
                    <div class="col-lg-1 user_img_comment"><a href="/index/leaders/view?id=<?= $_SESSION['id_lid'] ?>"><span class="image_comment" style="background-image: url('<?= !empty($_SESSION['avatar']) ? $_SESSION['avatar'] : CORE_IMG_PATH . 'img_not_found.png' ?>')"></span></a></div>
                    <div class="wrapper_comments col-lg-4">
                        <form>
                            <div>
                                <input type="hidden" name="news_id" value="<?= $_GET['id'] ?>">

                                <input id="parent_author_id" type="hidden" name="parent_author_id">
                                <!--                            <input id="parent_author_name" type="hidden" name="parent_author_name">-->
                                <input id="parent_comment_id" type="hidden" name="parent_comment_id">


                                <input required name="comment" id="comment">
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
    </div>
</div>









<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>
