var ghr;
/**
 * Created by User on 4/5/2015.
 */
(function ($,Class) {
    var Routing = {
        init:function(options,elem){
            $.support.cors = true;
            var self= this;
            self.options= $.extend({}, $.fn.routing.options,options);
            self.elem = elem;
            self.$elem=$(elem);
            self.$mapDivId = $('#'+self.options.mapDivId);
            self.$userLocationDivId = $('#'+self.options.userLocationDivId);
            self.map = self.$mapDivId.data('map');
            self.userLocation = (self.options.userLocation);

            self.args={
                host:'http://116.90.239.21:8989',
               //key: "Fmjtd|luur20a729%2Cb0%3Do5-9a15qr",
                vehicle: "car",
                elevation: false // elevation: true is only supported for vehicle bike or foot
            };
            self.isActive=true;
            self.includeUserLocation=true;
            self.ghRouting;
            self.ghRoutingLayer;
            self.ghRoutingMarkers=[];
        },


        initGhRouting :function(args){
            var self=this;
            self.ghRouting = new GraphHopperRouting(args);
        },

        changeVehicle:function(vehicle){
            this.args = $.extend({},this.args, {vehicle:vehicle});
            var points = this.ghRouting.points;
            this.initGhRouting(this.args);
            for(i = 0;i<points.length;i++){
                this.ghRouting.addPoint(points[i]);
            }
            this.calculateRoute();
            console.log(this.ghRouting);
        },

        calculateRoute:function(){
            var self = this;
            //  ******************
            // | Calculate route! |
            //  ******************
            //response $('#response').dialog({autoOpen:true,title:'Response'});
            //instructions $('#instructions').dialog({autoOpen:true,title:'Instructions'});
            //
            self.$response = self.$elem.children('.response');
            self.$instructions = self.$elem.children('.instructions');
            self.ghRouting.doRequest(function (json) {
                if (json.info && json.info.errors) {
                    self.$response.text("An error occured: " + json.info.errors[0].message);
                } else {
                    var path = json.paths[0];
                    pathGeoJsonObject = {
                        'type': 'Feature',
                        'geometry': path.points
                    };

                    if(!self.ghRoutingLayer) {// creating layer
                        self.ghRoutingLayer = new ol.layer.Vector({
                            source: new ol.source.GeoJSON({
                                object: pathGeoJsonObject,
                                projection: 'EPSG:3857'
                            })
                            ,style: new ol.style.Style({
                                stroke: new ol.style.Stroke({
                                    color: 'rgba(0,255,0,0.5)',
                                    width: 5
                                })
                            })
                        });
                        self.map.addLayer(self.ghRoutingLayer);
                        self.map.getView().fitExtent( self.ghRoutingLayer.getSource().getExtent(), self.map.getSize());
                    }else{
                        //removing layer features and adding new
                        self.ghRoutingLayer.getSource().clear();
                        formatGeoJson = new ol.format.GeoJSON();
                        var ghRoueFeatures = formatGeoJson.readFeatures(pathGeoJsonObject, {
                            featureProjection: 'EPSG:3857'
                        });
                        self.ghRoutingLayer.getSource().addFeatures(ghRoueFeatures);
                        self.map.getView().fitExtent( self.ghRoutingLayer.getSource().getExtent(), self.map.getSize());
                    }


                    var outHtml = "Distance in meter:" + path.distance;
                    outHtml += "<br/>Times in seconds:" + path.time / 1000;
                    outHtml += "<br/><a href='" + self.ghRouting.getGraphHopperMapsLink() + "'>GraphHopper Maps</a>";
                    self.$response.html(outHtml);
                    /*if (path.bbox) {
                     var minLon = path.bbox[0];
                     var minLat = path.bbox[1];
                     var maxLon = path.bbox[2];
                     var maxLat = path.bbox[3];
                     var tmpB = new L.LatLngBounds(new L.LatLng(minLat, minLon), new L.LatLng(maxLat, maxLon));
                     map.fitBounds(tmpB);
                     }*/
                    var instructionsDiv = self.$instructions;
                    instructionsDiv.empty();
                    if (path.instructions) {
                        var allPoints = path.points.coordinates;
                        var listUL = $("<ol>");
                        instructionsDiv.append(listUL);
                        for (var idx in path.instructions) {
                            var instr = path.instructions[idx];
                            // use 'interval' to find the geometry (list of points) until the next instruction
                            var instruction_points = allPoints.slice(instr.interval[0], instr.interval[1]);
                            // use 'sign' to display e.g. equally named images
                            $("<li>" + instr.text + " <small>(" + self.ghRouting.getTurnText(instr.sign) + ")</small>"
                            + " for " + instr.distance + "m and " + Math.round(instr.time / 1000) + "sec"
                            + ", geometry points:" + instruction_points.length + "</li>").
                                appendTo(listUL);
                        }
                    }
                    self.$response.dialog({title:"Response",maxHeight:"50%",width:"auto"});
                    self.$instructions.dialog({title:"Instructions",maxHeight:"50%",width:"auto"});
                }
            });
        },

        findUserLocation:function(){
            console.log('user not set!');
            console.log('Searching.. From data-user_location .. <Div id="  '+this.options.userLocationDivId+'">');
            if(this.$userLocationDivId){
               // self.userLocation = self.$userLocationDivId.data('user_location');
               return this.$userLocationDivId.data('user_location');
            }else{
                console.log('Need to determine again');
                return false;
            }
        },


        setUserLocation:function(userLocation){
            if(userLocation){
                this.userLocation=userLocation;
            }else{
                this.userLocation=this.findUserLocation()
            }
        },

        initClick:function(){
            var self = this;

            self.map.on('click', function(e) {

                if(self.includeUserLocation && self.ghRouting.points.length < 1){
                    self.setUserLocation();
                    // Start from User Location
                    if(self.userLocation){
                        // user Location has been set so use it
                        console.log('user location is set');
                        self.ghRouting.addPoint(new GHInput(self.userLocation[1], self.userLocation[0]),0);
                    }else{
                        // user location has not been set so ask user to mark it;
                        console.log('user not set!');
                    }
                }

                var coordinate = e.coordinate;
                var latLng=ol.proj.transform(coordinate,'EPSG:3857','EPSG:4326');
                var lng = latLng[0];
                var lat = latLng[1];

                /*if(ghRouting.points.length > 1){
                 ghRouting.clearPoints();
                 if(ghRoutingLayer) {
                 ghRoutingLayer.getSource().clear();
                 }
                 }else{
                 ghRouting.addPoint(new GHInput(lat, lng));
                 }*/

                self.ghRouting.addPoint(new GHInput(lat, lng));
                self.createAndShowGHPoints(self.ghRouting);

                if (self.ghRouting.points.length > 1) {
                    self.calculateRoute();
                }
            });
        },
        removeOverlays:function(overlays){
            var self = this;
            for(i = 0;i<overlays.length;i++){
                self.map.removeOverlay(overlays[i]);
            }
        },
        createAndShowGHPoints:function(ghRouting){
            var self=this; var ghAssetBaseUrl=self.options.ghAssetBaseUrl;
            if(self.ghRoutingMarkers.length>0){
                self.removeOverlays(self.ghRoutingMarkers);
            }
            for(i= 0;i<self.ghRouting.points.length;i++){
                var count=i+1;
                switch (i){
                    case 0:
                        markerIcon = ghAssetBaseUrl + '/img/marker-icon-green.png';
                        break;
                    case (self.ghRouting.points.length-1):
                        markerIcon = ghAssetBaseUrl + '/img/marker-icon-red.png';
                        break;
                    default :
                        markerIcon = ghAssetBaseUrl + '/img/marker-icon-blue.png';
                        break;
                }

                var marker = new ol.Overlay({
                    position:ol.proj.transform([self.ghRouting.points[i].lng,self.ghRouting.points[i].lat],'EPSG:4326','EPSG:3857'),
                    positioning: 'center-center',
                    element: $('<div style="position: relative"><div style="display:inline;background:rgba(0, 192, 239, 0.97); -webkit-border-radius:20px;-moz-border-radius:10px;font-size: 11pt;color: white; font-weight: bold;text-shadow: black 0.1em 0.1em 0.2em;">'+count+'</div><img src="'+markerIcon+'" style="height:32px;width:auto;"></div>'),
                    stopEvent: false
                });
                self.ghRoutingMarkers.push(marker);
                self.map.addOverlay(marker);
            }
        }
    };
    $.fn.routing = function(options){
        return this.each(function(){
            var routing = Object.create(Routing);
            routing.init(options, this);
            routing.initGhRouting(routing.args);
            routing.initClick();
            ghr=routing;
        });
    };
    $.fn.routing.options={};

    var popUp = Class.extend({
        init:function(options){

        },
        createAndShow:function(args){
            element = (args.element)? args.element:'$(<div>Element not passed! Showing Default:</div>)';
            coordinate = (args.coordinate)? args.coordinate:undefined;
            layer = (args.layer)?args.layer:undefined;
            map=(args.map)?args.map:undefined;
        }
    });

}( jQuery,Class ));
