<div class="container-fluid">
    <div class="list-group-item title_menu_admin"><h2>ПРИВЯЗКИ ПРОФИЛЕЙ</h2><a href="/projects/add" class="btn btn_gamma" >Добавить привязку</a></div>
    <div class="row select_admin">
        <div class="form-group">                                         
            <div class="col-xs-4">
                <select  data-live-search="true" id="condition_filter" class="selectpicker form-control" onchange="send('condition');">
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == 'all') ? 'selected' : '' ?> value="all" class="title">Состояние</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '0') ? 'selected' : '' ?> value="0">Новые запросы на привязку</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '1') ? 'selected' : '' ?> value="1">Одобренные привязки</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '2') ? 'selected' : '' ?> value="2">Отклоненные привязки</option>   
                </select>
            </div>
            <!-- <div class="col-xs-1"></div> -->
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
                    <th scope="col">А</th>
                    <th scope="col">id</th>
                    <th scope="col">ФИО Юзера</th>
                    <th scope="col">Дополнительная информация</th>
                    <th scope="col">ФИО Лидера</th>
                    <th scope="col">Дополнительная информация</th>
                    <th scope="col">Состояние</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($data['doubles'])): ?>
                <?php foreach ($data['doubles'] as $leader): ?>
                    <tr class="relat_box_leader_<?= $leader['id_user'] ?>">
                        <td scope="row">
                            <?php if($leader["admin"] == '1'): ?><i class="fa fa-circle" aria-hidden="true"></i><?php endif; ?>
                        </td>
                        <td><?= $leader["id"] ?></td>
                        <td><a target="blank" href="/leader?id=<?= $leader['id_user'] ?>" onclick="show(this);"><?= $leader['user_fio'] ?></a></td>
                        <td>
                            <p><span class="title">Статус:</span> <?= $leader["user_status"] ?></p>
                            <p><span class="title">Email:</span> <?= $leader["email"] ?></p>
                            <p><span class="title">Телефон:</span> <?= $leader["telephone"] ?></p>
                            <p><span class="title">Соцсеть:</span> <?php if($leader["user_social"] != ''): ?><a target="_blank" href="<?= $leader["user_social"] ?>">ССЫЛКА</a><?php endif; ?></p>
                        </td>
                        <td><a target="blank" href="/leader?id=<?= $leader['id_lid'] ?>" onclick="show(this);"><?= $leader['leader_fio'] ?></a></td>
                        <td>
                            <p><span class="title">Статус:</span> <?= $leader["leader_status"] ?></p>
                            <p><span class="title">Email:</span> <?= $leader["leader_email"] ?></p>
                            <p><span class="title">Телефон:</span> <?= $leader["leader_telephone"] ?></p>
                            <p><span class="title">Соцсеть:</span> <?php if($leader["leader_social"] != ''): ?><a target="_blank" href="<?= $leader["leader_social"] ?>">ССЫЛКА</a><?php endif; ?></p>
                        </td>
                        <td>
                            <?php if($leader["checked"] == '0'): ?>
                                <p>Новые</p>
                            <?php endif; ?>
                            <?php if($leader["checked"] == '1'): ?>
                                <p>Одобренные</p>
                            <?php endif; ?>
                            <?php if($leader["checked"] == '2'): ?>
                                <p>Отклоненные</p>
                            <?php endif; ?>
                        </td>
                        <td class="buttons_admin_table">
                            <?php if($leader["checked"] == '0' || $leader["checked"] == '2'): ?>
                                <a href="javascript:void(0);" onclick="status(1, <?= $leader['id'] ?>, <?= $leader['id_user'] ?>);"><span class="success_admin_button"></span></a>
                            <?php endif; ?>
                        </td>
                        <td class="buttons_admin_table">
                            <?php if($leader["checked"] == '0' || $leader["checked"] == '1'): ?>
                            <a href="javascript:void(0);" class="open-modal" onclick="modal_box(<?= $leader['id'] ?>, <?= $leader['id_user'] ?>)">
                                <span class="delete_admin_button"></span></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="9">Нет привязок</td></tr>
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
    <?php if($data['countpages'] > 1): ?>
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

                    if ($left < 1)            { $left = 1;            $right = $left + $limit - 1; }
                    if ($right > $data['countpages']) { $right = $data['countpages']; $left = $right - $limit + 1; }
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
    <div id="doubles_link" class="content_leader leader checkSize" style="margin-top: 75px;">
        <div class="title_info_box">
            <div class="title_text_box">Добавить новую привязку профилей</div>
        </div>
        <div class="wrapper_recomm">
            <div class="col-xs-6">
                <?php if (!empty($data['user_doubles'])): ?>
                    <select id="dataUserDoubles" onchange="get('user')" data-live-search="true" class="selectpicker_1 selectpicker form-control" name="fio">
                        <option value="">Выберите зарегистрированного пользователя</option>
                        <?php foreach ($data['user_doubles'] as $filter){
                            echo '<option value="'.$filter['id_lid'].'">'.$filter['fio'].'</option>';
                        }?>
                    </select>
                    <div id="ajax_info_user"></div>
                <?php else: ?>
                    <p style="text-align: center;">Нет свободных зарегистрированных пользователей</p>
                <?php endif; ?>
            </div>
            <div class="col-xs-6">
                <?php if (!empty($data['leader_doubles'])): ?>
                    <select id="dataLeaderDoubles" onchange="get('leader')" data-live-search="true" class="selectpicker selectpicker_1 form-control" name="fio">
                        <option value="">Выберите неавторизованного лидера</option>
                        <?php foreach ($data['leader_doubles'] as $filter){
                            echo '<option value="'.$filter['id_lid'].'">'.$filter['fio'].'</option>';
                        }?>
                    </select>
                    <div id="ajax_info_leader"></div>
                <?php else: ?>
                    <p style="text-align: center;">Нет непривязанных лидеров</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xs-12" style="text-align: center;">
            <p id="success_send_data"></p>
            <a id="success_send_data_ok" style="padding: 11px 30px;" href="javascript:void(0);" class="btn btn_gamma" onclick="connect();"><i class="fa fa-check" aria-hidden="true"></i> Связать</a>
            <a id="success_send_data_again" style="padding: 11px 30px;display: none;" href="/admin/doubles" class="btn btn_gamma"><i class="fa fa-check" aria-hidden="true"></i> Добавить еще</a>
        </div>
    </div> 
    <script>
        $('.selectpicker').selectpicker('refresh');
        $('.selectpicker').selectpicker({ size: 8 });
    </script>
</div>
<?php if(isset($data['js'])): ?>
    <?php foreach($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>
