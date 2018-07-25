<div class="container-fluid">
    <div class="list-group-item title_menu_admin"><h2>ТЕГИ</h2><a href="/projects/add" class="btn btn_gamma" >Добавить тег</a></div>
    <div class="row select_admin">
        <div class="form-group">                                         
            <div class="col-xs-3">
                <select  data-live-search="true" id="condition_filter" class="selectpicker form-control" onchange="send('condition');">
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == 'all') ? 'selected' : '' ?> value="all" class="title">Состояние</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '0') ? 'selected' : '' ?> value="0">Новые теги</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '1') ? 'selected' : '' ?> value="1">Проверенные теги</option>
                    <option <?= (isset($_POST['condition']) && $_POST['condition'] == '2') ? 'selected' : '' ?> value="2">Отклоненные теги</option>     
                </select>
            </div>
            <div class="col-xs-6">
                <select  data-live-search="true" id="tag" class="selectpicker form-control" onchange="send('tag');">
                    <option value="all" class="title">Название тега</option>
                    <?php foreach ($data['all_tags'] as $key => $value): ?>
                        <option <?= (isset($_POST['tag']) && $_POST['tag'] == $value['id']) ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
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
                    <th scope="col">Название тега</th>
                    <th scope="col">Хочу</th>
                    <th scope="col">Могу</th>
                    <th scope="col">Кто предложил</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($data['tags'])): ?>
                <?php foreach ($data['tags'] as $tag): ?>
                <tr id="tag_<?= $tag['id']; ?>">
                    <th scope="row"><?= $tag['id']; ?></th>
                    <td id="name_tag_<?= $tag['id']; ?>_name"><?= $tag['name']; ?></td>
                    <td id="name_tag_<?= $tag['id']; ?>_want"><?= $tag['tag_i_can']; ?></td>
                    <td id="name_tag_<?= $tag['id']; ?>_need"><?= $tag['tag_i_want']; ?></td>
                    <td id="name_tag_<?= $tag['id']; ?>_who_is_add"><a  href="/leader?id=<?= $tag['id_lid']; ?>"><?= $tag['fio']; ?></a></td>
                    <td class="buttons_admin_table"><a href="javascript:void(0);" onclick="status(1, <?= $tag['id']; ?>);"><span class="success_admin_button"></span></a></td>
                    <td class="buttons_admin_table"><a href="javascript:void(0);" onclick="$('#tag_<?= $tag['id']; ?>_edit').css('display', ''); $('#tag_<?= $tag['id']; ?>').css('display', 'none')"><span class="edit_admin_button"></span></a></td>
                    <td class="buttons_admin_table"><a href="javascript:void(0);" class="open-modal" onclick="modal_box('<?= $tag['id']; ?>')"><span class="delete_admin_button"></span></a></td>
                </tr>                                        
                <tr style="display: none;" id="tag_<?= $tag['id']; ?>_edit">
                    <th scope="row"><?= $tag['id']; ?></th>
                    <td><input id="name_tag_<?= $tag['id']; ?>" class="form-control" type="text" value="<?= $tag['name']; ?>"></td>
                    <td><input id="want_tag_<?= $tag['id']; ?>" class="form-control" type="text" value="<?= $tag['tag_i_can']; ?>"></td>
                    <td><input id="need_tag_<?= $tag['id']; ?>" class="form-control" type="text" value="<?= $tag['tag_i_want']; ?>"></td>
                    <td id="name_tag_<?= $tag['id']; ?>_who_is_add"><a  href="/leader?id=<?= $tag['id_lid']; ?>"><?= $tag['fio']; ?></a></td>
                    <td colspan="2">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="edit(<?= $tag['id']; ?>
                            <?php if(!isset($data['tags'])): ?>, 'true'<?php endif; ?>)">Сохранить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">Нет тегов</td></tr>
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
    <div id="myModal_error" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Невозможно отклонить данный тег. Он используется!</h4>
                </div>
                  <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>
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
