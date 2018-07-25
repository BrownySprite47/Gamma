    <?php 
    $title = 'Детальная статистика';
    include CORE_DIR . '/core/views/layouts/header/index/index/index.php';
    ?>
    <script src="/assets/bootstrap/js/bootstrap-select.js"></script>
    <div id="content-main">
<script src="/assets/js/script.js"></script>
 <div class="container" id="content-main-height">
    <div class="list-group">
        <div class="tab-content col-xs-12">
            <div id="panel2">
                <div class="list-group">
                    <div  id="content">
                        <div class="list-group-item title_menu_admin"><h2>ДЕТАЛЬНАЯ СТАТИСТИКА</h2></div>
                        <div class="list-group count_on_page">
                            <div class="col-xs-9">&nbsp;</div>
                            <div class="col-xs-2">Показывать по:</div>            
                            <div class="col-xs-1">                
                                <select onchange="AjaxSendPostStatistic()" id="count_on_page" name="count_on_page" class="selectpicker form-control">
                                    <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '10') ? 'selected' : ''?> value="10">30</option>
                                    <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '50') ? 'selected' : ''?> value="50">50</option>
                                    <option <?= (isset($_POST['count_on_page']) && $_POST['count_on_page'] == '100') ? 'selected' : ''?> value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="" style="margin: 75px 0;">
                            <table class="table table-bordered table-statistics">
                                <thead style="font-size: 12px;">
                                    <tr>
                                        <th scope="col">Дата регистрации</th>
                                        <th scope="col">ФИО</th>
                                        <th scope="col">Проект</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $value): ?>                                   
                                        <tr>                                      
                                            <td scope="col"><?= $value['date_create'] ?></td>
                                            <?php if(!empty($value['fio'])): ?>
                                                <td scope="col"><a  href="/leader?id="<?= $value['user'] ?>><?= $value['fio'] ?></a></td>
                                            <?php else: ?>
                                                <td scope="col">Нет ФИО</a></td>
                                            <?php endif; ?>
                                            <?php if(!empty($value['project_title'])): ?>
                                                <td scope="col"><a  href="/project?id="<?= $value['id_proj'] ?>><?= $value['project_title'] ?></a></td>
                                            <?php else: ?>
                                                <td scope="col">Нет проектов</a></td>
                                            <?php endif; ?>
                                                                                               
                                        </tr>
                                    <?php endforeach; ?>                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.selectpicker').selectpicker('refresh');
    $('.selectpicker').selectpicker({ size: 8 });
</script>
 
    </div>    
    <?php include CORE_DIR . '/core/views/layouts/footer/index/index/index.php' ?>

