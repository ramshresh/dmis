<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\Damage */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Damage',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Damages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="damage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'geometry'=>$geometry,
    ]) ?>

</div>
