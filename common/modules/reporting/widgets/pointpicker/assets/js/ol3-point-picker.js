var geom;
       
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

var DOMElement2HtmlMarkup = function(element){
	 if(element instanceof Element){
		 var wrap = document.createElement('div');
		wrap.appendChild(element.cloneNode(true));
		return wrap.innerHTML;
	}
};



(function($,ol){
    /**
     * Created by girc on 2/8/15.
     */
    /**
     * Define a namespace for the application.
     */
    window.app = {};
    var app = window.app;

//
// Define rotate to north control.
//
    /**
     * @constructor
     * @extends {ol.control.Control}
     * @param {Object=} opt_options Control options.
     */
    app.PointPickerControl = function(opt_options) {
        var self = this;
        var options = opt_options || {};
        self.containerId=options.containerId||"ol3_pp_container";

		self.container = document.createElement('div');
        self.container.id=self.containerId;
        self.container.className = 'ol-pointpicker absolute hidden ol-overlaycontainer-stopevent ';
        //self.container.setAttribute('style','margin:1%;');
		ol.control.Control.call(self, {
			element: self.container,
			target: options.target
		});
        
    };
    
    ol.inherits(app.PointPickerControl, ol.control.Control);

    
     /**
     * returns the UI container
     * @param template
     * @param templateData
     * @returns DOM element object
     */
    app.PointPickerControl.prototype.addUIContent = function(){
        var self=this;
                
        uiAddress = document.createElement('input');
        uiAddress.placeholder = 'Address';
        uiAddress.className = 'ol-pointpicker-address';
        uiAddress.setAttribute('style','width:100%');
        self.uiAddress=uiAddress;
        
        uiLat = document.createElement('input');
        uiLat.placeholder = 'Latitude';
        uiLat.className = 'ol-pointpicker-latitude'; 
        uiLat.setAttribute('style','width:100%');
        self.uiLat=uiLat;
        
        uiLon = document.createElement('input');
        uiLon.placeholder = 'Longitude';
        uiLon.className = 'ol-pointpicker-longitude'; 
        uiLon.setAttribute('style','width:100%');
        self.uiLon = uiLon;
        
        uiGeom = document.createElement('input');
        uiGeom.placeholder = 'Geom';
        uiGeom.setAttribute('value','value1');
        uiGeom.className = 'ol-pointpicker-geom'; 
        uiGeom.setAttribute('style','width:100%');
        self.uiGeom = uiGeom;
        
        geom=self.uiGeom;
        
        uiBtnOk = document.createElement('button');
        uiBtnOk.type = 'button';
        uiBtnOk.innerHTML = 'OK';
        uiBtnOk.className = 'ol-pointpicker-ok'; 
        self.uiBtnOk = uiBtnOk;
        
        uiCloser = document.createElement('a');
        uiCloser.href = '#';
        uiCloser.className = 'ol-pointpicker-closer'; 
        self.uiCloser = uiCloser;

        var template='<div class="col-sm-12">'+
						'<div class="row">'+
							'<div class="col-sm-12">'+
								'{{{address}}}'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-sm-6">'+
								'{{{latitude}}}'+
							'</div>'+
							'<div class="col-sm-6">'+
								'{{{longitude}}}'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-sm-12">'+
								'{{{geom}}}'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-sm-12">'+
								'{{{btnOk}}}'+
							'</div>'+
						'</div>'+
					'</div>';
        
       template+= '<div>'+
					'<label>Interaction type:  &nbsp;</label>'+
					'<label>draw</label>'+
					'<input type="radio" id="interaction_type_draw" name="interaction_type" value="draw" checked>'+
					'<label>modify</label>'+
					'<input type="radio" id="interaction_type_modify" name="interaction_type" value="modify">'+
					'</div>'+
					 '<div>'+
					'<label>Geometry type</label>'+
					'<select id="geom_type">'+
						'<option value="Point" selected>Point</option>'+
						'<option value="LineString">LineString</option>'+
						'<option value="Polygon">Polygon</option>'+
					'</select>'+
				'</div>'+
				'<div>'+
					'<label>Data type</label>'+
					'<select id="data_type">'+
						'<option value="WKT" selected>WKT</option>'+
						'<option value="GeoJSON" >GeoJSON</option>'+
						'<option value="KML">KML</option>'+
						'<option value="GPX">GPX</option>'+
					'</select>'+
				'</div>'+
				'<div id="delete" style="text-decoration:underline;cursor:pointer">'+
					'Delete all features'+
				'</div>'
				'<label>Data:</label>';


        var templateData = {
				address:DOMElement2HtmlMarkup(self.uiAddress),
				latitude:DOMElement2HtmlMarkup(self.uiLat),
				longitude:DOMElement2HtmlMarkup(self.uiLon),
				geom:DOMElement2HtmlMarkup(self.uiGeom),
				btnOk:DOMElement2HtmlMarkup(self.uiBtnOk)
			};
        
        var htmlMarkupUi = Mustache.to_html(template, templateData);
        self.container.innerHTML= htmlMarkupUi;
       
    };
    /**
     * sets event handlers necessary for ui elements
     */
    app.PointPickerControl.prototype.setUIEventHandlers = function(){
		var self=this;	
		self.uiBtnOk.addEventListener('click',function(e){
			console.log('button ok touchstart!');
		});
		self.uiBtnOk.addEventListener('click',function(e){
			console.log('button ok clicked');
		});
		$('#'+self.containerId+' .ol-pointpicker-ok').on('click',function(e){
			console.log('button ok clicked');
		});
		self.uiBtnOk.addEventListener('touchstart',function(e){
			console.log('button ok touchstart!');
		});
		self.uiCloser.addEventListener('click',function(e){
			console.log('closer clicked!');
            self.container.style.display = 'none';
            self.ppCloser.blur();
            e.preventDefault();
		});
    }
    
    /**
     * Initialize widget
     */
    app.PointPickerControl.prototype.init = function(){
		self=this;
		map=self.getMap();
		mapId=map.getTarget();
		//Prepare UI Elements
		self.addUIContent();
		self.setUIEventHandlers();
		
		self.container.className =self.container.className.replace(/\bhidden\b/,'');
			
		//If jquery Modal
	
		self.container.className =self.container.className.replace(/\babsolute\b/,'');
		$('#'+this.containerId).dialog({
			title:'Point Picker'
			});
		$('#ol3_pp_container_1').parent('div.ui-dialog').detach().appendTo('div#'+mapId+' .ol-viewport .ol-overlaycontainer-stopevent');	 
		 
		
		//
		
		
		
		self.initGeometryPicker();
	
	}
	
	app.PointPickerControl.prototype.initGeometryPicker=function(){
		map=self.getMap();
		// create a vector layer used for editing
		var vector_layer = new ol.layer.Vector({
			name: 'my_vectorlayer',
			source: new ol.source.Vector(),
			style: new ol.style.Style({
				fill: new ol.style.Fill({
					color: 'rgba(255, 255, 255, 0.2)'
				}),
				stroke: new ol.style.Stroke({
					color: '#ffcc33',
					width: 2
				}),
				image: new ol.style.Circle({
					radius: 7,
					fill: new ol.style.Fill({
						color: '#ffcc33'
					})
				})
			})
		});
	
	
	map.addLayer(vector_layer);
		// make interactions global so they can later be removed
	var select_interaction,
		draw_interaction,
		modify_interaction;

	// get the interaction type
	var $interaction_type = $('[name="interaction_type"]');
	// rebuild interaction when changed
	$interaction_type.on('click', function(e) {
		// add new interaction
		if (this.value === 'draw') {
			addDrawInteraction();
		} else {
			addModifyInteraction();
		}
	});

	// get geometry type
	var $geom_type = $('#geom_type');
	// rebuild interaction when the geometry type is changed
	$geom_type.on('change', function(e) {
		map.removeInteraction(draw_interaction);
		addDrawInteraction();
	});

	// get data type to save in
	$data_type = $('#data_type');
	// clear map and rebuild interaction when changed
	$data_type.onchange = function() {
		clearMap();
		map.removeInteraction(draw_interaction);
		addDrawInteraction();
	};

	// build up modify interaction
	// needs a select and a modify interaction working together
	function addModifyInteraction() {
		// remove draw interaction
		map.removeInteraction(draw_interaction);
		// create select interaction
		select_interaction = new ol.interaction.Select({
			// make sure only the desired layer can be selected
			layers: function(vector_layer) {
				return vector_layer.get('name') === 'my_vectorlayer';
			}
		});
		map.addInteraction(select_interaction);

		// grab the features from the select interaction to use in the modify interaction
		var selected_features = select_interaction.getFeatures();
		// when a feature is selected...
		selected_features.on('add', function(event) {
			// grab the feature
			var feature = event.element;
			// ...listen for changes and save them
			feature.on('change', saveData);
			// listen to pressing of delete key, then delete selected features
			$(document).on('keyup', function(event) {
				if (event.keyCode == 46) {
					// remove all selected features from select_interaction and my_vectorlayer
					selected_features.forEach(function(selected_feature) {
						var selected_feature_id = selected_feature.getId();
						// remove from select_interaction
						selected_features.remove(selected_feature);
						// features aus vectorlayer entfernen
						var vectorlayer_features = vector_layer.getSource().getFeatures();
						vectorlayer_features.forEach(function(source_feature) {
							var source_feature_id = source_feature.getId();
							if (source_feature_id === selected_feature_id) {
								// remove from my_vectorlayer
								vector_layer.getSource().removeFeature(source_feature);
								// save the changed data
								saveData();
							}
						});
					});
					// remove listener
					$(document).off('keyup');
				}
			});
		});
		// create the modify interaction
		modify_interaction = new ol.interaction.Modify({
			features: selected_features,
			// delete vertices by pressing the SHIFT key
			deleteCondition: function(event) {
				return ol.events.condition.shiftKeyOnly(event) &&
					ol.events.condition.singleClick(event);
			}
		});
		// add it to the map
		map.addInteraction(modify_interaction);
	}

	// creates a draw interaction
	function addDrawInteraction() {
		// remove other interactions
		map.removeInteraction(select_interaction);
		map.removeInteraction(modify_interaction);

		// create the interaction
		draw_interaction = new ol.interaction.Draw({
			source: vector_layer.getSource(),
			type: /** @type {ol.geom.GeometryType} */ ($geom_type.val())
		});
		// add it to the map
		map.addInteraction(draw_interaction);

		// when a new feature has been drawn...
		draw_interaction.on('drawend', function(event) {
			// create a unique id
			// it is later needed to delete features
			var id = uid();
			// give the feature this id
			event.feature.setId(id);
			// save the changed data
			saveData();
		});
	}

	// add the draw interaction when the page is first shown
	addDrawInteraction();

	// shows data in textarea
	// replace this function by what you need
	function saveData() {
		// get the format the user has chosen
		var data_type = $data_type.val(),
		// define a format the data shall be converted to
			format = new ol.format[data_type](),
		// this will be the data in the chosen format
			data;
		try {
			// convert the data of the vector_layer into the chosen format
			data = format.writeFeatures(vector_layer.getSource().getFeatures());
		} catch (e) {
			// at time of creation there is an error in the GPX format (18.7.2014)
			$('.ol-pointpicker-geom')[0].val(e.name + ": " + e.message);
			return;
		}
		if ($data_type.val() === 'GeoJSON') {
			// format is JSON
			$('.ol-pointpicker-geom').val(JSON.stringify(data, null, 4));
		}else if($data_type.val() === 'WKT'){
			$('.ol-pointpicker-geom').val(data);
			} else {
			// format is XML (GPX or KML)
			var serializer = new XMLSerializer();
			$('.ol-pointpicker-geom').val(serializer.serializeToString(data));
		}
	}

	// clear map when user clicks on 'Delete all features'
	$("#delete").click(function() {
		clearMap();
	});

	// clears the map and the output of the data
	function clearMap() {
		vector_layer.getSource().clear();
		if (select_interaction) {
			select_interaction.getFeatures().clear();
		}
		$('#data').val('');
	}

	// creates unique id's
	function uid(){
		var id = 0;
		return function() {
			if (arguments[0] === 0) {
				id = 0;
			}
			return id++;
		}
	}
	
	}	
	
})(jQuery,ol);
