<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\SymbolIcon */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Symbol Icon',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Symbol Icons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symbol-icon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
