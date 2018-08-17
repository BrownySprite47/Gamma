<div class="container-fluid">
    <div class="col-xs-12 visible-xs">
        <div class="wrapper_leaders_filter main_mobile" onclick="main_filter_projects()">
            <select id="min_filter"class="selectpicker"><option value="all" class="title">Фильтры</option></select>
        </div>
    </div>
    <div class="">
        <div class="col-xs-12 hidden-xs">
            <div class="wrapper_projects_filter clear">
                <a class="clear_filter" href="javascript:void(0);" onclick="ClearFilter();">Сбросить фильтр</a>
            </div>
        </div>
        <div class="mobile_filter">
            <div class="col-xs-12">
                <div class="wrapper_projects_filter">
                    <select id="title_filter" data-live-search="true" class="selectpicker" onchange="FilterProjectTitle();">
                        <option value="all" class="title">Название проекта</option>
                        <?php if (!empty($data['filters']['cities'])): ?>
                            <?php foreach ($data['filters']['titles'] as $filter): ?>
                                <option <?= isset($_POST['title']) && $_POST['title'] == $filter['project_title'] ? 'selected' : '' ?> value="<?= $filter['project_title'] ?>"><?= $filter['project_title'] ?></option>;
                            <?php endforeach;?>
                        <?php else: ?>
                            <option value="all">Нет данных</option>
                        <?php endif; ?>
                    </select>
                    <select id="city_filter" data-live-search="true" class="selectpicker" onchange="FilterCity();">
                        <option value="all" class="title">Город</option>
                            <?php if (!empty($data['filters']['cities'])): ?>
                                <?php foreach ($data['filters']['cities'] as $filter) : ?>
                                    <?php if ($filter['author_location'] == "")  continue; ?>
                                    <option <?= isset($_POST['city']) && $_POST['city'] == $filter['author_location'] ? 'selected' : '' ?> value="<?= $filter['author_location'] ?>"><?= $filter['author_location'] ?></option>;
                                <?php endforeach;?>
                            <?php else: ?>
                                <option value="all">Нет данных</option>
                            <?php endif; ?>
                    </select>
                    <select id="age_filter" class="selectpicker" onchange="FilterProjects();">
                        <option value="all" class="title">Возраст</option>
                        <?php if (!empty($data['dynamicFilter']['ages'])): ?>
                            <?php foreach ($data['dynamicFilter']['ages'] as $key => $value) : ?>
                                <option <?= isset($_POST['age']) && $_POST['age'] == $key ? 'selected' : '' ?>  value="<?= $key ?>"><?= $value ?></option>;
                            <?php endforeach;?>
                        <?php else: ?>
                            <option value="all">Нет данных</option>
                        <?php endif; ?>
                    </select>
                    <select id="predmet_filter" class="selectpicker" onchange="FilterProjects();">
                        <option value="all" class="title">Предмет</option>
                        <?php if (!empty($data['dynamicFilter']['predmets'])): ?>
                            <?php foreach ($data['dynamicFilter']['predmets'] as $key => $value) : ?>
                                <option <?= isset($_POST['predmet']) && $_POST['predmet'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>;
                            <?php endforeach;?>
                        <?php else: ?>
                            <option value="all">Нет данных</option>
                        <?php endif; ?>
                    </select>
                    <select id="metapredmet_filter" class="selectpicker" onchange="FilterProjects();">
                        <option value="all" class="title">Метапредмет</option>
                        <?php if (!empty($data['dynamicFilter']['metapredmets'])): ?>
                            <?php foreach ($data['dynamicFilter']['metapredmets'] as $key => $value) : ?>
                                <option <?= isset($_POST['metapredmet']) && $_POST['metapredmet'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>;
                            <?php endforeach;?>
                        <?php else: ?>
                            <option value="all">Нет данных</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 visible-xs">
                <div class="wrapper_projects_filter clear">
                    <a class="clear_filter" href="javascript:void(0);" onclick="ClearFilter();">Сбросить фильтр</a>
                </div>
            </div>
        </div>
        <?php foreach ($data['projects'] as $project): ?>
            <div class="col-xs-12">
                <div class="wrapper_projects_info">
                    <a href="/index/projects/view?id=<?= $project['id_proj'] ?>">
                        <div class="mobile_predmet_image">
                            <span class="project_name"><?= $project['project_title'] ?></span><br>
                            <?php if (!empty($project['image_name'])): ?>
                                <span class="project_image" style="background-image: url('<?= CORE_IMG_PATH . $project['image_name']?>);"></span>
                            <?php else: ?>
                                <span class="project_image" style="background-image: url(<?= CORE_IMG_PATH . 'img_not_found.png' ?>);"></span>
                            <?php endif; ?>
                        </div>
                        <div class="mobile_city">
                            <p class="mobile_titles visible-xs">Город</p>
                            <?php if (!empty($project['author_location'])): ?>

                                <span><?= $project['author_location'] ?></span><br>
                            <?php else: ?>
                                <span>Не указано</span><br>
                            <?php endif; ?>
                        </div>
                        <div class="mobile_consumers">
                            <p class="mobile_titles visible-xs">Возраст</p>
                            <?php if (!empty($project['ages'])): ?>
                                <?php foreach ($project['ages'] as $key => $value): ?>
                                    <span><?= $data['localizations']['ages'][$key] ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span>Не указано</span><br>
                            <?php endif; ?>
                        </div>
                        <div class="mobile_predmet">
                            <p class="mobile_titles visible-xs">Предмет</p>
                            <?php if (!empty($project['predmets'])): ?>
                                <?php foreach ($project['predmets'] as $key => $value): ?>
                                    <span><?= $data['localizations']['predmets'][$key] ?></span><br>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span>Не указано</span><br>
                            <?php endif; ?>
                        </div>
                        <div class="mobile_metapredmet">
                            <p class="mobile_titles visible-xs">Метапредмет</p>
                            <?php if (!empty($project['metapredmets'])): ?>
                                <?php foreach ($project['metapredmets'] as $key => $value): ?>
                                    <span><?= $data['localizations']['metapredmets'][$key] ?></span><br>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span>Не указано</span><br>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (empty($data['projects'])): ?>
            <div class="col-xs-12">
                <div>
                    <span class="not_found">По вашему запросу ничего не найдено</span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php if ($data['countpages'] > 1): ?>
    <div class="container-fluid">
        <div id="navigation" class="col-xs-12">
            <nav class="nav_page" aria-label="Page navigation" style="text-align: center;">
                <ul class="pagination">

                    <li <?= ($data['numpage'] <= 1 ? 'class="disabled"' : '') ?>>
                        <a href="javascript:void(0);" onclick="FilterProjects(1); return up();" aria-label="Previous">
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
                            <a href="javascript:void(0);" onclick="FilterProjects(<?= $i ?>); return up();"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <li <?= ($data['numpage'] == $data['countpages'] ? 'class="disabled"' : '') ?>>
                        <a href="javascript:void(0);" onclick="FilterProjects(<?= $data['countpages'] ?>); return up();" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
<?php endif; ?>
</div>
<script>
    $('.selectpicker').selectpicker('refresh');
    $('.selectpicker').selectpicker({ size: 8 });
</script>
<?php if (isset($data['js'])): ?>
    <?php foreach ($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>
