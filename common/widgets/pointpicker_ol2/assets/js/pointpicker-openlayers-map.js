/**
 * Created by girc on 2/5/15.
 */

/* Openlayers Utilities **/
/**
 * APIMethod: createDirection
 * Create dirction symbol point {<openLayers.Feature.Vector>} of the line
 * with attribute as angle (degree) for given position(s) on line
 * Parameter:
 * line - {<OpenLayers.Geometry.LineString>} or {<OpenLayers.Geometry.MultiLineString>}
 * postion - {string}
 *		"start" - start of the geometry / segment
 *		"end" - end of geometry / segment
 *		"middle" - middle of geometry /segment
 * forEachSegment - {boolean}
 *	if true create points on each segments of line for given position
 * look at: http://geometricnet.sourceforge.net/examples/directions.html
 *  or  include http://geometricnet.sourceforge.net/examples/Direction.js
 */

createDirection = function(line,position,forEachSegment) {
    if (line instanceof OpenLayers.Geometry.MultiLineString) {
        //TODO
    } else if (line instanceof OpenLayers.Geometry.LineString) {
        return createLineStringDirection(line,position,forEachSegment);
    } else {
        return [];
    }
};

createLineStringDirection = function(line,position, forEachSegment){
    if (position == undefined ){ position ="end"}
    if (forEachSegment == undefined ) {forEachSegment = false;}
    var points =[];
    //var allSegs = line.getSortedSegments();
    var allSegs = getSegments(line);
    var segs = [];

    if (forEachSegment)	{
        segs = allSegs;
    } else {
        if  (position == "start") {
            segs.push(allSegs[0]);
        } else if (position == "end") {
            segs.push(allSegs[allSegs.length-1]);
        } else if (position == "middle"){
            return [getPointOnLine(line,.5)];
        } else {
            return [];
        }
    }
    for (var i=0;i<segs.length ;i++ )	{
        points = points.concat(createSegDirection(segs[i],position) );
    }
    return points;
};

createSegDirection = function(seg,position) {
    var segBearing = bearing(seg);
    var positions = [];
    var points = [];
    if  (position == "start") {
        positions.push([seg.x1,seg.y1]);
    } else if (position == "end") {
        positions.push([seg.x2,seg.y2]);
    } else if (position == "middle") {
        positions.push([(seg.x1+seg.x2)/2,(seg.y1+seg.y2)/2]);
    } else {
        return null;
    }
    for (var i=0;i<positions.length;i++ ){
        var pt = new OpenLayers.Geometry.Point(positions[i][0],positions[i][1]);
        var ptFeature = new OpenLayers.Feature.Vector(pt,{angle:segBearing});
        points.push(ptFeature);
    }
    return points;
};

bearing = function(seg) {
    b_x = 0;
    b_y = 1;
    a_x = seg.x2 - seg.x1;
    a_y = seg.y2 - seg.y1;
    angle_rad = Math.acos((a_x*b_x+a_y*b_y)/Math.sqrt(a_x*a_x+a_y*a_y)) ;
    angle = 360/(2*Math.PI)*angle_rad;
    if (a_x < 0) {
        return 360 - angle;
    } else {
        return angle;
    }
};

getPointOnLine = function (line,measure) {
    var segs = getSegments(line);
    var lineLength = line.getLength();
    var measureLength = lineLength*measure;
    var length = 0;
    var partLength=0;
    for (var i=0;i<segs.length ;i++ ) {
        var segLength = getSegmentLength(segs[i]);
        if (measureLength < length + segLength) {
            partLength = measureLength - length;
            var x = segs[i].x1 + (segs[i].x2 - segs[i].x1) * partLength/segLength;
            var y = segs[i].y1 + (segs[i].y2 - segs[i].y1) * partLength/segLength;
            var segBearing = bearing(segs[i]);
            console.log("x: " + x+", y: " + y + ", bearing: " + segBearing);
            var pt = new OpenLayers.Geometry.Point(x,y);
            var ptFeature = new OpenLayers.Feature.Vector(pt,{angle:segBearing});
            return ptFeature;
        }
        length = length + segLength;
    }
    return false;
};

getSegmentLength = function(seg) {
    return Math.sqrt( Math.pow((seg.x2 -seg.x1),2) + Math.pow((seg.y2 -seg.y1),2) );
};

getSegments = function(line) {
    var numSeg = line.components.length - 1;
    var segments = new Array(numSeg), point1, point2;
    for(var i=0; i<numSeg; ++i) {
        point1 = line.components[i];
        point2 = line.components[i + 1];
        segments[i] = {
            x1: point1.x,
            y1: point1.y,
            x2: point2.x,
            y2: point2.y
        };
    }
    return segments;
};
/*  end OpenLayers Utilities */

function toast(obj) {
    if (typeof obj === 'string') {
        alert(obj);
    } else {
        alert(JSON.stringify(obj));
    }
}
if (typeof Object.create !== 'function') {
    Object.create = function (obj) {
        function F() {
        };
        F.prototype = obj;
        return F();
    }
}

$.fn.exists = function () {
    return this.length !== 0;
};

function getClass(obj) {
    if (typeof obj === "undefined")
        return "undefined";
    if (obj === null)
        return "null";
    return Object.prototype.toString.call(obj)
        .match(/^\[object\s(.*)\]$/)[1];
}
function getObjectClass(obj) {
    if (obj && obj.constructor && obj.constructor.toString) {
        var arr = obj.constructor.toString().match(/function\s*(\w+)/);

        if (arr && arr.length == 2) {
            return arr[1];
        }
    }
    return undefined;
}
(function ($, window, document, undefined) {
    var PointPickerMap = {
        init: function(options,pointPicker){
            var self = this;
            self.map, self.osmLayer,self.vectorLayer,self.connectorLayer,self.dirLayer, self.click, self.oldMarker, self.newMarker;
            self.pointPicker = pointPicker;  // Class PoiintPicker
            self.options = $.extend({}, PointPickerMap.options, options);
            self.$iLat =self.options.$iLat;
            self.$iLon =self.options.$iLon;
            self.$iPlacename =self.options.$iPlacename;
            self.$iWktFieldId=self.options.$iWktFieldId;
            self.openlayersImgPath = self.options.openlayersImgPath;
            self.mapDivId=self.options.mapDivId;
            self.$mapDiv=self.options.$mapDiv;
            self.markerUrl=self.options.markerUrl;
            self.externalMapDivId=self.options.externalMapDivId;
            self.setOpenLayersGlobals();
            self.initOpenLayersMap();
        },
        setOpenLayersGlobals:function(){
            var ppM = this;
            OpenLayers.ProxyHost = "/cgi-bin/proxy.cgi?url=";
            OpenLayers.ImgPath = ppM.openlayersImgPath;
        },
        removeClick:function(){
            var ppM= this;
            if(ppM.click){
                b=ppM.map.removeControl(ppM.click);
            }

        },
        deactivateClick:function(){
        if(this.click){
            this.click.deactivate();
        }
    },
    activateClick:function(){
        this.click.activate();
    },
    zoomToLonLat:function(lon,lat){
		var ppM=this;
		
        map = this.map;

        if(map && lat && lon){
            map.setCenter(new OpenLayers.LonLat(lon, lat) // Center of the map
                    .transform(
                    new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                    map.getProjectionObject()
                ), 12 // Zoom level
            );
        }
		},
    zoomToCurrent:function(){
        var ppM= this;
        ppM.handlePickPoint();
        lat = $(this.$iLat).val();
        lon = $(this.$iLon).val();
        ppM.zoomToLonLat(lon,lat);
    },
    reverseGeocode:function(lon,lat,fnCallbackSuccess){
        var self=this;
        var lat=lat; var lon=lon;
        ////http://www.mapquestapi.com/geocoding/v1/reverse?key=Fmjtd|luur20a729%2Cb0%3Do5-9a15qr&callback=renderReverse&location=27.7067577,85.3153407
         /** 
             * Changed the domain from www.mapquestapi to open.mapquestapi
             * @see http://developer.mapquest.com/de/web/products/forums/-/message_boards/message/670106;jsessionid=fP735P969n7bpvH082d9.0
            */
        $.ajax(
            'http://open.mapquestapi.com/geocoding/v1/reverse?',{
                dataType: 'jsonp',
                jsonpCallback: 'fnCallbackSuccess',
                jsonp: 'callback',
                data:{
                    key:'Fmjtd|luur20a729%2Cb0%3Do5-9a15qr',
                    location:lat+','+lon
                },

                success:fnCallbackSuccess,
                error:function(jqXHR,textStatus,errorThrown ){
                    return {
                        status:'OK',
                        fullAddress:'',
                        jqXHR:jqXHR
                    }

                }
            }
        );
    },
    parseMapquestReverseGeocode:function(data){
        var location =data.results[0].locations[0];
        var fullAddress='';
        var comp = [];
        if(location.adminArea6){comp.push(location.adminArea6);}
        if(location.street){comp.push(location.street);}
        if(location.adminArea5){comp.push(location.adminArea5);}
        if(location.adminArea6){comp.push(location.adminArea4);}
        if(location.adminArea3){comp.push(location.adminArea3);}
        if(location.adminArea2){comp.push(location.adminArea2);}
        if(location.adminArea1){comp.push(location.adminArea1);}
        for(i=0;i<comp.length;i++){
            if(i==0){
                fullAddress+=comp[i];
            }else{
                fullAddress+=','+comp[i];
            }
        }
        console.log(fullAddress);
        return {
            status:'OK',
            fullAddress:fullAddress
        };
    },
    handlePickPoint:function(){
        var ppM=this;
        var oldMarker, newMarker ,newLon,newLat,oldLon,oldLat;
        if(ppM.vectorLayer.features[0]){
            oldFeature=ppM.vectorLayer.features[0];
            oldLonlat=oldFeature.geometry.getBounds().getCenterLonLat().transform(ppM.map.getProjectionObject(), new OpenLayers.Projection("EPSG:4326"));
            oldLon=oldLonlat.lon.toFixed(6);
            oldLat=oldLonlat.lat.toFixed(6);

            oldMarker=ppM.createOldMarker(oldLon,oldLat);

            ppM.vectorLayer.removeAllFeatures(); // remove any previous feature
            ppM.vectorLayer.addFeatures(oldMarker);
        }
        if (ppM.$iLon && ppM.$iLat) {
            newLon=$(ppM.$iLon).val();
            newLat=$(ppM.$iLat).val();
            newWktField=$(ppM.$iWktFieldId).val();
        }
        newMarker = ppM.createNewMarker(newLon, newLat);
        //adding marker on click
        ppM.vectorLayer.addFeatures(newMarker);
        if(oldLon && oldLat && newLon && newLat){
            if(ppM.connectorLayer){ppM.connectorLayer.removeAllFeatures();}
            if(ppM.dirLayer){ppM.dirLayer.removeAllFeatures();}
            // Make Line
            ppM.connectorLayer=ppM.makeLineLonLat(oldLon, oldLat, newLon, newLat,'connector');
            ppM.map.addLayer(ppM.connectorLayer);
            // Make Direction of Line
            ppM.dirLayer = ppM.makeDirLayer(ppM.connectorLayer, 'direction');
            ppM.map.addLayer(ppM.dirLayer);
        }
        ppM.reverseGeocode(newLon,newLat,
            function(data,textStatus,jqXHR ){
                var revG = ppM.parseMapquestReverseGeocode(data);
                fullAddress = revG.fullAddress;
                // Dirty But needed for select 2 js
                if($(ppM.$iPlacename).prev('div').children('a.select2-choice').children('span.select2-chosen')){
                    $(ppM.$iPlacename).prev('div').children('a.select2-choice').children('span.select2-chosen').html(fullAddress);
                    $(ppM.$iPlacename).val(fullAddress);
                }else{
                    $(ppM.$iPlacename).val(fullAddress);
                }
            }
        );
    },
    initClick:function(){
        var ppM=this;
        OpenLayers.Control.Click = OpenLayers.Class(OpenLayers.Control, {
                defaultHandlerOptions: {
                    'single': true,
                    'double': false,
                    'pixelTolerance': 0,
                    'stopSingle': false,
                    'stopDouble': false
                },
                initialize: function (options) {
                    this.handlerOptions = OpenLayers.Util.extend({}, this.defaultHandlerOptions);
                    OpenLayers.Control.prototype.initialize.apply(
                        this, arguments
                    );
                    this.handler = new OpenLayers.Handler.Click(
                        this, {
                            'click': this.trigger
                        }, this.handlerOptions
                    );
                },
                trigger: function(e){
                    var olControlClick = this;  //OpenLayers.Control
                    var oldMarker, newMarker ,newLon,newLat,oldLon,oldLat;
                    if(ppM.vectorLayer.features[0]){
                        oldFeature=ppM.vectorLayer.features[0];
                        oldLonlat=oldFeature.geometry.getBounds().getCenterLonLat().transform(ppM.map.getProjectionObject(), new OpenLayers.Projection("EPSG:4326"));
                        oldLon=oldLonlat.lon.toFixed(6);
                        oldLat=oldLonlat.lat.toFixed(6);

                        oldMarker=ppM.createOldMarker(oldLon,oldLat);

                        ppM.vectorLayer.removeAllFeatures(); // remove any previous feature
                        ppM.vectorLayer.addFeatures(oldMarker);
                    }

                    //var newLonlat = ppM.map.getLonLatFromViewPortPx(e.xy).transform(ppM.map.getProjectionObject(), new OpenLayers.Projection("EPSG:4326"));
                    //newLonlat = ppM.map.getLonLatFromPixel(e.xy).transform(ppM.map.getProjectionObject(), new OpenLayers.Projection("EPSG:4326"));
                    var newLonlat = ppM.map.getLonLatFromPixel(e.xy).transform(ppM.map.getProjectionObject(), new OpenLayers.Projection("EPSG:4326"));
                    newLon =newLonlat.lon.toFixed(6);
                    newLat =newLonlat.lat.toFixed(6);
                    if (ppM.$iLon && ppM.$iLat) {
                        $(ppM.$iLon).val(newLon);
                        $(ppM.$iLat).val(newLat);
                        console.log($(ppM.$iWktFieldId));
                        $(ppM.$iWktFieldId).val('POINT('+newLon+' '+newLat+')');
                    }
                    newMarker = ppM.createNewMarker(newLon, newLat);
                    //adding marker on click
                    ppM.vectorLayer.addFeatures(newMarker);

                    if(oldLon && oldLat && newLon && newLat){
                        if(ppM.connectorLayer){ppM.connectorLayer.removeAllFeatures();}
                        if(ppM.dirLayer){ppM.dirLayer.removeAllFeatures();}
                        // Make Line
                        ppM.connectorLayer=ppM.makeLineLonLat(oldLon, oldLat, newLon, newLat,'connector');
                        ppM.map.addLayer(ppM.connectorLayer);
                        // Make Direction of Line
                        ppM.dirLayer = ppM.makeDirLayer(ppM.connectorLayer, 'direction');
                        ppM.map.addLayer(ppM.dirLayer);
                    }
                    ppM.reverseGeocode(newLon,newLat,
                        function(data,textStatus,jqXHR ){
                            var revG = ppM.parseMapquestReverseGeocode(data);
                            fullAddress = revG.fullAddress;
                            // Dirty But needed for select 2 js
                            if($(ppM.$iPlacename).prev('div').children('a.select2-choice').children('span.select2-chosen')){
                                $(ppM.$iPlacename).prev('div').children('a.select2-choice').children('span.select2-chosen').html(fullAddress);
                                $(ppM.$iPlacename).val(fullAddress);
                            }else{
                                $(ppM.$iPlacename).val(fullAddress);
                            }

                        }
                    );
                }
            }
        );

        ppM.click = new OpenLayers.Control.Click();
        return ppM.click;
    },
    addClick:function(){
        click = this.initClick();
        this.map.addControl(click);
        this.click.activate();
    },
    activate:function(){
        this.addMarkerVectorLayer('Overlay');
        this.syncLonLat();
        this.activateClick();
    },
    deactivate:function(){
        this.removeOverlay();
        this.deactivateClick();
    },

    makeLineLonLat:function(lon1,lat1,lon2,lat2,layerName){
        var ppM=this;
        var lineLayer;
        var p1 = new OpenLayers.Geometry.Point(lon1,lat1).transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            ppM.map.getProjectionObject()
        );
        var p2 = new OpenLayers.Geometry.Point(lon2,lat2).transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            ppM.map.getProjectionObject()
        );
        var lineString = new OpenLayers.Geometry.LineString([p1, p2]);
        var lineFeature=new OpenLayers.Feature.Vector(lineString);
        lineLayer = new OpenLayers.Layer.Vector(layerName,
            {
                style:{strokeColor: '#0000ff',
                    strokeOpacity: 0.2,
                    strokeWidth: 2,
                    strokeDashstyle:'dot'
                }
            });

        lineLayer.addFeatures([lineFeature]);

        return lineLayer;
    },

    makeDirLayer:function(vectorLayer, layerName){
        layerName=(layerName)?layerName:'direction';
        var dirLayer;
        // requires APIMethod: createDirection
        // look at: http://geometricnet.sourceforge.net/examples/directions.html
        // or  include http://geometricnet.sourceforge.net/examples/Direction.js
        //**********************add direction layer ************************

        OpenLayers.Renderer.symbol.arrow = [0,2, 1,0, 2,2, 1,0, 0,2];
        var styleMap = new OpenLayers.StyleMap(OpenLayers.Util.applyDefaults(
            {graphicName:"arrow",rotation : "${angle}",strokeColor: '#0000ff',
                strokeOpacity: 0.5
            },
            OpenLayers.Feature.Vector.style["default"]));
        dirLayer = new OpenLayers.Layer.Vector(layerName, {styleMap: styleMap});
        //ppM.map.addLayer(ppM.dirLayer);
        updateDirection(vectorLayer,dirLayer)
        // -----------------required Methods-----------------------
        function updateDirection(vectorLayer,dirLayer) {
            dirLayer.removeAllFeatures();
            var points=[];
            var features =vectorLayer.features;
            for (var i=0;i<features.length ;i++ )	{
                var linePoints = createDirection(features[i].geometry,get_position_value(),get_foreachseg_value()) ;
                for (var j=0;j<linePoints.length ;j++ ) {
                    linePoints[j].attributes.lineFid = features[i].fid;
                }
                points =points.concat(linePoints);
            }
            dirLayer.addFeatures(points);
        }

        function get_position_value()	{
            //for (var i=0; i < document.direction.position.length; i++)
            //   {
            //   if (document.direction.position[i].checked)
            //	  {
            //	  return document.direction.position[i].value;
            //	  }
            //  }
            return 'middle';
        }
        function get_foreachseg_value()	{
            //if (document.direction.foreachseg.checked){
            //	return true;
            //} else {
            //	return false;
            //}
            return true;
        }
        //**********************end add direction layer ************************
        return dirLayer;
    },
    initOpenLayersMap: function(){
        var ppM= this;
        if(ppM.externalMapDivId){	// get the external map instance
            map = $('#'+ppM.externalMapDivId).data('map').map;
            this.map=map;
            //this.addMarkerVectorLayer();
            this.addOverlay();
            this.syncLonLat();
            this.setHTML5MapData();
            this.addClick();

        }else{ // create new openlayers map instance
            var map = new OpenLayers.Map(this.mapDivId, {
                    projection: new OpenLayers.Projection("EPSG:900913"),
                    displayProjection: new OpenLayers.Projection("EPSG:4326"),
                    maxResolution: 2.5,
                    numZoomLevels: 20
                }
            );
            this.map = map;
            osmLayer=this.initOSMLayer();
            map.addLayers([osmLayer]);
            map.setCenter(new OpenLayers.LonLat(85.3333, 27.7000) // Center of the map
                    .transform(
                    new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                    ppM.map.getProjectionObject()
                ), 9 // Zoom level
            );
            this.setHTML5MapData();
            //this.addMarkerVectorLayer();
            this.addOverlay();
            this.addClick();
            this.syncLonLat();
        }
    },
    setHTML5MapData:function(key){
        key=(key)?key:'map';
        this.$mapDiv.data(key, this.map);
    },
    getMap : function () {
        return this.$mapDiv.data('map');
    },
    getMarker : function () {
        return this.$mapDiv.data('marker');
    },
    initOSMLayer:function(){
        this.osmLayer = new OpenLayers.Layer.OSM("Street Map");
        return this.osmLayer;
    },
    addOSMLayer:function(){
        osmLayer=this.initOSMLayer();
        this.map.addLayer(osmLayer);
    },
    initVectorLayer:function(layerName){
        var styleMap = new OpenLayers.StyleMap(
            {
                externalGraphic:this.markerUrl
            }
        );
        var lookupRule = {
            "default":{
            },
            "old": {
                externalGraphic:this.markerUrl,
                graphicHeight: 15,
                graphicWidth: 12,
                fillOpacity:0.4
            },
            "new": {
                externalGraphic:this.markerUrl,
                graphicHeight: 21,
                graphicWidth: 16
            }
        };
        styleMap.addUniqueValueRules("default","ol_rule",lookupRule);
        this.vectorLayer = new OpenLayers.Layer.Vector(layerName,
            {
                styleMap: styleMap
            });
        return this.vectorLayer;
    },
    addMarkerVectorLayer:function(layerName){
        layerName=(layerName)?layerName:"Overlay";
        markerLayer = this.initVectorLayer(layerName);
        this.vectorLayer = markerLayer;
        this.map.addLayer(markerLayer);
    },
    initConnectorLayer :function(){
        var ppM=this;
        ppM.connectorLayer=ppM.makeLineLonLat(undefined, undefined, undefined, undefined,'connector');
        ppM.map.addLayer(ppM.connectorLayer);
    },
    initDirLayer:function(){
        var ppM=this;
        ppM.dirLayer = ppM.makeDirLayer(ppM.connectorLayer, 'direction');
        ppM.map.addLayer(ppM.dirLayer);
    },
    resetMap:function(){
        this.removeOverlay();
        this.removeClick();
    },
    removeOverlay:function(){
        if(this.vectorLayer){this.map.removeLayer(this.vectorLayer);
            this.vectorLayer=undefined;
        }
        if(this.connectorLayer){this.map.removeLayer(this.connectorLayer);
            this.connectorLayer = undefined;
        }
        if(this.dirLayer){this.map.removeLayer(this.dirLayer)
            this.dirLayer=undefined;
        };
    },

    addOverlay:function(){
        this.addMarkerVectorLayer();
        this.initConnectorLayer();
        this.initDirLayer();
    },

    syncLonLat:function(){
        var lon,lat;
        var self = this;
        var setNewMarker = function(lon,lat){
            // create newMarker
            newMarker = self.createNewMarker(lon,lat);
            self.vectorLayer.destroyFeatures();
            self.addMarker(newMarker);

            var ext = self.vectorLayer.getDataExtent();
            self.map.zoomToExtent(ext,true);
            if(self.map.getZoom()>12){
                self.map.zoomTo(12);
            }



            self.reverseGeocode(lon,lat,
                function(data,textStatus,jqXHR ){
                    var revG = self.parseMapquestReverseGeocode(data);
                    fullAddress = revG.fullAddress;
                    // Dirty But needed for select 2 js
                    if($(self.$iPlacename).prev('div').children('a.select2-choice').children('span.select2-chosen')){
                        $(self.$iPlacename).prev('div').children('a.select2-choice').children('span.select2-chosen').html(fullAddress);
                        $(self.$iPlacename).val(fullAddress);
                    }else{
                        $(self.$iPlacename).val(fullAddress);
                    }
                }
            );

        };






		if(self.$iWktFieldId){
			if ($(self.$iWktFieldId).val()){
				wkt = $(self.$iWktFieldId).val();
			}			
		}
        // Check if the specified div ids for latitude and longitude fields exists
        if (self.$iLat && self.$iLon) {
            // check if the form already has lat lon
            if ($(self.$iLat).val() && $(self.$iLon).val()) {
                lat = $(self.$iLat).val();
                lon = $(self.$iLon).val();
                setNewMarker(lon,lat);

            }else{// form doesnt have lat lon so use geolocate
                var positiondata;
                function setLonLat(){
                    positiondata = JSON.parse(localStorage['positiondata']);
                    lat = positiondata.latitude;
                    lon = positiondata.longitude;
                    $(self.$iLat).val(lat);
                    $(self.$iLon).val(lon);
                    
                    setNewMarker(lon,lat);
                }
                if(localStorage['positiondata']){
                    setLonLat();
                }else{ // again execute html5 geolocation
                    getLocationHTML5();
                    if(localStorage['positiondata']){
                        setLonLat();
                    }
                }
                console.log('--------------------------------------------');
                console.log('positiondata');
                console.log(lat);
                console.log(lon);
                console.log('--------------------------------------------');

            }
        }
        if (this.$iPlacename) {
            if ($(this.$iPlacename).val()) {
                var placename = $(this.$iLat).val();
            }
        }
    },
    createMarker: function (lon, lat, ol_rule) {
        var ppM= this;
        var feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point(lon, lat).transform(
                new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                ppM.map.getProjectionObject()
            ), {
                ol_rule: ol_rule
            });
        return feature;
    },
    createOldMarker:function(lon,lat){
        this.oldMarker=this.createMarker(lon,lat,'old');
        return this.oldMarker;
    },
    createNewMarker:function(lon,lat){
        this.newMarker=this.createMarker(lon,lat,'new');
        return this.newMarker;
    },
    addMarker:function(marker){
        this.vectorLayer.addFeatures(marker);
        return this.vectorLayer;
    },
    updateMarker: function (vectorLayer, lon, lat, propType) {
        propType=(propType)?propType:'default';
        var feature = this.createMarker(lon, lat, 'default');
        vectorLayer.addFeatures(feature);
        return vectorLayer;
    }};

PointPickerMap.options = {
    $iLat:'',
    $iLon:'',
    $iPlacename:'',
    $iWktFieldId:'',
    openlayersImgPath:'',
    markerUrl:'',
    $mapDiv:''
};

    var PointPicker;
    PointPicker = {
        init: function (options, elem) {
            var self = this;
            self.options = $.extend({}, $.fn.pointPicker.options, options);
            self.elem = elem;
            self.$elem = $(elem);
            self.mapDivId = self.options.mapDivId;
            self.$mapDiv = (self.options.mapDivId != undefined) ? $('#' + self.options.mapDivId) : undefined;
            self.$iLat = $('#' + self.options.iLatId);
            self.$iLon = $('#' + self.options.iLonId);
            self.$iPlacename = $('#' + self.options.iPlacenameId);
            self.$iWktFieldId = $('#' + self.options.iWktFieldId);
            self.$iOK = undefined;
            self.$iZOOM_TO_CURRENT = undefined;
            self.$iDialog = undefined;
            self.$iFields = undefined;
            self.$iActions = undefined;
            self.trigger = self.options.trigger;
            self.widgetDivId = self.options.widgetDivId;
            self.latitudeId = self.options.latitudeId;
            self.longitudeId = self.options.longitudeId;
            self.placenameId = self.options.placenameId;
            self.wktFieldId =self.options.wktFieldId;
            self.externalMapDivId = self.options.externalMapDivId;
            self.triggerId = self.options.triggerId;
            self.pointPickerMap = undefined; //PointPickerMap
            self.markerUrl = self.options.markerUrl;

            self.setPointPickerData(); // store the point picker object to data attribute of widget HTML5
            self.initHTMLElements();
            self.activateTrigger();

        },
        activateTrigger: function () {
            var pointPicker = this;
            var $ppDialogTrg = $('#' + this.triggerId);
            var $ppDialog = $(pointPicker.$iDialog);

            $ppDialog.css({display: 'none'});
            $ppDialog.dialog({
                autoOpen: false,
                dialogClass: 'ui-dialog-form',
                width: "auto",
                height: "auto",
                draggable: pointPicker.externalDivId
            });

            $ppDialogTrg.click(function () {
                var trg = this;
                if ($ppDialog.dialog("isOpen") == false) {
                    pointPicker.openWidget();
                } else {
                    pointPicker.cancelChanges();
                }

            });

            $(pointPicker.$iOK).click(function () {
                var trg = this;
                pointPicker.saveChanges();
            });
            $(pointPicker.$iCANCEL).click(function () {
                pointPicker.cancelChanges();
            });

            $(pointPicker.$iZOOM_TO_CURRENT).click(function () {
                pointPicker.pointPickerMap.zoomToCurrent();
            });

        },
        openWidget: function () {
            this.initFormData();
            if (!this.pointPickerMap) {
                this.initMap();
            } else {
                this.pointPickerMap.activate();
            }
            this.openDialog();
        },
        saveChanges: function () {
            if (this.pointPickerMap) {
                this.setData();
                this.pointPickerMap.deactivate();
            }
            this.closeDialog();
        },
        cancelChanges: function () {
            if (this.pointPickerMap) {
                this.pointPickerMap.deactivate();
            }
            this.closeDialog();
        },
        closeDialog: function () {
            var pointPicker = this;
            $(pointPicker.$iDialog).dialog("close");
        },
        openDialog: function () {
            var pointPicker = this;
            $(pointPicker.$iDialog).dialog("open");
        },
        setData: function () {
            var pointPicker = this;
            console.log('*******test*******');
            console.log(pointPicker.placenameId);
            console.log($('#' + pointPicker.placenameId));
            console.log('**************');
            $('#' + pointPicker.latitudeId).val(pointPicker.$iLat.val());
            $('#' + pointPicker.longitudeId).val(pointPicker.$iLon.val());
            $('#' + pointPicker.wktFieldId).val(pointPicker.$iWktFieldId.val());

            // Dirty But needed for select 2 js
            if ($('#' + pointPicker.placenameId).prev('div').children('a.select2-choice').children('span.select2-chosen')) {
                $('#' + pointPicker.placenameId).prev('div').children('a.select2-choice').children('span.select2-chosen').html(pointPicker.$iPlacename.val());
                $('#' + pointPicker.placenameId).val(pointPicker.$iPlacename.val());
            } else {
                $('#' + pointPicker.placenameId).val(pointPicker.$iPlacename.val());
            }
        },
        getData: function () {
            var pointPicker = this;
            return {
                lat: pointPicker.$iLat.value,
                lon: pointPicker.$iLon.value,
                placename: pointPicker.$iPlacename.value,
                wkt:"POINT("+pointPicker.$iLon.value+" "+pointPicker.$iLat.value+")"
            };
        },
        initFormData: function () {
            var pointPicker = this;

            if (pointPicker.latitudeId && pointPicker.longitudeId) {
                if (($('#' + pointPicker.latitudeId).value != '') && ($('#' + pointPicker.longitudeId).value != '')) {
                    $(pointPicker.$iLat).val($('#' + pointPicker.latitudeId).val());
                    $(pointPicker.$iLon).val($('#' + pointPicker.longitudeId).val());
                    $(pointPicker.$iWktFieldId).val("POINT("+pointPicker.$iLon.value+" "+pointPicker.$iLat.value+")");
                    // Dirty But needed for select 2 js because select2js hides input under div
                    if ($('#' + pointPicker.placenameId).prev('div').children('a.select2-choice').children('span.select2-chosen')) {
                        $(pointPicker.$iPlacename).val($('#' + pointPicker.placenameId).val());
                        $(pointPicker.$iPlacename).prev('div').children('a.select2-choice').children('span.select2-chosen').html($('#' + pointPicker.placenameId).val());
                    } else {
                        $(pointPicker.$iPlacename).val($('#' + pointPicker.placenameId).val());
                    }



                }
            }
            if (pointPicker.placenameId && $('#' + pointPicker.placenameId).val()) {
                $(pointPicker.$iPlacename).val($('#' + pointPicker.placenameId).val());
            }
        },
        setPointPickerData: function () {
            var pointPicker = this;
            pointPicker.$elem.data('PointPicker', pointPicker);
        },
        initHTMLElements: function () {
            var pointPicker = this;
            pointPicker.$iDialog = $(pointPicker.elem).children('.pointpickerdialog')[0];
            pointPicker.$iFields = $(pointPicker.$iDialog).children('.pointpickerfields')[0];

            //pointPicker.$iLat = $(pointPicker.$iFields).children('.pointpickerfield.latitude')[0];
            //pointPicker.$iLon = $(pointPicker.$iFields).children('.pointpickerfield.longitude')[0];
            //pointPicker.$iPlacename = $(pointPicker.$iFields).children('.pointpickerfield.placename')[0];

            //pointPicker.$iLat = $(pointPicker.$iFields).children('.pointpickerfield.latitude')[0];
            //pointPicker.$iLon = $(pointPicker.$iFields).children('.pointpickerfield.longitude')[0];
            //pointPicker.$iPlacename = $(pointPicker.$iFields).children('.pointpickerfield.placename')[0];

            pointPicker.$iActions = $(pointPicker.$iDialog).children('.pointpickeractions')[0];
            pointPicker.$iOK = $(pointPicker.$iActions).children('.pointpicker.ok')[0];
            pointPicker.$iZOOM_TO_CURRENT = $(pointPicker.$iActions).children('.pointpicker.zoomtocurrent')[0];
            pointPicker.$iCANCEL = $(pointPicker.$iActions).children('.pointpicker.cancel')[0];
            
            document.addEventListener('locationUpdated',function(e) {
				/*console.log(
					"Event subscriber on "+e.currentTarget.nodeName+", "
					+e.detail.time.toLocaleString()+": "+e.detail.latitude+": "+e.detail.longitude+": "+e.detail.self
				);*/
				if(pointPicker.pointPickerMap){
					pointPicker.pointPickerMap.zoomToLonLat(e.detail.longitude,e.detail.latitude);
				}
			});
        },
        initMap: function () {
            var pointPicker = this;
            var ppMap = Object.create(PointPickerMap);
            var ppMapOpts = {
                $iLat: pointPicker.$iLat,
                $iLon: pointPicker.$iLon,
                $iPlacename: pointPicker.$iPlacename,
                $iWktFieldId:pointPicker.$iWktFieldId,
                openlayersImgPath: pointPicker.options.openlayersImgPath,
                markerUrl: pointPicker.markerUrl,
                mapDivId: pointPicker.mapDivId,
                $mapDiv: pointPicker.$mapDiv,
                externalMapDivId: pointPicker.externalMapDivId
            };
            ppMap.init(ppMapOpts, pointPicker);
            pointPicker.pointPickerMap = ppMap;
        },
        myProp: 'foo'
    };
$.fn.pointPicker = function (options) {
    return this.each(function () {
        var pointPicker = Object.create(PointPicker);
        pointPicker.init(options, this);
    });
};
$.fn.pointPicker.options = {
    latitudeId: '',
    longitudeId: '',
    placenameId: '',
    wktFieldId:'',
    openlayersPackUrl: '//cdnjs.cloudflare.com/a.../openlayers/2.13.1',
    openlayersImgPath: '//cdnjs.cloudflare.com/ajax/libs/openlayers/2.13.1/img/',
    markerUrl: '//cdnjs.cloudflare.com/ajax/libs/openlayers/2.13.1/img/marker.png',
    'widgetDivId': '',
    'mapDivId': ''
};

})(jQuery, window, document, undefined);
