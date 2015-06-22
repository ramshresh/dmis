<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/22/2015
 * Time: 10:18 AM
 */
?>
<?= $this->render(
    'header.php',
    ['directoryAdminLteAsset' => $directoryAdminLteAsset,]
) ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <?= $this->render(
        'left.php',
        [
            'directoryAdminLteAsset' => $directoryAdminLteAsset,
        ]
    )
    ?>
    <?= $this->render(
        'content.php',
        ['content' => $content, 'directoryAdminLteAsset' => $directoryAdminLteAsset,]
    ) ?>
</div>