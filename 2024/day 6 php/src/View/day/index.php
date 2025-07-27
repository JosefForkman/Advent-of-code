<?php
$fils = scandir('src/View/day/');
$fils = array_diff($fils, array('.', '..', 'index.php', 'index.html'));
?>
<ul>
    <?php
    foreach ($fils as $file) {
        $filePath = 'src/View/day/' . $file;
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        if (is_dir($filePath)) {
    ?>
            <li>
                <a href="/day/<?= $fileName ?>">Day <?= $fileName ?></a>
            </li>
        <?php
        } else {
        ?>
            <li>
                <a href="/day/<?= $fileName ?>">Day <?= $fileName ?></a>
            </li>
    <?php

        }
    }
    ?>
</ul>