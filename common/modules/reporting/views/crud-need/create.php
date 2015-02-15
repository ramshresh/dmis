<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\Need */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Need',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Needs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="need-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
