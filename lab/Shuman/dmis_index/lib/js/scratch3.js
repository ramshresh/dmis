OpenLayers.ProxyHost = "/cgi-bin/proxy.cgi?url=";
	
 /* //Filtering : Rules:spatial:BBOX

		 var bbox=new OpenLayers.Filter.Spatial(
			type:OpenLayers.Filter.Spatial.BBOX,
			value:new OpenLayers.Bounds(),
			projection:new OpenLayers.Projection('EPSG:4326')
		); */

//___________________Simple style_________________________________

    var simple_style= new OpenLayers.StyleMap({
      'default': new OpenLayers.Style({
          strokeColor: "#000000",
               strokeOpacity: 1,
               strokeWidth: 2,
               fillColor: "#00FF00",
               fillOpacity: 0.6
        })
		});
  
  //_________________________________styling cluster strategy__________________________________________
  
		var cluster_style= new OpenLayers.StyleMap({
            'default': new OpenLayers.Style({
                strokeWidth: '${strokeFunction}',
                strokeOpacity: 1,
                strokeColor: "#99CC55",
                fillColor: "#ff0011",
                fillOpacity: 0.5,
                pointRadius: '${point_radius}',
                label: "${feature_label}",
                fontColor: "#ffffff"
            }, {
                context: {
                    strokeFunction: function(feature) {
                        var count = feature.attributes.count;
                        var stk = Math.max(0.1 * count, 1);
                        return stk;
                    },
                    feature_label: function(feature) {
						var count=feature.attributes.count;
                        if(count>1){
							return feature.attributes.count;
						}
						else{
							return labe='';
						}
					
                    },
				//	num_points: function(feature){ return feature.attributes.count; },
					
					point_radius: function(feature){
                        return 9 + (feature.attributes.count)
                    }
                }
            })
        });

	 
	//____________styling for feature according to category type_______________________________________________________
	     var vector_style_map = new OpenLayers.StyleMap();
	 
	    var symbolizers_lookup ={
            'rb': {
                'pointRadius':20, 'externalGraphic': './img/injury.png','graphicZIndex': '${zIndex}','fillOpacity':1
             },
            'trapped': {
                'fillColor': '#FFFA93', 'fillOpacity':.8, 'pointRadius':8, 'strokeColor': '#AFAB57', 'strokeWidth':4
            },
            'death': {
                'fillColor': '#aaee77', 'fillOpacity':.8, 'pointRadius':8, 'strokeColor': '#669933', 'strokeWidth':5
            },
            'injury': {
                'fillColor': '#BD1922','fillOpacity':.8,  'pointRadius':8, 'strokeColor': '#812B30', 'strokeWidth':6
            },
            'fire': {
                'fillColor': '#336699','fillOpacity':.8,  'pointRadius':8, 'strokeColor': '#003366', 'strokeWidth':2
            }
        }
        
		 //Now, call addUniqueValueRules and pass in the symbolizer lookups
        vector_style_map.addUniqueValueRules('default', 'category', symbolizers_lookup);

       
        //Add the style map to the vector layer
     //   hazard.styleMap = vector_style_map;
 	
		  
//___________________________main map_______________________________________________________________________________________________
	function init(){
		 map = new OpenLayers.Map("map", {
                projection: new OpenLayers.Projection("EPSG:900913"),
				displayProjection: new OpenLayers.Projection("EPSG:4326"),
				numZoomLevels:20,
				controls: [
                        new OpenLayers.Control.Navigation(),
                        new OpenLayers.Control.PanZoomBar(),
                        new OpenLayers.Control.Permalink(),
                        new OpenLayers.Control.ScaleLine(),
                        new OpenLayers.Control.MousePosition()
                       
                    //    new OpenLayers.Control.OverviewMap()
                      
                    ]

        });
//__________________________ base layers_________________________________________________________________________________________________
	
	

	var gmap = new OpenLayers.Layer.Google("Google", {sphericalMercator:true});
	// Bing's Road imagerySet
	var road = new OpenLayers.Layer.Bing({
		key: "Av50ZzQGTuB3eHWfhm0mtUM_RbwRhjSeHiT15hJJ4FhwjLCDkxviY_jzHqh9KfLv ",
		type: "Road"
	});
		
	var osm = new OpenLayers.Layer.OSM("Openstreet map");
            map.addLayers([gmap,osm,road]);
			

	
		
//__________________________wfs layer as overlay with markers point on wfs feature________________________
		
		var hazard = new OpenLayers.Layer.Vector(
            "hazard",
            {
                strategies: [new OpenLayers.Strategy.BBOX(),
							new OpenLayers.Strategy.Cluster({distance:50})
			],
                 projection: new OpenLayers.Projection("EPSG:4326"),
                 protocol: new OpenLayers.Protocol.WFS({
                   version: "1.1.0",
           url: "http://localhost:8080/geoserver/wfs",
           featurePrefix: "disaster", //geoserver worspace name
           featureType: "hazard", //geoserver Layer Name
           featureNS: "http://reportdisaster.com", // Edit Workspace Namespace URI
           geometryName: "geometry" // field in Feature Type details with type "Geometry"
		//	srsName: "EPSG:4326"
                })
				  ,
        //            styleMap:cluster_style
				 styleMap:simple_style
            });
		
		map.addLayer(hazard);

        var district = new OpenLayers.Layer.WMS(
            'district',
            'http://localhost:8080/geoserver/wms',
            {layers: 'disaster:kbl',
            visibility: false, transparent: true},
            {opacity: .3}
            //,{tileSize: new OpenLayers.Size(400,400), buffer: 100}
        );

             map.addLayer(district);
       var format=  new OpenLayers.Format.GeoJSON();
/*        
    //working usgs data and code    
  //_________GeoJSON Feed____________________      
        var mapdata = new OpenLayers.Layer.Vector("Map Data", {
    strategies: [new OpenLayers.Strategy.Fixed()],
    eventListeners: {           
        'loadend': function (evt) {//THE LOADEND EVENT LISTENER - WHEN THE LAYER IS DONE LOADING...
            map.zoomToExtent(mapdata.getDataExtent());//ZOOM TO ITS EXTENT!
            }//END OF THE LOADEND EVENT
    },//END OF THE eventListeners BLOCK
    protocol: new OpenLayers.Protocol.HTTP({
       // url: "http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_month.geojson",
      //  url: "data/all_month.geojson",
        url: "http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/4.5_day.geojson",
        format: format
    })  ,
    projection: new OpenLayers.Projection("EPSG:4326")
});
        format.ignoreExtraDims=true;
        
        map.addLayer(mapdata);
        
        */
//___________________________________________________        
         legend = new OpenLayers.Control.Legend( { div: OpenLayers.Util.getElement('legend') } );
  map.addControl(legend);
        
        //__________________panel________________________________________________
        var panel = new OpenLayers.Control.Panel();
        panel.addControls([
            
            new OpenLayers.Control.Button({
                displayClass: "helpButton", trigger: function() {
                    
                }, title: 'Help'
            })
           
        ]);
        map.addControl(panel);
		
//___________________________Bhaktapur, Lalitpur, Kathmandu_______________________________________________
/*
		var district = new OpenLayers.Layer.Vector(
            "hazard",
            {
                strategies: [new OpenLayers.Strategy.BBOX()],
                 projection: new OpenLayers.Projection("EPSG:4326"),
                 protocol: new OpenLayers.Protocol.WFS({
                   version: "1.1.0",
           url: "http://localhost:8080/geoserver/wfs",
           featurePrefix: "disaster", //geoserver worspace name
           featureType: "bkl", //geoserver Layer Name
           featureNS: "http://reportdisaster.com", // Edit Workspace Namespace URI
           geometryName: "the_geom" // field in Feature Type details with type "Geometry"
		//	srsName: "EPSG:4326"
                })
             ,
				 styleMap:simple_style
            });
		
		map.addLayer(district);*/
    
		
//_____________adding feature to vector___________________________________________________________________________________

    var feature_point = new OpenLayers.Feature.Vector(
		new OpenLayers.Geometry.Point()
		.transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            new OpenLayers.Projection("EPSG:4326")) // to Spherical Mercator Projection,
	);
	
	hazard.addFeatures([feature_point ]);
//	console.log(feature_point[1]);
	
	
//_______________________________Building popup__________________________________________________________________________

	
	 
	function onPopupClose(feature) {
                // 'this' is the popup.
                var feature = this.feature;
                if (feature.hazard) { // The feature is not destroyed
                    selectControl.unselect(feature);
                } else { // After "moveend" or "refresh" events on POIs layer all
                         //     features have been destroyed by the Strategy.BBOX
                    this.destroy();
                }
	}
	var selectControl = new OpenLayers.Control.SelectFeature(hazard, {
        hover: false,
        onSelect: function(feature) {
            var layer = feature.layer;
        //    feature.style.fillOpacity = 1;
        //    feature.style.pointRadius = 20;
        //    layer.drawFeature(feature);
            
		
             popup = new OpenLayers.Popup.FramedCloud("chicken",
                                     feature.geometry.getBounds().getCenterLonLat(),
                                     new OpenLayers.Size(50,50),
                                      
                                //       if(feature.attributes.count=1){               
                                         "<div style='font-size:1em'> "+"<strong>Hazard Information</strong>"
                                         +"<br>Date:" + feature.attributes.date
                                         +"<br>Category type:" + feature.attributes.category
                                        +"<br>time:" + feature.attributes.time
                                        +"<br>Muni/Vdc:" + feature.attributes.munivdc
                                    //	+"<img src='img/123.jpg' >"

                                         +"</div>",
                               //         }
                            //             else(){
                            //                 awesome test
                                             
                            //             }
                                                      
                                     null, true, onPopupClose);
				feature.popup = popup;
                popup.feature = feature;
                map.addPopup(popup, true);
        },
	
        onUnselect:function(feature) {
        //    var layer = feature.layer;
        //    feature.style.fillOpacity = 0.7;
        //    feature.style.pointRadius = 16;
        //    feature.renderIntent = null;
        //    layer.drawFeature(feature);
            
            map.removePopup(feature.popup);
        }
    });

map.addControl(selectControl);
    selectControl.activate();
	
//___________________________________________styling for measurement____________________________________________
			
	
		// style the sketch fancy
            var sketchSymbolizers = {
                "Point": {
                    pointRadius: 4,
                    graphicName: "square",
                    fillColor: "white",
                    fillOpacity: 1,
                    strokeWidth: 1,
                    strokeOpacity: 1,
                    strokeColor: "#333333"
                },
                "Line": {
                    strokeWidth: 3,
                    strokeOpacity: 1,
                    strokeColor: "#666666",
                    strokeDashstyle: "dash"
                },
                "Polygon": {
                    strokeWidth: 2,
                    strokeOpacity: 1,
                    strokeColor: "#666666",
                    fillColor: "white",
                    fillOpacity: 0.3
                }
            };
            var style = new OpenLayers.Style();
            style.addRules([
                new OpenLayers.Rule({symbolizer: sketchSymbolizers})
            ]);
            var styleMap = new OpenLayers.StyleMap({"default": style});
            
            // allow testing of specific renderers via "?renderer=Canvas", etc
            var renderer = OpenLayers.Util.getParameters(window.location.href).renderer;
            renderer = (renderer) ? [renderer] : OpenLayers.Layer.Vector.prototype.renderers;
			

	
//____________________________mesurng distance, area__________________________________________
	
	var measureControls
	   
            measureControls = {
                line: new OpenLayers.Control.Measure(
                    OpenLayers.Handler.Path, {
                        persist: true,
                        handlerOptions: {
                            layerOptions: {
                                renderers: renderer,
                                styleMap: styleMap
                            }
                        }
                    }
                ),
                polygon: new OpenLayers.Control.Measure(
                    OpenLayers.Handler.Polygon, {
                        persist: true,
                        handlerOptions: {
                            layerOptions: {
                                renderers: renderer,
                                styleMap: styleMap
                            }
                        }
                    }
                )
            };
            
            var control;
            for(var key in measureControls) {
                control = measureControls[key];
                control.events.on({
                    "measure": handleMeasurements,
                    "measurepartial": handleMeasurements
                });
                map.addControl(control);
            }
            
     //       document.getElementById('controlToggle').checked = true;
        
        
        function handleMeasurements(event) {
            var geometry = event.geometry;
            var units = event.units;
            var order = event.order;
            var measure = event.measure;
            var element = document.getElementById('output');
            var out = "";
            if(order == 1) {
                out += "measure: " + measure.toFixed(3) + " " + units;
            } else {
                out += "measure: " + measure.toFixed(3) + " " + units + "<sup>2</" + "sup>";
            }
            element.innerHTML = out;
        }

        function toggleControl(element){
          for(var key in measureControls) {
              var control = measureControls[key];
              if(element.value == key && element.checked) {
                  control.activate();
              } else {
                  control.deactivate();
              }
          }
        }
    
	map.addControl(new OpenLayers.Control.LayerSwitcher({
							div: document.getElementById('layers')
							
						}));
//	window.onload=alert("onload");	
 
   map.setCenter(new
        OpenLayers.LonLat(85.3333,27.7000) // Center of the map
          .transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            new OpenLayers.Projection("EPSG:900913") // to Spherical Mercator Projection
          ), 11 // Zoom level
         );
       /* map.zoomToExtent(district.getDataExtent().transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913")));*/
}
