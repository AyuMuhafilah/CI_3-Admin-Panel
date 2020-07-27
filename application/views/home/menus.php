<?php
// Baca lalu hapus komentar ini.
// 
// Kode PHP di bawah menggunakan looping untuk menampilkan module beserta child module nya.
// Disarankan untuk tidak menggunakan recursive function untuk menampilkannya,
// karena setiap desain frontend tidak selalu support untuk menampilkan turunan module yang banyak.
// Gunakan saja nested loop :)
?>

<div>
    <ul>
        <?php foreach ($menus as $menu) : ?>

            <li><a href="<?= $menu['url'] ?>" class="load-to-content"><?= $menu['menu'] ?></a></li>

            <?php if (!empty($menu['childs'])) : ?>
                <ul>

                    <?php foreach ($menu['childs'] as $child_1) : ?>
                        <li><a href="<?= $child_1['url'] ?>" class="load-to-content"><?= $child_1['menu'] ?></a></li>
                    <?php endforeach ?>

                </ul>
            <?php endif ?>

        <?php endforeach ?>
        <li>
            <a href="<?= base_url('logout') ?>">Logout</a>
        </li>
    </ul>
</div>
<hr>
<div id="content">