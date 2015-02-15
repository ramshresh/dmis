<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/5/15
 * Time: 12:59 AM
 */

namespace common\modules\reporting\widgets\pointpicker;


use common\assets\Ol2Asset;
use yii\bootstrap\Widget;
use yii\helpers\Json;
use yii\web\View;

class PointPickerWidget extends Widget{
    /** @var Point Model of point to manage */
    public $point;
    /** @var string Route to point controller */
    public $controllerRoute = false;
    public $assets;
    public $openlayersPackName;//='openlayersPack';// for $openlayersPackUrl=Yii::app()->clientScript->getPackageBaseUrl($openlayersPackName);
    public $openlayersPackUrl;
    public $latitudeId,$longitudeId,$placenameId;
    public $widgetDivId,$mapDivId,$iLatId,$iLonId,$iPlacenameId,$iWktFieldId; // needed for html markup of view
    public $openlayersImgPath;
    public $markerUrl;
    public $triggerId;
    public $externalMapDivId;
    public $wktFieldId;

    public function init()
    {

            if(!isset($this->externalMapDivId)){ // Register OpenLayers only if external map is not provided
                $ol2Asset=Ol2Asset::register($this->getView());
                $this->openlayersPackUrl=$ol2Asset->baseUrl;
            }


        PointPickerAsset::register($this->getView());
    }


    public $htmlOptions = array();


    /** Render widget */
    public function run()
    {
        $this->widgetDivId =$this->id;
        $this->iLatId=$this->widgetDivId.'-lat';
        $this->iLonId=$this->widgetDivId.'-lon';
        $this->iPlacenameId=$this->widgetDivId.'-placename';
        $this->iWktFieldId=$this->widgetDivId.'wkt';
        $this->mapDivId =$this->id.'-map';
        $triggerId=(isset($this->triggerId))?$this->triggerId:$this->id.'btn-trigger';

        $opts = array(
            'latitudeId' => (isset($this->latitudeId))? $this->latitudeId:'latitude',
            'longitudeId' => (isset($this->longitudeId))? $this->longitudeId:'longitude',
            'placenameId' => (isset($this->placenameId))? $this->placenameId:'placenameId',
            'openlayersPackUrl'=>$this->openlayersPackUrl,
            'openlayersImgPath'=>(isset($this->openlayersImgPath))? $this->markerUrl:$this->openlayersPackUrl.'/img/',
            'markerUrl'=>(isset($this->markerUrl))? $this->markerUrl:$this->openlayersPackUrl.'/img/marker.png',
            'widgetDivId'=>$this->widgetDivId,
            'iLatId'=>$this->iLatId,
            'iLonId'=>$this->iLonId,
            'iPlacenameId'=>$this->iPlacenameId,
            'iWktFieldId'=>$this->iWktFieldId,
            'mapDivId'=>$this->mapDivId,
            'triggerId'=>$triggerId,
            'externalMapDivId'=>$this->externalMapDivId,
            'wktFieldId'=>$this->wktFieldId,

        );

        $options = Json::encode($opts);
        $this->getView()->registerJs("$('#{$this->id}').pointPicker({$options});$('#pointpickerModal').draggable({handle: '.modal-header'});$('.modal').resizable();",View::POS_READY);

        $this->htmlOptions['id'] = $this->id;
        $this->htmlOptions['class'] = 'pointpicker';


        return $this->render('pointpicker',array('opts'=>$opts));
    }
}