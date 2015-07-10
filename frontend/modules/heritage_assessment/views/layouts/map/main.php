<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 */
use common\assets\icons\ionicons\IonIconsAsset;
use frontend\assets\AppAsset;
use yii\helpers\Html;

//use frontend\assets\SubashAsset;

if (Yii::$app->controller->action->id === 'login') {
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
}elseif (Yii::$app->controller->action->id === 'error') {
    echo $this->render(
        'main-error',
        ['content' => $content]
    );
}else {

    if (class_exists('frontend\assets\AppAsset')) {
        frontend\assets\AppAsset::register($this);
    }
//    SlimScrollAsset::register($this);
    //  FastClickAsset::register($this);
    IonIconsAsset::register($this);
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
        <style>
            .content{
                background-color: beige;
            }



        </style>
        <?php $this->head() ?>
    </head>
    <body class="skin-green-light sidebar-collapse">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <!--   Main Header Navbar    -->
        <?= $this->render(
            'header.php',
            ['directoryAdminLteAsset' => $directoryAdminLteAsset,]
        ) ?>
        <!--   Main Side Bar     -->
        <?= $this->render(
            'left.php',
            [
                'directoryAdminLteAsset' => $directoryAdminLteAsset,
            ]
        )
        ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<!--            <section class="content-header">-->
<!--                Content Header Here! With Breadcrumbs-->
<!--            </section>-->
            <!-- Main content -->
            <section class="content">
                <?= $content ?>
            </section>
        </div>
        <!--   Main Footer     -->
        <?= $this->render(
            'footer.php',
            [
                'directoryAdminLteAsset' => $directoryAdminLteAsset,
            ]
        )
        ?>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>