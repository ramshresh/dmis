<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/3/15
 * Time: 11:51 PM
 */

namespace common\modules\reporting\widgets;

use common\modules\reporting\models\Damage;
use common\modules\reporting\models\ItemType;
use common\modules\reporting\models\ReportItem;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\ActiveForm;

class MultipleDamages extends Widget{

    /** @var Impact Model of impact to manage */
    public $damage;
    /** @var Impact[] Model array of impacts to manage */
    public $damages;
    /** @var DisasterIncident Model of disasterincident to manage */
    public $parentReportItem;
    /** @var ControllerContext Context of parent controller of parent form  */
    public $parentControllerContext;
    /** @var FormContext Context of parent form */
    public $parentFormContext;
    public $dropDownItemName;

    /** @var ArrayObject htmlOptions for .?. */
    public $htmlOptions = array();

    public $tableId;

    /** @var String assets path to assets file */
    public $assets;

    public function init()
    {
        $this->dropDownItemName =  ArrayHelper::map(ItemType::find()
            ->where('type=:type',[':type'=>ReportItem::TYPE_DAMAGE])
            ->all(), 'item_name', 'item_name');
    }

    /** Render widget */
    public function run()
    {

        $this->instantiateClientScripts();
        if(isset($this->parentReportItem)){
            $this->render('multiple-damages/damagesForm',['model'=>$this->parentReportItem,'form'=>$this->parentFormContext,'this'=>$this->parentControllerContext]);
        }else{
            return $this->render('multiple-damages/damagesForm',['form'=>$this->parentFormContext,'this'=>$this->parentControllerContext]);
        }
    }

    public function instantiateClientScripts()
    {

        $opts = array(
            'parentControllerContext' => $this->parentControllerContext,
            'parentFormContext' => $this->parentFormContext,
            'damage' =>$this->damage,
            'damages' =>$this->damages,
            'parentReport' =>$this->parentReportItem,
        );

        $optsJs = Json::encode($opts);
//$cs->registerScript('multipleImpacts#'.$this->id,"$('#{$this->id}').multipleImpacts({$opts});");

        $script="var lastDamage = 0;
    var trDamage = new String(" .Json::encode($this->render('multiple-damages/_damageRow', ['id'=>'id_rep', 'model'=>new Damage(),'form'=>$this->parentFormContext,'dropDownItemName'=>$this->dropDownItemName,'reportItem'=>new ReportItem()])).
            ");
        console.log(JSON.stringify(trDamage));
        $.fn.fooo=function(){
	console.log(1);
	};
    $.fn.addDamage=function(button)
    {
    	console.log(button);
        lastDamage++;
        button.parents('table').children('tbody').append(trDamage.replace(/id_rep/g, 'new_row' + lastDamage));
    }
    $.fn.deleteDamage=function(button)
    {

        button.parents('tr').detach();
    }
";
        $this->getView()->registerJs($script,View::POS_READY);
    }

}
