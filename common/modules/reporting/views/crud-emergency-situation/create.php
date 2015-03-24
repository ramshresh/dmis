<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\EmergencySituation */

$this->title = 'Create Emergency Situation';
$this->params['breadcrumbs'][] = ['label' => 'Emergency Situations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emergency-situation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
