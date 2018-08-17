<?php //$data['css'][] = '/assets/css/registration.css';?>
<?php include CORE_DIR . '/core/views/index/layouts/header/index/index/index.php'; ?>
<div id="content-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3 class="success_reg">Вход</h3>
                <div class="panel panel-login">
                    <div class="panel-body" style="text-align: center; padding: 80px;">
                        <?php if (isset($_SESSION['user'])): ?>
                            <?php header("location: /"); ?>
                        <?php elseif (!isset($_GET['code']) && !isset($_SESSION['user'])): ?>
                            <?php foreach ($data as $title => $adapter): ?>
                                <?php if (ucfirst($title) == 'Vk'):?>
                                <a href="<?=$adapter->getAuthUrl()?>" style="padding: 20px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/Vkontakte.png') no-repeat;"></a>
                            <?php else:?>
                                <a href="<?=$adapter->getAuthUrl()?>" style="padding: 20px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/<?=ucfirst($title)?>.png') no-repeat;"></a>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include CORE_DIR . '/core/views/index/layouts/footer/index/index/index.php' ?>
