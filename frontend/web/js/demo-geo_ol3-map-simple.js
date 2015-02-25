(function($){
    function init() {

        // Create a map
        map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                }),

            ],
            view: new ol.View({
                zoom: 7,
                center:ol.proj.transform([87, 28], 'EPSG:4326', 'EPSG:3857'),
                projection:'EPSG:3857'
            }),
            controls: ol.control.defaults().extend([
                new ol.control.ScaleLine(),
                new ol.control.FullScreen(),
                new ol.control.ZoomSlider()
            ])
        });
        var parseMapquestReverseGeocode = function(data) {
            var location = data.results[0].locations[0];
            var fullAddress = '';
            var comp = [];
            if (location.adminArea6) {
                comp.push(location.adminArea6);
            }
            if (location.street) {
                comp.push(location.street);
            }
            if (location.adminArea5) {
                comp.push(location.adminArea5);
            }
            if (location.adminArea6) {
                comp.push(location.adminArea4);
            }
            if (location.adminArea3) {
                comp.push(location.adminArea3);
            }
            if (location.adminArea2) {
                comp.push(location.adminArea2);
            }
            if (location.adminArea1) {
                comp.push(location.adminArea1);
            }
            for (i = 0; i < comp.length; i++) {
                if (i == 0) {
                    fullAddress += comp[i];
                } else {
                    fullAddress += ',' + comp[i];
                }
            }
            console.log(fullAddress);
            return {
                status: 'OK',
                fullAddress: fullAddress
            };
        };
        var reverseGeocode = function(lon, lat) {
            var self = this;
            var lat = lat;
            var lon = lon;
            ////http://www.mapquestapi.com/geocoding/v1/reverse?key=Fmjtd|luur20a729%2Cb0%3Do5-9a15qr&callback=renderReverse&location=27.7067577,85.3153407
            $.ajax(
                'http://www.mapquestapi.com/geocoding/v1/reverse?', {
                    dataType: 'jsonp',
                    jsonpCallback: 'fnCallbackSuccess',
                    jsonp: 'callback',
                    data: {
                        key: 'Fmjtd|luur20a729%2Cb0%3Do5-9a15qr',
                        location: lat + ',' + lon
                    },

                    success: function(data) {
                        var fullAddress = parseMapquestReverseGeocode(data);
                        $("#iplacename").val(fullAddress.fullAddress);

                    },

                    error: function(jqXHR, textStatus, errorThrown) {
                        return {
                            status: 'OK',
                            fullAddress: '',
                            jqXHR: jqXHR
                        }

                    }
                }
            )
        };

        var pickPointHandler = function(evt) {
            var temp_coor = evt.coordinate;
            var coordinate = ol.proj.transform(temp_coor, 'EPSG:3857', 'EPSG:4326');
            ilon = coordinate[0].toFixed(5);
            ilat = coordinate[1].toFixed(5);
            var style = new ol.style.Style({
                symbolizers: [
                    new ol.style.Icon({
                        url: 'icons/activity_assessment_32px_icon.png'
                    })
                ]
            });
            // Vienna marker
            var marker = new ol.Overlay({
                position: temp_coor,
                positioning: 'center-center',
                element: document.getElementById('marker'),
                stopEvent: false
            });
            map.addOverlay(marker);

            $("#ilon").val(ilon);
            $("#ilat").val(ilat);
            reverseGeocode(ilon, ilat);
        }

        map.on('click', pickPointHandler);

        //    var layerSwitcher = new ol.control.LayerSwitcher();
        //    map.addControl(layerSwitcher);
        $('#map').data('map',map);
    }
    init();
})(jQuery);
