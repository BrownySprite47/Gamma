<?php include CORE_DIR . '/core/views/layouts/header/index/index/index.php';  ?>
<div id="content-main">
    <div class="container" id="content-main-height">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3 class="success_reg">Регистрация</h3>
                <div class="panel panel-login">
                    <div class="panel-body">
                        <form method="POST">
                            <?php if (isset($data['messages']['unique'])): ?>
                                <p class="error_message"><?= $data['messages']['unique'] ?></p>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="text" autofocus name="login"
                                       class="form-control <?= (isset($data['errors']['login'])) ? 'error' : '' ?>"
                                       placeholder="Логин"
                                       value="<?= (isset($_POST['login'])) ? $_POST['login'] : '' ?>">
                            </div>
                            <?php if (isset($data['errors']['login'])):?>
                                <?php foreach ($data['errors']['login'] as $key => $value):?>
                                    <?php if (isset($data['messages'][$value])): ?>
                                        <p class="error_message"><?= $data['messages'][$value] ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="email" name="email"
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
                                <input type="password" name="password"
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
                                <input type="password" name="password2"
                                       class="form-control <?= (isset($data['errors']['password2'])) ? 'error' : '' ?>"
                                       placeholder="Повторите пароль"
                                       value="<?= (isset($_POST['password2'])) ? $_POST['password2'] : '' ?>">
                            </div>
                            <?php if (isset($data['errors']['password2'])):?>
                                <?php foreach ($data['errors']['password2'] as $key => $value):?>
                                    <?php if (isset($data['messages'][$value])): ?>
                                        <p class="error_message"><?= $data['messages'][$value] ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (isset($data['errors']['password2']['equal'])):?>
                                <p class="error_message"><?= $data['errors']['password2']['equal'] ?></p>
                            <?php endif; ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <button class="form-control btn btn-register">Зарегистрироваться</button>
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
<?php include CORE_DIR . '/core/views/layouts/footer/index/index/index.php' ?>