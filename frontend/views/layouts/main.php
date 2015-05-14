<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 */
use frontend\assets\AppAsset;
use frontend\assets\SubashAsset;
use ramshresh\assets\adminlte\web\AdminLteAsset;
use yii\helpers\Html;
use yii\helpers\Url;

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

    if (class_exists('frontend\assets\AppAsset')) {
        frontend\assets\AppAsset::register($this);
    }

    $directoryAdminLteAsset = ramshresh\assets\adminlte\web\AdminLteAsset::register($this)->baseUrl;

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
    <body class="skin-black-light">
    <?php $this->beginBody() ?>

    <div class="wrapper">
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
    </div>




    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
<?php } ?>