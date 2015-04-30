<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\file_management\models\TempUploadedFile */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Temp Uploaded File',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Temp Uploaded Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="temp-uploaded-file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
