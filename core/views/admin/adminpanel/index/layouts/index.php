<h1>Тут будет административная панель</h1>


<?php if(isset($data['js'])): ?>
    <?php foreach($data['js'] as $js): ?>
        <script src="/assets/<?=$js?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php unset($data['js']); ?>

