<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
if (Yii::$app->controller->action->id === 'login' ) {
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} elseif (Yii::$app->controller->action->id === 'error' ){
    echo $this->render(
        'main-error',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    }

    //ramshresh\web\AdminLteAsset::register($this);
    ramshresh\assets\adminlte\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@bower/admin-lte/dist');

    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="skin-black-light sidebar-collapse">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset,]
        ) ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">

            <?= $this->render(
                'left.php',
                [
                    'directoryAsset' => $directoryAsset,
                ]
            )
            ?>
            <?= $this->render(
                'content.php',
                ['content' => $content, 'directoryAsset' => $directoryAsset,]
            ) ?>
            <!-- The Right Sidebar -->
            <aside class="control-sidebar control-sidebar-light">
                <!-- Content of the sidebar goes here -->
            </aside>
            <!-- The sidebar's background -->
            <!-- This div must placed right after the sidebar for it to work-->
            <div class="control-sidebar-bg"></div>

        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
