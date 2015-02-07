<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/5/15
 * Time: 12:59 AM
 */

namespace common\modules\reporting\widgets\placeautocomplete;


use yii\bootstrap\Widget;
use yii\helpers\Json;
use yii\web\View;

class PlaceAutocompleteWidget extends Widget{
    public $latitudeId,$longitudeId,$placenameId,$assets,$externalInputId;
    private $inputId,$btnReverseGeocodeId;

    public $htmlOptions = array();

    public function init()
    {
        //$this->assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets');
        PlaceAutocompleteAsset::register($this->getView(),View::POS_END);
    }
    /** Render widget */
    public function run()
    {
        $this->inputId = (isset($this->externalInputId))? $this->externalInputId:$this->id+'-placeinput';
        $this->btnReverseGeocodeId = $this->id.'-btn-reversegeocode';
        $this->htmlOptions['id'] = $this->inputId;
        $this->htmlOptions['class'] = 'bigdrop';

        $opts = array(
            'latitudeId' => (isset($this->latitudeId))? $this->latitudeId:'latitude',
            'longitudeId' => (isset($this->longitudeId))? $this->longitudeId:'longitude',
            'placenameId' => (isset($this->placenameId))? $this->placenameId:'placenameId',
            'btnReverseGeocodeId'=>$this->btnReverseGeocodeId,
            'inputId'=>(isset($this->inputId))? $this->inputId:$this->id,
            'htmlOptions'=>$this->htmlOptions,
            'externalInputId'=>$this->externalInputId,
        );
        $options = Json::encode($opts);

        $this->getView()->registerJs("$('#{$this->inputId}').placeAutocomplete({$options});",\yii\web\View::POS_READY);

        return $this->render('placeautocomplete1',array('opts'=>$opts));
    }

}