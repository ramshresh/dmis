<?php
/**
 * @var $this yii\web\View
 * @var $cs ClientScript
 * @var $opts Array
 * @var $id String
 * */

$htmlOptions = $opts['htmlOptions'];
$id = $htmlOptions['id'];

$btnReverseGeocodeId = $opts['btnReverseGeocodeId'];
?>
<?php \kartik\select2\Select2Asset::register($this);?>
<?php if(!isset($opts['externalInputId'])):?>
    <input type="hidden" class="placeautocomplete bigdrop" id="<?php echo $id;?>" style="width:600px" value="Panauti" />
<?php endif;?>
<!-- <button id = "<?php //echo $btnReverseGeocodeId ;?>" type="button" class="placeautocomplete reversegeocode">Reverse Geocode</button> -->

















