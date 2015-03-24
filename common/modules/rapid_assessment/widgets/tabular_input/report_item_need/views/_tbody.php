<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/22/2015
 * Time: 8:07 AM
 */
use yii\helpers\Html;

?>


<td class="col-lg-4">
    <?= Html::activeTextInput($model, "[$key]item_name", ['class'=>'form-control','required' => true]) ?>
</td>
<td class="col-lg-4">
    <?= Html::activeTextInput($model, "[$key]magnitude", ['class'=>'form-control','required' => true]) ?>
</td>
<td class="col-lg-4">
    <?= Html::activeTextInput($model, "[$key]units", ['class'=>'form-control','required' => true]) ?>
</td>
<td  class="col-lg-4" style="text-align: center">
    <a data-action="delete" title="Delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
</td>
