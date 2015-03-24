<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/14/15
 * Time: 8:43 AM
 */
use yii\helpers\Html;

?>

<td class="col-lg-4">
    <?= Html::activeTextInput($model, "[$key]type", ['class'=>'form-control','required' => true]) ?>
</td>
<td class="col-lg-4">
    <?= Html::activeTextInput($model, "[$key]wkt", ['class'=>'form-control','required' => true]) ?>
</td>
<td  class="col-lg-4" style="text-align: center">
    <a data-action="delete" title="Delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
    <button id="triggerpointpicker-modalmap" type="button">Point Picker - Modal Map</button>
    <?php
    echo \common\modules\reporting\widgets\pointpicker\PointPickerWidget::widget(
        [
            //'latitudeId' => yii\helpers\Html::getInputId($model,'latitude'),
            //'longitudeId' => yii\helpers\Html::getInputId($model,'longitude'),
            //'wktId'=>yii\helpers\Html::getInputId($model,"[$key]wkt"),
            //'placenameId' => 'placename',
            //'openlayersPackName' => 'openlayers', //'openlayerslPack' //,
            'triggerId'=>'triggerpointpicker-modalmap',
            //'externalMapDivId'=>'map',
        ]);
    ?>
</td>
