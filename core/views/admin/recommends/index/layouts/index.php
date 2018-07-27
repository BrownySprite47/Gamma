<div class="container-fluid">
    <div class="list-group-item title_menu_admin"><h2>РЕКОМЕНДАЦИИ</h2><a href="#recommends_link" class="btn btn_gamma">Добавить рекомендацию</a></div>
    <div class="row select_admin">
        <div class="form-group">
            <div class="col-xs-2">
                <select  data-live-search="true" id="condition_filter" class="selectpicker form-control" onchange="send('condition');">
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == 'all') ? 'selected' : '' ?> value="all" class="title">Состояние</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '0') ? 'selected' : '' ?> value="0">Новые рекомендации</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '1') ? 'selected' : '' ?> value="1">Одобренные рекомендации</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '2') ? 'selected' : '' ?> value="2">Отклоненные рекомендации</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '3') ? 'selected' : '' ?> value="3">Отредактированные рекомендации</option>
                </select>
            </div>
            <div class="col-xs-3">
                <select  data-live-search="true" id="from_recommend" class="selectpicker form-control" onchange="send('from_recommend');">
                    <option value="all" class="title">Кто рекомендовал</option>
                    <?php foreach ($data['from_recommend'] as $key => $value): ?>
                        <option <?= (isset($_POST['from_recommend']) && $_POST['from_recommend'] == $value['user_id']) ? 'selected' : '' ?>
                                value="<?= $value['user_id']?>">
                            <?= $value["user_fio"].' ('.(!empty($value["user_project_title"]) ? $value["user_project_title"] : 'Нет проекта').')' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xs-3">
                <select  data-live-search="true" id="to_recommend" class="selectpicker form-control" onchange="send('to_recommend');">
                    <option value="all" class="title">Кого рекомендовал</option>
                    <?php foreach ($data['to_recommend'] as $key => $value): ?>
                        <option <?= (isset($_POST['to_recommend']) && $_POST['to_recommend'] == $value['id_lid']) ? 'selected' : '' ?>
                                value="<?= $value['id_lid']?>">
                            <?= $value["leader_fio"].' ('.(!empty($value["leader_project_title"]) ? $value["leader_project_title"] : 'Нет проекта').')' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xs-2">
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
                    <th scope="col">А</th>
                    <th scope="col">id</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Кто рекомендовал</th>
                    <th scope="col">Кого рекомендовал</th>
                    <th scope="col">Данные рекомендации</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($data['recommends'])): ?>
                <?php foreach ($data['recommends'] as $leader): ?>
                        <tr class="relat_box_leader_<?= $leader['user_id'] ?>_<?= $leader['id_lid'] ?>">
                            <td scope="row">
                                <?php if ($leader["admin"] == '1'): ?><span style="color: red; font-size: 20px; font-weight: bold">A</span><?php endif; ?>
                            </td>
                            <td><?= $leader["id"] ?></td>
                            <td><?= $leader["last_modified"] ?></td>
                            <td><a target="blank" href="/leaders/view?id=<?= $leader['user_id'] ?>" onclick="show(this);"><?= $leader['user_fio'] ?><br>(<?= $leader['user_project_title'] ? $leader['user_project_title'] : 'Нет проекта'  ?>)</a></td>
                            <td><a target="blank" href="/leaders/view?id=<?= $leader['id_lid'] ?>" onclick="show(this);"><?= $leader['leader_fio'] ?><br>(<?= $leader['leader_project_title'] ? $leader['leader_project_title'] : 'Нет проекта'  ?>)</a></td>
                            <td>
                                <p><span>Проект: </span><?= $leader["project_name"] ?></p>
                                <p><span>Город: </span><?= $leader["city"] ?></p>
                                <p><span>Email: </span><?= $leader["email"] ?></p>
                                <p><span>Соцсеть: </span><?php if ($leader["social"] != ''): ?><a href="<?= $leader["social"] ?>">Ссылка</a><?php endif; ?></p>
                                <p><span>Причина: </span><?= $leader["reason"] ?></p>
                            </td>
                            <td>
                                <?php if ($leader["checked"] == '0'): ?>
                                    <p>Новые</p>
                                <?php endif; ?>
                                <?php if ($leader["checked"] == '1'): ?>
                                    <p>Одобренные</p>
                                <?php endif; ?>
                                <?php if ($leader["checked"] == '2'): ?>
                                    <p>Отклоненные</p>
                                <?php endif; ?>
                                <?php if ($leader["checked"] == '3'): ?>
                                    <p>Отредактированные</p>
                                <?php endif; ?>
                            </td>
                            <td class="buttons_admin_table">
                                <?php if ($leader["checked"] == '0' || $leader["checked"] == '2' || $leader["checked"] == '3'): ?>
                                    <a href="javascript:void(0);" onclick="status(1, <?= $leader['id_lid'] ?>, <?= $leader['user_id'] ?>);">
                                    <span class="success_admin_button"></span></a>
                                <?php endif; ?>
                            </td>
                            <td class="buttons_admin_table">
                                <?php if ($leader["checked"] == '0' || $leader["checked"] == '1' || $leader["checked"] == '3'): ?>
                                    <a href="javascript:void(0);" class="open-modal" onclick="modal_box(<?= $leader['id_lid'] ?>, <?= $leader['user_id'] ?>)">
                                    <span class="delete_admin_button"></span></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="9">Нет рекомендаций</td></tr>
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
        <div class="container">
            <div id="navigation" class="col-xs-12">
                <nav class="nav_page" aria-label="Page navigation" style="text-align: center;">
                    <ul class="pagination">
                        <li <?= ($data['numpage'] <= 1 ? 'class="disabled"' : '') ?>>
                            <a href="javascript:void(0);" onclick="send('', 1); return up();" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        $limit = ($data['countpages'] < 5) ? $data['countpages'] : 5;
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
        </div>
    <?php endif; ?>

    <div id="recommends_link" class="content_leader leader checkSize">
        <div class="title_info_box">
            <div class="title_text_box">Добавить новую рекомендацию</div>
        </div>
        <div class="wrapper_recomm">
            <div class="col-xs-4">
                <?php if (!empty($data['create_recommends'])): ?>
                    <select id="dataFromRecommends" onchange="get('from')" data-live-search="true" class="selectpicker_1 selectpicker form-control" name="fio">
                        <option value="" class="title">Кто рекомендовал:</option>
                        <?php foreach ($data['create_recommends'] as $filter) {
                            echo '<option value="'.$filter['id_lid'].'">'.$filter['leader_fio'].' ('.($filter['leader_project_title'] ? $filter['leader_project_title'] : 'Нет проекта').')</option>';
                        }?>
                    </select>
                    <div id="ajax_info_from"></div>
                <?php else: ?>
                    <p style="text-align: center;">Нет лидеров</p>
                <?php endif; ?>
            </div>
            <div class="col-xs-4">
                <?php if (!empty($data['create_recommends'])): ?>
                    <select id="dataToRecommends" onchange="get('to')" data-live-search="true" class="selectpicker selectpicker_1 form-control" name="fio">
                        <option value="" class="title">Кого рекомендовал:</option>
                        <?php foreach ($data['create_recommends'] as $filter) {
                            echo '<option value="'.$filter['id_lid'].'">'.$filter['leader_fio'].' ('.($filter['leader_project_title'] ? $filter['leader_project_title'] : 'Нет проекта').')</option>';
                        }?>
                    </select>
                    <div id="ajax_info_to"></div>
                <?php else: ?>
                    <p style="text-align: center;">Нет лидеров</p>
                <?php endif; ?>
            </div>
            <div class="col-xs-4">
                <p><textarea style="resize: none;" id="reason_add_recom_admin" rows="10" class="form-control" name="text" placeholder="Укажите причину рекомендации"></textarea></p>
            </div>
        </div>
        <div class="col-xs-12" style="text-align: center;">
            <p id="success_send_data" style="margin: 37px;"></p>
            <a id="success_send_data_ok" style="padding: 11px 30px;" href="javascript:void(0);" class="btn btn_gamma" onclick="recommend();"><i class="fa fa-check" aria-hidden="true"></i> Добавить рекомендацию</a>
            <a id="success_send_data_again" style="padding: 11px 30px;display: none;" href="/admin/recommends" class="btn btn_gamma"><i class="fa fa-check" aria-hidden="true"></i> Добавить еще</a>
        </div>
    </div>
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
