<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/12/2015
 * Time: 2:28 PM
 */
/* @var $models common\modules\reporting\models\Event[]*/
/* @var $widgetId*/
?>
<!--{{{ Tabular Input -->
<table class="tabular table-striped">
    <thead>
    <th class="col-lg-4">item_name</th>
    <th class="col-lg-4">subtype_name</th>
    <th class="col-lg-4">
        <a id="add-tabular-input-row-event" title="Add" href="#"><span class="glyphicon glyphicon-add">Add</span></a>
    </th>
    </thead>
    <?=
    \mdm\widgets\TabularInput::widget([
        'id' => 'tabular-input-grid-event',
        'allModels' => $models,
        'modelClass' => \common\modules\reporting\models\Event::className(),
        'options' => ['tag' => 'tbody'],
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_tabular-input-item-view',
        'clientOptions' => [
            'btnAddSelector' => '#add-tabular-input-row-event',
        ]
    ])
    ?>
</table>
<!--{{{ ./Tabular Input -->