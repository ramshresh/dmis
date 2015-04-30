<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\file_management\models\TempUploadedFile */

$this->title = Yii::t('app', 'Create Temp Uploaded File');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Temp Uploaded Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temp-uploaded-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
