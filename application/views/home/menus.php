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
        <?php foreach ($modules as $module) : ?>

            <li><a href="<?= $module['url'] ?>"><?= $module['module'] ?></a></li>

            <?php if (!empty($module['childs'])) : ?>
                <ul>

                    <?php foreach ($module['childs'] as $child_1) : ?>
                        <li><a href="<?= $child_1['url'] ?>"><?= $child_1['module'] ?></a></li>
                    <?php endforeach ?>

                </ul>
            <?php endif ?>

        <?php endforeach ?>
    </ul>
</div>
<hr>