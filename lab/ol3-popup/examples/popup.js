var view = new ol.View({
    center: ol.proj.transform([-0.92, 52.96], 'EPSG:4326', 'EPSG:3857'),
    zoom: 1
});
map = new ol.Map({
    target: 'map',
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],
    view: view
});

var reportitems_all = new ol.layer.Tile(
    {
        'name': 'Report Items',
        'source': new ol.source.TileWMS(
            ({
                //   url: 'http://localhost:8080/geoserver/wms',
                url: 'http://116.90.239.21:8080/geoserver/wms',
                params: {
                    'LAYERS': 'dmis:reportitems_all', 'TILED': true
                    //   params: {'LAYERS': 'fra:ambulance', 'TILED': true
                    //'cql_filter':"subcategory='trapped'"
                    //        'STYLES':'disaster_hazard'
                    //    'SLD' :'styles/all_feature_style.sld'

                },
                //styles:"",
                serverType: 'geoserver'
                //   request:'GetMap'

            }))
    }
);

//http://116.90.239.21:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:reportitems_all&maxFeatures=50&outputFormat=text%2Fjavascript

var reportitems_all_clickHandler = function (evt) {


    tilewmsSource = reportitems_all;
    viewResolution = view.getResolution();
    viewProjection = view.getProjection();
    //  console.log(evt.coordinate);
    var url = tilewmsSource.getSource().getGetFeatureInfoUrl(
        evt.coordinate, viewResolution, viewProjection,
        {
            'INFO_FORMAT': 'text/javascript'
            //   'propertyName': 'status',''
        });

    if (url) {
        var parser = new ol.format.GeoJSON();
        $.ajax({
            url: url,
            dataType: 'jsonp',
            jsonpCallback: 'parseResponse'
        }).then(function (response) {
            var result = parser.readFeatures(response);
            //console.log(result);

            if (result.length) {
                var popupContent = '';
                for (var i = 0, ii = result.length; i < ii; ++i) {
                    var values = result[i].values_;
                    console.log(values);
                    console.log(result[i].values_.reportitem_item_name);
                    console.log(result[i].values_.reportitem_subtype_name);
                    console.log(result[i].values_.reportitem_timestamp_created);
                    console.log(result[i].values_.reportitem_is_verified);
                    isVerified = undefined;

                    popupContent = values.reportitem_item_name;
                    popupContent += '(' + values.reportitem_subtype_name + ')';


                    switch (values.reportitem_type) {
                        case 0:

                            break;
                        case 1:
                            if (values.event_timestamp_occurance)
                                popupContent += '<br> time: ' + String(values.event_timestamp_occurance);
                            break;
                        case 2:

                            break;
                        case 3:
                            if (values.damage_quantity)
                                popupContent += '<br> ' + String(values.damage_quantity);
                            if (values.damage_units_shortname)
                                popupContent += ' ' + String(values.damage_units_shortname);
                            break;
                        case 4:
                            if (values.need_quantity)
                                popupContent += '<br> ' + String(values.need_quantity);
                            if (values.need_units_shortname)
                                popupContent += ' ' + String(values.need_units_shortname);
                            break;
                        default :
                            break;
                    }
                    if (values.reportitem_is_verified) {
                        isVerified = 'verified'
                    } else {
                        isVerified = 'not verified'
                    }
                    popupContent += '<br>' + isVerified;

                }
                ////container.innerHTML = info.join(', ');
                popup.show(evt.coordinate, popupContent);
            } else {
                //popup.show(evt.coordinate, 'Nothing to show!');
                //container.innerHTML = '&nbsp;';
            }
        });
    }
};

map.addLayer(reportitems_all);

var popup = new ol.Overlay.Popup();
map.addOverlay(popup);

/*
 map.on('click', function(evt) {
 //  console.log(evt.coordinate);
 var url = tilewmsSource.getGetFeatureInfoUrl(
 evt.coordinate, viewResolution, viewProjection,
 {'INFO_FORMAT': 'text/javascript'
 //   'propertyName': 'status',''
 });
 if (url) {
 var parser = new ol.format.GeoJSON();
 $.ajax({
 url: url,
 dataType: 'jsonp',
 jsonpCallback: 'parseResponse'
 }).then(function(response) {
 var result = parser.readFeatures(response);
 if (result.length) {
 var info = [];
 for (var i = 0, ii = result.length; i < ii; ++i) {
 //    info.push(result[i].get('status'));
 console.log(result[i].values_.reportitem_item_name);
 }
 container.innerHTML = info.join(', ');
 } else {
 container.innerHTML = '&nbsp;';
 }
 });
 }
 });
 */


map.on('click', reportitems_all_clickHandler);


//map.on('click', function(evt) {

//{{{ CASE I: Display Latitude and Longitude
//    var prettyCoord = ol.coordinate.toStringHDMS(ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326'), 2);
//   var htmlMarkupCase1 ='<div><h2>Coordinates</h2><p>' + prettyCoord + '</p></div>';
//   popup.show(evt.coordinate, htmlMarkupCase1);
//}}} ./CASE I: Display Latitude and Longitude


//{{{ CASE 2: Geoserver Layers Details: dmis:reportitems_all
//  console.log(evt.coordinate);
/*var url = tilewmsSource.getGetFeatureInfoUrl(
 evt.coordinate, viewResolution, viewProjection,
 {'INFO_FORMAT': 'text/javascript'
 //   'propertyName': 'status',''
 });
 if (url) {
 var parser = new ol.format.GeoJSON();
 $.ajax({
 url: url,
 dataType: 'jsonp',
 jsonpCallback: 'parseResponse'
 }).then(function(response) {
 var result = parser.readFeatures(response);
 if (result.length) {
 var info = [];
 for (var i = 0, ii = result.length; i < ii; ++i) {
 //    info.push(result[i].get('status'));
 console.log(result[i].values_.reportitem_item_name);
 }
 container.innerHTML = info.join(', ');
 } else {
 container.innerHTML = '&nbsp;';
 }
 });
 }*/
//}}} ./CASE 2: Geoserver Layers Details: dmis:reportitems_all
//});

