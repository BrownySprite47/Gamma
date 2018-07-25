<div class="container-fluid">
    <div class="list-group-item title_menu_admin"><h2>НОВОСТИ</h2>
        <a href="/admin/news/create" class="btn btn_gamma">Добавить новость</a>
        <a href="/admin/news/deleted" class="btn btn_gamma" style="right: 196px;">Архив</a>
    </div>
    <div class="row select_admin">
        <div class="form-group">
            <div id="content">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Время создания</th>
                        <th scope="col">Заголовок</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($data['news'])): ?>
                        <?php foreach ($data['news'] as $key => $value): ?>
                            <tr id="news_<?= $value['id'] ?>" class="relat_box_news_<?= $value['id'] ?>">
                                <th scope="row"><?= $value['id'] ?></th>
                                <td><p><?= $value['pubdate'] ?></p></td>
                                <td><a href="/news/view?id=<?= $value['id'] ?>"><?= $value['title'] ?></a></td>
                                <td class="buttons_admin_table"><a href="/admin/news/edit?id=<?= $value['id'] ?>"><span class="edit_admin_button"></span></a></td>
                                <td class="buttons_admin_table"><a href="javascript:void(0);" class="open-modal" onclick="modal_box(<?= $value['id'] ?>)"><span class="delete_admin_button"></span></a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8">Нет новостей</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-footer">
                    <button id="delete" class="btn btn_gamma" data-dismiss="modal">Уверен</button>
                    <button class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
    <?php if($data['countpages'] > 1): ?>
        <div id="navigation" class="col-xs-12">
            <nav class="nav_page" aria-label="Page navigation" style="text-align: center;">
                <ul class="pagination">
                    <li <?= ($data['numpage'] <= 1 ? 'class="disabled"' : '') ?>>
                        <a href="javascript:void(0);" onclick="send(1); return up();" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    $limit = ($data['countpages'] < 5) ? $data['countpages'] : 5;
                    $left = $data['numpage'] - 2;
                    $right = $data['numpage'] + 2;

                    if ($left < 1)            { $left = 1;            $right = $left + $limit - 1; }
                    if ($right > $data['countpages']) { $right = $data['countpages']; $left = $right - $limit + 1; }
                    ?>

                    <?php for ($i = $left; $i <= $right; $i++): ?>
                        <li <?= ($data['numpage'] == $i ? 'class="active"' : '') ?>>
                            <a href="javascript:void(0);" onclick="send(<?= $i ?>); return up();"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <li <?= ($data['numpage'] == $data['countpages'] ? 'class="disabled"' : '') ?>>
                        <a href="javascript:void(0);" onclick="send(<?= $data['countpages'] ?>); return up();" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
</div>
<?php if(isset($data['js'])): ?>
    <?php foreach($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>
