<div class="container-fluid">
    <div class="list-group-item title_menu_admin"><h2>ПРОЕКТЫ</h2><a href="/projects/add" class="btn btn_gamma" >Добавить проект</a></div>
    <div class="row select_admin">
        <div class="form-group">
            <div class="col-xs-3">
                <select  data-live-search="true" id="condition_filter" class="selectpicker form-control" onchange="send('condition');">
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == 'all') ? 'selected' : '' ?> value="all" class="title">Состояние</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '0') ? 'selected' : '' ?> value="0">Новые проекты</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '1') ? 'selected' : '' ?> value="1">Одобренные проекты</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '2') ? 'selected' : '' ?> value="2">Отклоненные проекты</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '3') ? 'selected' : '' ?> value="3">Отредактированные проекты</option>
                </select>
            </div>
            <div class="col-xs-3">
                <select  data-live-search="true" id="project" class="selectpicker form-control" onchange="send('project');">
                    <option value="all" class="title">Название проекта</option>
                    <?php foreach ($data['all_projects'] as $key => $value): ?>
                        <option <?= (isset($_POST['project']) && $_POST['project'] == $value['id_proj']) ? 'selected' : '' ?> value="<?= $value['id_proj'] ?>"><?= $value['project_title'] ?></option>
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
    <div  id="content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Название проекта</th>
                    <th scope="col">Описание проекта</th>
                    <th scope="col">Кто добавил</th>
                    <th scope="col">Статус лидера</th>
                    <th scope="col">Лидеры проекта</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['projects'])): ?>
                    <?php foreach ($data['projects'] as $key => $value): ?>
                        <tr id="tag_<?= $value['id_proj'] ?>" class="relat_box_project_<?= $value['id_proj'] ?>">
                            <th scope="row"><?= $value['id_proj'] ?></th>
                            <td><a  href="/projects/view?id=<?= $value['id_proj'] ?>"><?= $value['project_title'] ?></a></td>
                            <td><p><?= $value['project_description'] ?></p></td>
                            <td><a  href="/leaders/view?id=<?= $value['id_lid'] ?>"><?= $value['fio'] ?></a></td>
                            <td><?= $value['status'] ?></td>
                            <td>
                                <?php if (!empty($value['leaders'][0])): ?>
                                    <?php foreach ($value['leaders'] as $key1 => $value1): ?>
                                        <a  href="/leaders/view?id=<?= $value1['id_lid'] ?>"><span> &bull; </span> <?= $value1['fio'] ?></a><br>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Нет лидеров</p>
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
                            </td>
                            <td class="buttons_admin_table">
                                <?php if ($value["checked"] == '0' || $value["checked"] == '2' || $value["checked"] == '3'): ?>
                                    <a href="javascript:void(0);" onclick="status(1, <?= $value['id_proj'] ?>);"><span class="success_admin_button"></span></a>
                                <?php endif; ?>
                            </td>
                            <td class="buttons_admin_table">
                                <a  href="/projects/edit?id=<?= $value['id_proj'] ?>"><span class="edit_admin_button"></span></a>
                            </td>
                            <td class="buttons_admin_table">
                                <?php if ($value["checked"] == '0' || $value["checked"] == '1' || $value["checked"] == '3'): ?>
                                    <a href="javascript:void(0);" class="open-modal"  onclick="modal_box('<?= $value['id_proj'] ?>')">
                                    <span class="delete_admin_button"></span></a>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9">Нет проектов</td></tr>
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
                            <a href="javascript:void(0);" onclick="send('', <?= $data['countpages'] ?>); return up();" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
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
