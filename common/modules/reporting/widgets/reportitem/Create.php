<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/24/2015
 * Time: 12:18 PM
 */

namespace common\modules\reporting\widgets\reportitem;


use yii\base\Widget;
use yii\helpers\Json;
use yii\web\View;

class Create extends Widget
{
    public $urlToCreateAction;
    public $modelReportItem;
    public  $mapDivId;
    public  $model;
    public $containerId;
    public $clientOptions;
    public $jqToggleBtnSelector;
    public function  init()
    {
        $this->instantiateClientScripts();
        $this->containerId=($this->containerId)?$this->containerId:'form-container-'.$this->id;
    }

    public function run()
    {
        //$this->model = new Event();
        $renderedForm =$this->render('_form',['model'=>$this->model,'urlToCreateAction'=>$this->urlToCreateAction]);
        $this->clientOptions['containerId']=$this->containerId;
        $this->clientOptions['htmlMarkup']=$renderedForm;
        $this->clientOptions['mapDivId']=$this->mapDivId;
        $this->clientOptions['jqToggleBtnSelector']=$this->jqToggleBtnSelector;


        $opts=Json::encode($this->clientOptions);

        $this->getView()->registerJs("var c=new app.FormContainer($opts);$('#map').data('map').addControl(c);",View::POS_READY);
    }

    public function instantiateClientScripts()
    {
        WidgetReportItemCreateAsset::register($this->getView());
        $jsUtilities = <<<JS
             /**
             * Utility Functions
             * How to use??:
                    var markup = '<div><p>text here</p></div>';
                    var el = str2DOMElement(markup);
             */
             var str2DOMElement = function(html) {
                var frame = document.createElement('iframe');
                frame.style.display = 'none';
                document.body.appendChild(frame);
                frame.contentDocument.open();
                frame.contentDocument.write(html);
                frame.contentDocument.close();
                var el = frame.contentDocument.body.children;
                document.body.removeChild(frame);
                return el;
            };
JS;
        $csFormContainer=<<<CSS
.ui-widget-content {
background:none;
  background-color:rgba(255, 255, 255, 0.4);
  border:1px solid #393456;
  color:#222222;
}

.ol-formcontainer{
    background: rgba(255,255,255,0.8);
    border:solid;
    border-color:rgba(255,255,255,0.7);
    border-radius: 4px;
    padding: 5px;
}

.ol-formcontainer.absolute{
	position: absolute;
    top: 65px;
    left: 200px;
}
.ol-formcontainer.hidden{
	display:none;
}
.ol-formcontainer button {
    display: block;
    color: white;
    font-family: sans-serif;
    font-size: small;
    margin: 1px;
    text-decoration: none;
    text-align: center;
    border-radius: 2px;
    background: rgba(0,60,136,0.5);
}
.ol-formcontainer button {
    font-size: small;
}

.ol-formcontainer button:hover {
    background: rgba(0,60,136,0.7);
}
.ol-formcontainer-closer {
    position: absolute;
    top: 0px;
    right: 0px;
    font-size: 150%;
    padding: 0 4px;
    color: gray;
    text-decoration: none;
}
.ol-formcontainer-closer:after {
    content: "✖";
}
.datetimepicker,.select2-drop,.select2-drop-mask{
z-index: 9000000000 !important;
}
CSS;
$this->getView()->registerCss($csFormContainer);
        $jsFormContainer = <<<JS
                 window.app = {};
                 var app = window.app;
                    app.FormContainer = function(opt_options){
                        var self = this;
                        var options = opt_options || {};
                        self.containerId = options.containerId || 'form-container-id';
                        self.htmlMarkup = options.htmlMarkup;
                        self.mapDivId = options.mapDivId;
                        self.jqToggleBtnSelector = options.jqToggleBtnSelector;
                        self.container = document.createElement('div');
                        self.container.setAttribute('id',options.containerId);
                        self.container.className = 'ol-formcontainer absolute hidden  ol-overlaycontainer-stopevent ';


                        self.container.innerHTML = self.htmlMarkup;
                        btnToggle = document.getElementById(self.jqToggleBtnSelector);
                        console.log(self.jqToggleBtnSelector);
                        if(btnToggle){
                            btnToggle.addEventListener('click',function(e){
                            self.init();
                            });
                        }

                        ol.control.Control.call(self, {
                            element: self.container,
                            target: options.target
                         });
                    };
     ol.inherits(app.FormContainer, ol.control.Control);
     app.FormContainer.prototype.appendHTMLContent = function(htmlMarkup){
       var self=this;
        self.container.innerHTML = htmlMarkup;
     };
     app.FormContainer.prototype.init=function(){
     var self=this;
        self.container.className =self.container.className.replace(/\bhidden\b/,'');
		//If jquery Modal
		self.container.className =self.container.className.replace(/\babsolute\b/,'');
		$('#'+this.containerId).dialog({
			title:'Report Event'
			});
		$('#'+self.containerId).parent('div.ui-dialog').detach().appendTo('div#'+self.mapDivId+' .ol-viewport .ol-overlaycontainer-stopevent');
     }
JS;
        $this->getView()->registerJs($jsFormContainer, View::POS_END);
    }
}