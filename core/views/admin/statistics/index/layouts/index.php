<div class="container-fluid">
    <div class="list-group-item title_menu_admin"><h2>СТАТИСТИКА</h2></div>
    <div class="row select_admin">
        <div class="col-xs-3">
            <div class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                <input placeholder="Начальная дата" id="period_start" name="period_start" class="form-control" type="text" value="<?= isset($_POST['start']) ? $_POST['start'] : ''?>" readonly>
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                <input placeholder="Конечная дата" id="period_end" name="period_end" class="form-control" type="text" value="<?= isset($_POST['end']) ? $_POST['end'] : ''?>" readonly>
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
            </div>
        </div>
        <div class="col-xs-2">
            <select id="group_statistics_period" name="group_statistics_period" class="selectpicker form-control">
                <option <?= (isset($_POST['period']) && $_POST['period'] == 'day') ? 'selected' : ''?> value="day">Не выбрано</option>
                <option <?= (isset($_POST['period']) && $_POST['period'] == 'day') ? 'selected' : ''?> value="day">День</option>
                <option <?= (isset($_POST['period']) && $_POST['period'] == 'week') ? 'selected' : ''?> value="week">Неделя</option>
                <option <?= (isset($_POST['period']) && $_POST['period'] == 'month') ? 'selected' : ''?> value="month">Месяц</option>
                <option <?= (isset($_POST['period']) && $_POST['period'] == 'all') ? 'selected' : ''?> value="all">Весь период</option>
            </select>
        </div>
        <div class="col-xs-1">
            <select id="count_on_page" name="count_on_page" class="selectpicker form-control">
                <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '10') ? 'selected' : ''?> value="10">10</option>
                <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '10') ? 'selected' : ''?> value="30">30</option>
                <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '50') ? 'selected' : ''?> value="50">50</option>
                <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '100') ? 'selected' : ''?> value="100">100</option>
            </select>
        </div>
        <div class="col-xs-1"><a href="javascript:void(0);" class="btn btn_gamma" onclick="send();">Показать</a></div>
        <div class="col-xs-1"><a href="javascript:void(0);" class="btn btn_gamma"">Выгрузить</a></div>
    </div>
    <div id="content">
        <table class="table table-bordered table-statistics">
            <thead style="font-size: 12px;">
            <tr>
                <th scope="col" rowspan="2">Период</th>
                <th scope="col" colspan="2">Количество посетителей</th>
                <th scope="col" rowspan="2">Регистрация</th>
                <th scope="col" rowspan="2">Неавторизованные лидеры</th>
                <th scope="col" rowspan="2">Авторизованные лидеры</th>
                <th scope="col" colspan="2">Рекомендации</th>
                <th scope="col" rowspan="2">Клики на соцсеть</th>
                <th scope="col" colspan="2">Заполнение данных</th>
            </tr>
            <tr>
                <th scope="col">Общее количество</th>
                <th scope="col">Уникальные посетители</th>
                <th scope="col">1</th>
                <th scope="col">&ge;2</th>
                <th scope="col">Не обновляли информацию</th>
                <th scope="col">Обновляли информацию</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!is_null($data['statistics'])): ?>
                <?php foreach ($data['statistics'] as $leader): ?>
                    <tr>
                        <?php if(isset($_POST['period']) && $_POST['period'] == 'day'): ?>
                            <td scope="col"><?= $leader["start"] ?></td>
                        <?php else: ?>
                            <td scope="col"><?= $leader["start"] ?> - <?= $leader["end"] ?></td>
                        <?php endif; ?>

                        <?php if($leader["visit_general"][0]['visit_general'] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=visit_general"><?= $leader["visit_general"][0]['visit_general'] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>


                        <?php if($leader["visit_unical"][0]['visit_unical'] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=visit_unical"><?= $leader["visit_unical"][0]['visit_unical'] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>


                        <?php if($leader["registration"][0]["COUNT(*)"] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=3"><?= $leader["registration"][0]["COUNT(*)"] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>


                        <?php if($leader["not_authorized"][0]["COUNT(*)"] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=not_authorized"><?= $leader["not_authorized"][0]["COUNT(*)"] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>


                        <?php if($leader["authorized"][0]["COUNT(*)"] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=authorized"><?= $leader["authorized"][0]["COUNT(*)"] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>


                        <?php if($leader["recommendations1"][0]["COUNT(user)"] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=recommendations1"><?= $leader["recommendations1"][0]["COUNT(user)"] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>


                        <?php if($leader["recommendations2"][0]["COUNT(user)"] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=recommendations2"><?= $leader["recommendations2"][0]["COUNT(user)"] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>


                        <?php if($leader["social"][0]["COUNT(*)"] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=social"><?= $leader["social"][0]["COUNT(*)"] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>


                        <?php if($leader["not_updated"][0]["COUNT(*)"] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=not_updated"><?= $leader["not_updated"][0]["COUNT(*)"] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>


                        <?php if($leader["updated"][0]["COUNT(*)"] != '0'): ?>
                            <td scope="col"><a  href="/admin/detail?start=<?=$leader["start"]?>&end=<?=$leader["end"]?>&type=updated"><?= $leader["updated"][0]["COUNT(*)"] ?></a></td>
                        <?php else: ?>
                            <td scope="col"></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="11">Нет данных</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('.selectpicker').selectpicker('refresh');
    $('.selectpicker').selectpicker({ size: 8 });
</script>
<?php if(isset($data['js'])): ?>
    <?php foreach($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>
