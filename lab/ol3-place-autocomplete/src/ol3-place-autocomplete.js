/**
 * Created by girc on 2/5/15.
 */
function repoFormatResult(repo) {
    var markup = '<div class="row-fluid">' +
        '<div class="row">' + repo.properties.name + '</div>' +
        '<div class="row">'+
        repo.properties.osm_key +', '+ repo.properties.osm_value + ', '+ repo.properties.country +
        '</div>'+
        '<div class="row">'+
        'Longitude : ' + repo.geometry.coordinates[0] + ', ' +'Latitude  : ' + repo.geometry.coordinates[1] + '</div>' +
        '</div>';
    if (repo.description) {
        console.log(9);
        markup += '<div>' + repo.type + '</div>';
    }
    markup += '</div>';
    return markup;
}

function repoFormatSelection(repo) {
    return repo.properties.country+'-'+repo.properties.name;
}


(function($){

    /* Simple JavaScript Inheritance
     * By John Resig http://ejohn.org/
     * MIT Licensed.
     */
    // Inspired by base2 and Prototype

    var initializing = false, fnTest = /xyz/.test(function(){xyz;}) ? /\b_super\b/ : /.*/;

    // The base Class implementation (does nothing)
    this.Class = function(){};

    // Create a new Class that inherits from this class
    Class.extend = function(prop) {
        var _super = this.prototype;

        // Instantiate a base class (but only create the instance,
        // don't run the init constructor)
        initializing = true;
        var prototype = new this();
        initializing = false;

        // Copy the properties over onto the new prototype
        for (var name in prop) {
            // Check if we're overwriting an existing function
            prototype[name] = typeof prop[name] == "function" &&
            typeof _super[name] == "function" && fnTest.test(prop[name]) ?
                (function(name, fn){
                    return function() {
                        var tmp = this._super;

                        // Add a new ._super() method that is the same method
                        // but on the super-class
                        this._super = _super[name];

                        // The method only need to be bound temporarily, so we
                        // remove it when we're done executing
                        var ret = fn.apply(this, arguments);
                        this._super = tmp;

                        return ret;
                    };
                })(name, prop[name]) :
                prop[name];
        }

        // The dummy class constructor
        function Class() {
            // All construction is actually done in the init method
            if ( !initializing && this.init )
                this.init.apply(this, arguments);
        }

        // Populate our constructed prototype object
        Class.prototype = prototype;

        // Enforce the constructor to be what we expect
        Class.prototype.constructor = Class;

        // And make this class extendable
        Class.extend = arguments.callee;

        return Class;
    };


    var ReverseGeocode=Class.extend({
        init:function(elem,options){

            var self=this;
            self.data,self.error,self.lat,self.lon,self.addressValue,self.addressDisplay;
            self.options = $.extend({},$.fn.reverseGeocode.options,options);
            if(typeof elem=='object'){
                self.elem = elem;
            }else{self.elem = $('#'+elem);}
            self.$elem = $(elem);


            self.latId = self.options.latId;
            self.lonId = self.options.lonId;

            self.$latId = $('#'+self.latId);
            self.$lonId = $('#'+self.lonId);
            self.lat = (self.options.lat)?self.options.lat:self.$latId.val();
            self.lon = (self.options.lon)?self.options.lon:self.$lonId.val();

        },

        reverseGeocode:function(lon,lat){
            lon = (lon)?lon:this.lon;
            lat = (lat)?lat:this.lat;
            var self=this;
            self.lat= lat;self.lon=lon;

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
                    success:function(data,textStatus,jqXHR ){
                        self.data = data;
                        var revG = self.parseMapquestReverseGeocode(data);

                    },
                    error:function(jqXHR,textStatus,errorThrown ){
                        self.error = {status:'OK',
                            fullAddress:'',
                            jqXHR:jqXHR};

                    }
                }
            );
        },

        parseMapquestReverseGeocode:function(data){
            data =(data)?data:this.data;
            var self=this;
            self.data=data;
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

            self.addressValue=fullAddress;
            self.addressDisplay = fullAddress;
        }
    });
    $.fn.reverseGeocode=function(options){
        return this.each(function(){
            var rg = new ReverseGeocode(this,options);
            rg.reverseGeocode();
            $(this).data('ReverseGeocode',rg);
        });

    };
    $.fn.reverseGeocode.options={

        'latId':undefined,
        'lonId':undefined,
        'lat':undefined,
        'lon':undefined
    };

    /**
     * @exposes locationUpdated
     */
    var PlaceAutocomplete = {
        init: function (options, elem) {
            var self = this;
            self.options = $.extend({}, $.fn.placeAutocomplete.options, options);
            self.elem = elem;
            self.$elem = $(elem);
            self.inputId = self.options.inputId;
            self.btnReverseGeocodeId = self.options.btnReverseGeocodeId;
            self.latitudeId = self.options.latitudeId;
            self.longitudeId = self.options.longitudeId;
            self.placenameId = self.options.placenameId;
            self.sData,self.sLon,self.sLat,self.sName,self.sFeature,self.sId;
            //self.initJuiAutocomplete();

        },
        initJuiAutocomplete:function(){
            var self=this;
            $(self.elem).autocomplete({
                delay: 500,
                minLength: 3,
                source: function(request, response) {
                    $.getJSON("http://open.mapquestapi.com/nominatim/v1/search.php?format=json", {
                        // do not copy the api key; get your own at developer.rottentomatoes.com

                        q: request.term

                    }, function(data) {
                        // data is an array of objects and must be transformed for autocomplete to use
                        var array = data.error ? [] : $.map(data, function(m) {
                            return {
                                label: m.display_name,
                                lat : parseFloat(m.lat),
                                lon : parseFloat(m.lon),
                                url: m.icon
                            };
                        });
                        response(array);
                    });
                },
                search:function(event, ui){
                    var self=this;
                    $(self.elem).addClass('loadinggif');
                },
                response:function( event, ui ){
                    var self= this;
                    $(self.elem).removeClass('loadinggif');
                },
                focus: function(event, ui) {
                    // prevent autocomplete from updating the textbox
                    event.preventDefault();
                },
                select: function(event, ui) {
                    // prevent autocomplete from updating the textbox
                    event.preventDefault();
                    var position =ol.proj.transform(
                        [ui.item.lon,ui.item.lat], 'EPSG:4326', 'EPSG:3857'
                    );
                    map.getView().setCenter(position);
                    map.getView().setZoom(12);
                    // Adding overlay marker
                    map.addOverlay(new ol.Overlay({
                        position:position,
                        element:  $('<img src="http://localhost/girc/dmis/img/location.png" style="width:32px;height:auto;">')
                            .css({marginTop: '-200%', marginLeft: '-50%', cursor: 'pointer'})
                            .popover({
                                'placement': 'top',
                                'html': true,
                                'content':'<strong>'+ui.item.label+'</strong>'
                            })
                            .on('click', function (e) { $(".location-popover").not(this).popover('hide'); })
                    }));
                }
            });
            $(self.elem).autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                    .append( "<a>" + item.label + "</a></br>" )
                    .append( "<a>(" + item.lat +' '+item.lon + ")</a>" )
                    .appendTo( ul );
            };
            $(self.elem).autocomplete( "instance" )._renderMenu= function( ul, items ) {
                var that = this;
                $.each( items, function( index, item ) {
                    that._renderItemData( ul, item );
                });
                $( ul ).find( "li:odd" ).addClass( "odd" );
                $( ul ).find( "li:even" ).addClass( "even" );
            };
            $(self.elem).autocomplete( "instance" )._resizeMenu= function() {
                var ul = this.menu.element;
                ul.outerWidth(this.element.outerWidth());
            };
        }
    };
    $.fn.placeAutocomplete = function(options){

        return this.each(function () {
            var pAc = Object.create(PlaceAutocomplete);
            pAc.init(options, this);
        });
    };
    $.fn.placeAutocomplete.options = {
        latitudeId: '',
        longitudeId: '',
        placenameId: '',
        externalInputId:''
    };
})(jQuery);

/* Usage Instruction
 $("#<?php echo $id; ?>").placeAutocomplete({});
 */

/*
 // {{{ locationUpdatedHandler event handler
 function locationUpdatedHandler(e) {
 console.log(
 "Event subscriber on "+e.currentTarget.nodeName+", "
 +e.detail.time.toLocaleString()+": "+e.detail.latitude+": "+e.detail.longitude+": "+e.detail.self
 );
 }
 // listen for newMessage event
 document.addEventListener("locationUpdated", locationUpdatedHandler, false);
 //}}}./
 */



