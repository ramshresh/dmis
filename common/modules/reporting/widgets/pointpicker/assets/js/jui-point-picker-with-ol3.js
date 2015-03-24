//
// Create map
//
    var map = new ol.Map({
        controls: ol.control.defaults({
            attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
                collapsible: false
            })
        }),
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        target: 'map',
        view: new ol.View({
            center: [0, 0],
            zoom: 2
        })
    });
    pp=new app.PointPickerControl({
        containerId:"ol3_pp_container_1"
    });
    
    map.addControl(pp);
    pp.init();
    map.addControl(new ol.control.FullScreen());
   

   

     



