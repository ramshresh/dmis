<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\social_media\models\TwitterStatus */

$this->title = Yii::t('app', 'Create Twitter Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Twitter Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="twitter-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
