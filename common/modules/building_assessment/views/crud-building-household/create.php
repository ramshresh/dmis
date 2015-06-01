<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\building_assessment\models\BuildingHousehold */

$this->title = Yii::t('app', 'Create Building Household');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Building Households'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-household-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
