<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */
 \yii\web\JqueryAsset::register($this);
 \yii\bootstrap\BootstrapAsset::register($this);
\yii\bootstrap\BootstrapPluginAsset::register($this);
 \yii\jui\JuiAsset::register($this);
 \yii\web\YiiAsset::register($this);


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
<body>
<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
