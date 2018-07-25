<?php include CORE_DIR . '/core/views/layouts/header/index/index/index.php'; ?>
<div id="content-main">
    <div class="container" id="content-main-height">
        <div class="list-group">
            <div class="form-horizontal">
                <?php if ((isset($_GET['t']) && $_GET['t'] == '1')): ?>
                    <div class="list-group-item"><a href="javascript:history.back()">Назад</a></div>
                <?php endif; ?>
                <div class="list-group-item title_menu_admin">
                    <h2>РЕДАКТИРОВАНИЕ РЕКОМЕНДАЦИИ</h2>
                </div>
                <div class="list-group-item">
                    <input style="display: none;" id="user_id" value="<?= $_SESSION['id'] ?>">
                    <input style="display: none;" id="id_lid" value="<?= $data['user'][0]['id_lid'] ?>">
                    <div class="form-group leaders_photo_box">
                        <div class="col-xs-9">
                            <div class="col-xs-5">
                                <label for="familya" class="control-label">Фамилия:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" maxlength="150" name="familya" class="form-control" id="familya" placeholder="" value="<?= $data["leaders"][0]["familya"] ?>">
                                <p id='familya_lid' class='error'></p>
                            </div>
                            <div class="col-xs-5">
                                <label for="name" class="control-label">Имя:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" maxlength="150" name="name" class="form-control" id="name" placeholder="" value="<?= $data["leaders"][0]["name"] ?>">
                                <p id='name_lid' class='error'></p>
                            </div>
                            <div class="col-xs-5">
                                <label for="project" class="control-label">Проект:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" maxlength="150" name="project" class="form-control" id="project" placeholder="" value="<?= $data["recom"][0]["project_name"] ?>">
                                <p id='project_lid' class='error'></p>
                            </div>
                            <div class="col-xs-5">
                                <label for="city" class="control-label">Город:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" maxlength="50" name="city" class="form-control" id="city" placeholder="" value="<?= $data["recom"][0]["city"] ?>">
                                <p id='city_lid' class='error'></p>
                            </div>
                            <div class="col-xs-5">
                                <label for="email" class="control-label">Email:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="email" required maxlength="200" name="email" class="form-control" id="email" placeholder="" value="<?= $data["recom"][0]["email"] ?>">
                                <p id='email_lid' class='error'></p>
                                <?php if($data["recom"][0]["email"] == ''): ?>
                                    <p style="font-size: 12px;">если вы не укажете e-mail, мы не сможем отправить приглашение пользователю в сообщество</p>
                                <?php else: ?>
                                    <p style="font-size: 12px;">проверьте корректность указанного e-mail</p>
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-5">
                                <label for="social" class="control-label">Страница в соц.сетях:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" maxlength="200" name="social" class="form-control" id="social" placeholder="" value="<?= $data["recom"][0]["social"] ?>">
                                <p id='social_lid' class='error'></p>
                                <?php if($data["recom"][0]["social"] == ''): ?>
                                    <p style="font-size: 12px;">если вы не укажете соцсеть, мы не сможем найти пользователя, и связаться с ним.</p>
                                <?php else: ?>
                                    <p style="font-size: 12px;">проверьте корректность указанной соцсети</p>
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-5">
                                <label for="contact_info" class="control-label">Причина рекомендации:</label>
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="reason" class="form-control" id="reason" placeholder="" value="<?= $data["recom"][0]["reason"] ?>">
                                <p style="font-size: 12px;">эта информация непублична, она нужна команде проекта GAMMA для последующей аналитики</p>
                                <p id='contact_info_lid' class='error'></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item save_leader">
                    <div class="form-group">
                        <div class="col-xs-offset col-xs-12">
                            <button id="add_lid_btn" type="submit" onclick="AjaxSendAddLeaderUpdate(<?= $_GET['id'] ?>);" class="btn btn-danger">Сохранить</button>

                            <?php if(isset($_GET['new']) && isset($_SESSION['recommend_leaders'][$num+1])): ?>
                                <a id="next_recommend" style="display: none;" href="/user/edit_recommend?id=<?= $_SESSION['recommend_leaders'][$num+1 ]['id_lid'] ?>&num=<?= $num+1 ?>&new=true" class="btn btn-success">К следующей рекомендации</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="form-group">
                        <p id="result_public"></p>
                    </div>
                </div>
                <!-- HTML-код модального окна-->
                <div id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Ваши изменения успешно сохранены</h4>
                            </div>
                            <div class="modal-footer">
                                <a href="/user/recommend" class="btn btn-success">Ок</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- HTML-код модального окна-->
                <div id="myModal3" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Заполните все обязательные поля и повторите попытку</h4>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-danger" data-dismiss="modal">Ок</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include CORE_DIR . '/core/views/layouts/footer/index/index/index.php' ?>
