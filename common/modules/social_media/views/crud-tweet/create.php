<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\social_media\models\Tweet */

$this->title = Yii::t('app', 'Create Tweet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tweets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tweet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
