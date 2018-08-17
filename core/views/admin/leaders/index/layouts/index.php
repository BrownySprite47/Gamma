<div class="container-fluid">
    <div class="list-group-item title_menu_admin"><h2>ЛИДЕРЫ</h2><a href="/admin/leaders/add" class="btn btn_gamma" >Добавить лидера</a></div>
    <div class="row select_admin">
        <div class="form-group">
            <div class="col-xs-3">
                <select  data-live-search="true" id="condition_filter" class="selectpicker form-control" onchange="send('condition');">
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == 'all') ? 'selected' : '' ?> value="all" class="title">Состояние</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '0') ? 'selected' : '' ?> value="0">Новые лидеры</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '1') ? 'selected' : '' ?> value="1">Одобренные лидеры</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '2') ? 'selected' : '' ?> value="2">Отклоненные лидеры</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '3') ? 'selected' : '' ?> value="3">Отредактированные лидеры</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '4') ? 'selected' : '' ?> value="4">Авторизованные лидеры</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '5') ? 'selected' : '' ?> value="5">Не авторизованные лидеры</option>
                </select>
            </div>
            <div class="col-xs-3">
                <select  data-live-search="true" id="leader" class="selectpicker form-control" onchange="send('leader');">
                    <option value="all" class="title">ФИО лидера</option>
                    <?php foreach ($data['all_leaders'] as $key => $value): ?>
                        <option <?= (isset($_POST['leader']) && $_POST['leader'] == $value['id_lid']) ? 'selected' : '' ?> value="<?= $value['id_lid'] ?>"><?= $value['fio'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xs-3">
                <select  data-live-search="true" id="status_filter" class="selectpicker form-control" onchange="send('status');">
                    <option <?= (isset($_POST['status']) && $_POST['status'] == 'all') ? 'selected' : '' ?> value="all" class="title">Статус</option>
                    <option <?= (isset($_POST['status']) && $_POST['status'] == '0') ? 'selected' : '' ?> value="0">Зарег</option>
                    <option <?= (isset($_POST['status']) && $_POST['status'] == '1') ? 'selected' : '' ?> value="1">1 рекомендация</option>
                    <option <?= (isset($_POST['status']) && $_POST['status'] == '2') ? 'selected' : '' ?> value="2">ЛИО-</option>
                    <option <?= (isset($_POST['status']) && $_POST['status'] == '3') ? 'selected' : '' ?> value="3">ЛИО</option>
                </select>
            </div>
            <div class="col-xs-1">
                <select onchange="send()" id="count_on_page" class="selectpicker form-control">
                    <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '10') ? 'selected' : ''?> value="10">10</option>
                    <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '30') ? 'selected' : ''?> value="30">30</option>
                    <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '50') ? 'selected' : ''?> value="50">50</option>
                    <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '100') ? 'selected' : ''?> value="100">100</option>
                </select>
            </div>
            <div class="col-xs-2">
                <a class="clear_filter" href="javascript:void(0);" onclick="clear_filter();">Сбросить фильтр</a>
            </div>
        </div>
    </div>
    <div id="content">
        <table class="table table-bordered">
          <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">ФИО лидера</th>
                <th scope="col">Статус</th>
                <th scope="col">Соцсеть</th>
                <th scope="col">Проекты у лидера</th>
                <th scope="col">Состояние</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($data['leaders'])): ?>
                <?php foreach ($data['leaders'] as $key => $value): ?>
                    <tr id="tag_<?= $value['id_lid'] ?>" class="relat_box_leader_<?= $value['id_lid'] ?>">
                        <th scope="row"><?= $value['id_lid'] ?></th>
                        <td><a href="/index/leaders/view?id=<?= $value['id_lid'] ?>"><?= $value['fio'] ?></a></td>
                        <td><p><?= $value['status'] ?></p></td>
                        <td><a target="_blank" href="<?= $value['social'] ?>">Просмотр</a></td>
                        <td>
                            <?php if (!empty($value['projects'][0])): ?>
                                <?php foreach ($value['projects'] as $key1 => $value1): ?>
                                    <a href="/index/projects/view?id=<?= $value1['id_proj'] ?>"><span> &bull; </span> <?= $value1['project_title'] ?></a><br>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Нет проектов</p>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($value["checked"] == '0'): ?>
                                <p>Новые</p>
                            <?php endif; ?>
                            <?php if ($value["checked"] == '1'): ?>
                                <p>Одобренные</p>
                            <?php endif; ?>
                            <?php if ($value["checked"] == '2'): ?>
                                <p>Отклоненные</p>
                            <?php endif; ?>
                            <?php if ($value["checked"] == '3'): ?>
                                <p>Отредактированные</p>
                            <?php endif; ?>
                            <?php if ($value["auth"] != '0' && $value["auth"] != ''): ?>
                                <p>Авторизованные</p>
                            <?php endif; ?>
                            <?php if ($value["auth"] == '0' || $value["auth"] == ''): ?>
                                <p>Не авторизованные</p>
                            <?php endif; ?>
                        </td>
                        <td class="buttons_admin_table">
                            <?php if ($value["checked"] == '0' || $value["checked"] == '2' || $value["checked"] == '3'): ?>
                                <a href="javascript:void(0);" onclick="status(1, <?= $value['id_lid'] ?>);"><span class="success_admin_button"></span></a>
                            <?php endif; ?>
                        </td>
                        <td class="buttons_admin_table">
                            <a href="/admin/leaders/edit?id=<?= $value['id_lid'] ?>"><span class="edit_admin_button"></span></a>
                        </td>
                        <td class="buttons_admin_table">
                            <?php if ($value["checked"] == '0' || $value["checked"] == '1' || $value["checked"] == '3'): ?>
                                <a href="javascript:void(0);" class="open-modal" onclick="modal_box('<?= $value['id_lid'] ?>')"><span class="delete_admin_button"></span></a>
                            <?php endif; ?>
                        </td>
                    </tr>                    
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">Нет лидеров</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
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
    <?php if ($data['countpages'] > 1): ?>
        <div id="navigation" class="col-xs-12">
            <nav class="nav_page" aria-label="Page navigation">
                <ul class="pagination">
                    <li <?= ($data['numpage'] <= 1 ? 'class="disabled"' : '') ?>>
                        <a href="javascript:void(0);" onclick="send('', 1); return up();" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                    </li>
                    <?php $limit = ($data['countpages'] < 5) ? $data['countpages'] : 5;
                        $left = $data['numpage'] - 2;
                        $right = $data['numpage'] + 2;

                        if ($left < 1) {
                            $left = 1;
                            $right = $left + $limit - 1;
                        }
                        if ($right > $data['countpages']) {
                            $right = $data['countpages'];
                            $left = $right - $limit + 1;
                        }
                    ?>
                    <?php for ($i = $left; $i <= $right; $i++): ?>
                        <li <?= ($data['numpage'] == $i ? 'class="active"' : '') ?>>
                            <a href="javascript:void(0);" onclick="send('', <?= $i ?>); return up();"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li <?= ($data['numpage'] == $data['countpages'] ? 'class="disabled"' : '') ?>>
                        <a href="javascript:void(0);" onclick="send('', <?= $data['countpages'] ?>); return up();" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
    <script>
        $('.selectpicker').selectpicker('refresh');
        $('.selectpicker').selectpicker({ size: 8 });
    </script>
</div>
<?php if (isset($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>