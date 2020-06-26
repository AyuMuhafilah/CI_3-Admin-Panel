<div>
    <ul>
        <?php foreach ($modules as $module) : ?>
            <li><a href="<?= $module['url'] ?>"><?= $module['module'] ?></a></li>
        <?php endforeach ?>
    </ul>
</div>