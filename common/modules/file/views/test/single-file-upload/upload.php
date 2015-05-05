<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/16/15
 * Time: 3:51 AM
 */

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\file\models\UploadFileSingleForm */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'UploadFileSingleForm',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'UploadFileSingleForm'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-file-single-upload">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
