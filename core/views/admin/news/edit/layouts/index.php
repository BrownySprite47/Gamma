<div class="container-fluid">
    <div class="list-group-item title_menu_admin"><h2>РЕДАКТИРОВАНИЕ НОВОСТИ</h2>
        <a href="/admin/news/deleted" class="btn btn_gamma">Архив</a>
        <a href="/admin/news" class="btn btn_gamma" style="right: 115px;">Все новости</a>
    </div>
    <form method="post" enctype="multipart/form-data" >
        <input name="id_news" type="hidden" value="<?= $_GET['id'] ?>">
        <div class="col-xs-3">
            <div id="preview">
                <span class="image_name" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>)"></span>
                <input style="display: none" id="image_name" type="text" name="image_name"/>
            </div>

            <label for="user_picture" class="file_upload">
                <span class="load_file">Выбрать файл</span>
                <mark id="mark_img">файл не выбран</mark>
                <input id="user_picture" type="file" name="image_name" onchange="upload('img', 'user_picture', 'progressbar', 'preview');"/>
            </label>
            <progress id="progressbar" value="0" max="100" style="display: none;"></progress>
        </div>
        <div class="col-xs-9 info_box">
            <div class="wrapper profile">
                <div class="info_box_title">
                    <span>Заполните все обязательные поля</span>
                </div>
                <div class="col-xs-12">
                    <label for="familya">Заголовок новости*</label>
                    <input type="text" required name="title" class="form-control" id="title" value="<?= $data['news'][0]['title'] ?>">
                </div>
                <div class="col-xs-12">
                    <label for="name">Анонс новости</label>
                    <input type="text" name="prev_content" class="form-control" id="prev_content" value="<?= $data['news'][0]['prev_content'] ?>">
                </div>
                <div class="col-xs-12">
                    <label for="otchestvo">Описание новости*</label>
                    <textarea required style="resize: none;" class="form-control" rows="15" id="content" name="content"><?= $data['news'][0]['content'] ?></textarea>
                </div>
            </div>
            <div class="wrap_buttons">
                <div class="col-xs-6 wrap_btn">
                    <a href="javascript:void(0)"><input class="save_btn" type="submit" value="Сохранить все"></a>
                </div>
                <div class="col-xs-6 wrap_btn">
                    <span id="result_public"><img src='/assets/images/checkmark.svg'>Новость успешно отредактировна!</span>
                </div>
            </div>
        </div>
        <div class="col-xs-2"></div>
    </form>
</div>
<?php if(isset($data['js'])): ?>
    <?php foreach($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>

