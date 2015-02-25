<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/6/15
 * Time: 12:57 AM
 */

/**
 * @var $this yii\web\View
 */
\common\assets\Ol3Asset::register($this,$this::POS_END);
\frontend\assets\DemoGeo_Ol3MapSimpleAsset::register($this,$this::POS_READY);
?>
<div id="map" class="map"></div>
<button id = 'btn-report-item-create' type="button">report</button>
<?php echo \common\modules\reporting\widgets\reportitem\Create::widget(
    [
        'mapDivId'=>'map',
        'containerId'=>'custom-id',
        'model'=>new \common\modules\reporting\models\Event(),
        'urlToCreateAction'=> \yii\helpers\Url::toRoute('event-create'),
        'jqToggleBtnSelector'=>'btn-report-item-create',
    ]
)?>


