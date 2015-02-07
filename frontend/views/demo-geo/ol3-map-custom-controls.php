<?php
/**
 * @var $this yii\web\View
 */
\common\assets\Ol3Asset::register($this,$this::POS_END);
?>
 <style type="text/css">
      .rotate-north {
        position: absolute;
        top: 65px;
        left: 8px;
        background: rgba(255,255,255,0.4);
        border-radius: 4px;
        padding: 2px;
      }
      .ol-touch .rotate-north {
        top: 80px;
      }
      .rotate-north a {
        display: block;
        color: white;
        font-size: 16px;
        font-family: 'Lucida Grande',Verdana,Geneva,Lucida,Arial,Helvetica,sans-serif;
        font-weight: bold;
        margin: 1px;
        text-decoration: none;
        text-align: center;
        border-radius: 2px;
        height: 22px;
        width: 22px;
        background: rgba(0,60,136,0.5);
      }
      .ol-touch .rotate-north a {
        font-size: 20px;
        height: 30px;
        width: 30px;
        line-height: 26px;
      }
      .rotate-north a:hover {
        background: rgba(0,60,136,0.7);
      }
    </style>
<div id="map" class="map"></div>
<?php
$js = <<<JS
	(function($){
		window.app = {};
		var app = window.app;
		app.RotateNorthControl = function(opt_options) {
		
			var options = opt_options || {};

			var anchor = document.createElement('a');
			anchor.href = '#rotate-north';
			anchor.innerHTML = 'N';

			var this_ = this;
			var handleRotateNorth = function(e) {
				// prevent #rotate-north anchor from getting appended to the url
				e.preventDefault();
				this_.getMap().getView().setRotation(0);
			};

			anchor.addEventListener('click', handleRotateNorth, false);
			anchor.addEventListener('touchstart', handleRotateNorth, false);

			var element = document.createElement('div');
			element.className = 'rotate-north ol-unselectable';
			element.appendChild(anchor);

			ol.control.Control.call(this, {
				element: element,
				target: options.target
			});
		};
		ol.inherits(app.RotateNorthControl, ol.control.Control);
	
		//
		// Create map, giving it a rotate to north control.
		//
		var map = new ol.Map({
			controls: ol.control.defaults({
					attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
					collapsible: false
				})
			}).extend([
				new app.RotateNorthControl()
			]),
			layers: [
					new ol.layer.Tile({
						source: new ol.source.OSM()
					})
				],
			target: 'map',
			view: new ol.View({
				center: [0, 0],
				zoom: 2,
				rotation: 1
			})
		});
	})(jQuery);
JS;
$this->registerJs($js,$this::POS_READY);
?>
