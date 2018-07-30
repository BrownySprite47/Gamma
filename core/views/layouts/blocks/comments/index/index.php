<div class="inner_comment row inner_comment_<?= (($_POST['parent_comment_id'] != '') ? $id . ' answer' : $id) ?>">
    <?php if ($_POST['parent_comment_id'] == '') : ?>
        <button value="Insert node"
            onfocus="document.getElementById('editable').focus()"
            onclick="insertNodeAtCaret($(this), document.createTextNode('<?= $user[0]['name'] ?>, &nbsp;'))"
            id="bn_<?= $id ?>"
            class="answer_btn">
        <img src="/assets/images/news_reply.svg" alt="">
    <?php endif; ?>

    </button>
    <input class="author_id_bn_<?= $id ?>" type="hidden" value="<?= $_SESSION['id_lid'] ?>">
    <!--                            <input class="author_name" type="hidden" value="--><?//= $comment['fio'] ?><!--">-->
    <input class="comment_id_bn_<?= $id ?>" type="hidden" value="<?= (($_POST['parent_comment_id'] != '') ? $_POST['parent_comment_id'] : $id) ?>">
    <div class="col-xs-1">
        <a href="/leaders/view?id=281">
            <span class="image_comment" style="background-image: url('/uploads/images/<?=$user[0]['image_name'] ?>')"></span>
        </a>
    </div>
    <div class="col-xs-11 content_comment_wpap">
        <p>
            <a class="author_comment_name" href="/leaders/view?id=<?= $_SESSION['id_lid'] ?>"><?= $user[0]['fio'] ?></a><span class="pubdate"><?php //echo timeComments(time()); ?></span>
        </p>
        <p><?= $_POST['comment'] ?></p>
    </div>
</div>
