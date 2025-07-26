<?php
$fils = scandir('src/View/day/');
$fils = array_diff($fils, array('.', '..', 'index.php', 'index.html'));
?>
<ul>
    <?php
    foreach ($fils as $file) {
        $filePath = 'src/View/day/' . $file;
        if (is_dir($filePath)) {
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            print_r($filePath);
    ?>
            <li>
                <a href="/day/<?= $fileName ?>/index.php">Day <?= $fileName ?></a>
            </li>
    <?php
        }
    }
    ?>
</ul>