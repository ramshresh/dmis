<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/5/15
 * Time: 2:12 AM
 */
?>
    <input id="latitude" type="text" placeholder="latitude">
    <input id="longitude" type="text" placeholder="longitude">
    <input id="placename" type="text" placeholder="placename">
    <input id="extplacename" type="text" placeholder="placename">
<?= \common\modules\reporting\widgets\placeautocomplete\PlaceAutocompleteWidget::widget(
    [
        'latitudeId' => 'latitude',
        'longitudeId' => 'longitude',
        'placenameId' => 'placename',
        'externalInputId'=>'extplacename',
    ]

)?>