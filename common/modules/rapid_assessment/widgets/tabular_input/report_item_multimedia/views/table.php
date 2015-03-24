<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/22/2015
 * Time: 8:05 AM
 */
$addRowId= $widgetId.'-addRow';
?>
<!--{{{ Tabular Input -->
<table class="tabular table-striped">
    <thead>
    <th class="col-lg-4">type</th>
    <th class="col-lg-4">
        <a id="<?=$addRowId?>" title="Add" href="#"><span class="glyphicon glyphicon-add">Add</span></a>
    </th>
    </thead>
    <?=
    \mdm\widgets\TabularInput::widget([
        'id' => $widgetId.'-detail-grid',
        'allModels' => $model->reportItemMultimedia,
        'modelClass' => \common\modules\rapid_assessment\models\ReportItemMultimedia::className(),
        'options' => ['tag' => 'tbody'],
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_tbody',
        'clientOptions' => [
            'btnAddSelector' => '#'.$addRowId,
        ]
    ])
    ?>
</table>
<!--{{{ ./Tabular Input -->