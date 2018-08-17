<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php';  ?>
<div id="content-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h3 class="success_reg">Вход</h3>
                <?php if (isset($_GET['reg']) && $_GET['reg'] == 'success'): ?>
                    <p class="success_reg">Поздравляем! Вы успешно зарегистрировались.<br>Теперь вы можете войти на сайт, используя свой логин и пароль</p>
                <?php endif; ?>
                <div class="panel panel-login">
                    <div class="panel-body">
                        <form method="POST">
                            <?php if (isset($data['messages']['not_unique'])): ?>
                                <p class="error_message"><?= $data['messages']['not_unique'] ?></p>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="email"
                                       name="email"
                                       class="form-control <?= (isset($data['errors']['email'])) ? 'error' : '' ?>"
                                       placeholder="Email"
                                       value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>">
                            </div>
                            <?php if (isset($data['errors']['email'])):?>
                                <?php foreach ($data['errors']['email'] as $key => $value):?>
                                    <?php if (isset($data['messages'][$value])): ?>
                                        <p class="error_message"><?= $data['messages'][$value] ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="password"
                                       name="password"
                                       class="form-control <?= (isset($data['errors']['password'])) ? 'error' : '' ?>"
                                       placeholder="Пароль"
                                       value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>">
                            </div>
                            <?php if (isset($data['errors']['password'])):?>
                                <?php foreach ($data['errors']['password'] as $key => $value):?>
                                    <?php if (isset($data['messages'][$value])): ?>
                                        <p class="error_message"><?= $data['messages'][$value] ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <button class="form-control btn btn-register">Войти</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>