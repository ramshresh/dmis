
<?php
$jsPosReady=<<<SCRIPT
	var search_amenities = function(amenity){	
			$.ajax({
               // url: 'http://nominatim.openstreetmap.org/search?format=json&q='+amenity+'%20near%20['+geo_lat+','+geo_lon+']&limit=10'
                url: 'http://nominatim.openstreetmap.org/search?format=json&q='+amenity+'%20near%20[27.70,85.32]&limit=10'
            //    url: 'http://nominatim.openstreetmap.org/search?format=json&q=hospital%20near%20[27.70,85.32]&limit=10'
                //	async : false
            }).then(function(response) {
                amenities = response;
                //  console.log(amenities);

                hospitals = '';
                var trHTML = '<thead><tr><th>Amenity</th>' + '<th>Type</th><th>Location</th><th>Route</th>'+ '</tr></thead>';
                $.each(amenities, function(index, value) {
                    var latitude = value.lat;
                    var longitude = value.lon;
                    console.log(latitude);
                    console.log(longitude);

                    var loc_function = function() {
                        try {

                            //	var latitude = value.lat;
                            //var longitude = value.lon;

                            zoom = function(_long, _lat) {
                                var pos = ol.proj.transform([parseFloat(_long), parseFloat(_lat)], 'EPSG:4326', 'EPSG:3857');
                                map.getView().setCenter(pos);
                                map.getView().setZoom(16);

                                try {
                                    //map.removeOverlay(marker);
                                    map.getOverlays().clear();
                                    //alert("hello");
                                } catch (err) {
                                    alert("Marker not available");
                                }

                                var marker = new ol.Overlay({
                                    position: pos,
                                    positioning: 'center-center',
                                    element: $('<img src="png/location.png" style="height:32px;width:auto;">'),
                                    stopEvent: false
                                });
                                map.addOverlay(marker);



                            }
                            //	final_button = '<button class="btn btn-primary" onclick="zoom('+longitude+','+latitude+')"></button>';
                            final_button = '<div style="margin-top:10px;"><icon class="icon-location" onclick="zoom(' + longitude + ',' + latitude + ')"></icon></div>';

                        } catch (err) {
                            final_button = '';
                            //alert(err.message);
                        }

                        return final_button;
                    }
                    //	console.log(value.display_name);
                    trHTML += '<tr><td>' + value.display_name + '</td><td>' + value.type + '</td><td>' + loc_function()
							+'</td><td>'+'<icon class="icon-routing"></icon>'
							+ '</td></tr>';
                })

                $('#amenity_table').append(trHTML);
                //console.log(response[0].display_name);
            })
			
    }
	search_amenities('hospital');
	$('#radio-amenity input').on('change', function() {
				table_ = document.getElementById('amenity_table');
				table_.innerHTML='';
		   amenity = $('input[name="options"]:checked', '#radio-amenity').val(); 
		   search_amenities(amenity);	
		
		});
SCRIPT;

$this->registerJs($jsPosReady,$this::POS_READY);
?>




 <!--   <script>
        $(document).ready(function() {
		//var search_amenities = function(geo_lat,geo_lon,amenity){	
		var search_amenities = function(amenity){	
			$.ajax({
               // url: 'http://nominatim.openstreetmap.org/search?format=json&q='+amenity+'%20near%20['+geo_lat+','+geo_lon+']&limit=10'
                url: 'http://nominatim.openstreetmap.org/search?format=json&q='+amenity+'%20near%20[27.70,85.32]&limit=10'
            //    url: 'http://nominatim.openstreetmap.org/search?format=json&q=hospital%20near%20[27.70,85.32]&limit=10'
                //	async : false
            }).then(function(response) {
                amenities = response;
                //  console.log(amenities);

                hospitals = '';
                var trHTML = '<thead><tr><th>Amenity</th>' + '<th>Type</th><th>Location</th><th>Route</th>'+ '</tr></thead>';
                $.each(amenities, function(index, value) {
                    var latitude = value.lat;
                    var longitude = value.lon;
                    console.log(latitude);
                    console.log(longitude);

                    var loc_function = function() {
                        try {

                            //	var latitude = value.lat;
                            //var longitude = value.lon;

                            zoom = function(_long, _lat) {
                                var pos = ol.proj.transform([parseFloat(_long), parseFloat(_lat)], 'EPSG:4326', 'EPSG:3857');
                                map.getView().setCenter(pos);
                                map.getView().setZoom(16);

                                try {
                                    //map.removeOverlay(marker);
                                    map.getOverlays().clear();
                                    //alert("hello");
                                } catch (err) {
                                    alert("Marker not available");
                                }

                                var marker = new ol.Overlay({
                                    position: pos,
                                    positioning: 'center-center',
                                    element: $('<img src="png/location.png" style="height:32px;width:auto;">'),
                                    stopEvent: false
                                });
                                map.addOverlay(marker);



                            }
                            //	final_button = '<button class="btn btn-primary" onclick="zoom('+longitude+','+latitude+')"></button>';
                            final_button = '<div style="margin-top:10px;"><icon class="icon-location" onclick="zoom(' + longitude + ',' + latitude + ')"></icon></div>';

                        } catch (err) {
                            final_button = '';
                            //alert(err.message);
                        }

                        return final_button;
                    }
                    //	console.log(value.display_name);
                    trHTML += '<tr><td>' + value.display_name + '</td><td>' + value.type + '</td><td>' + loc_function()
							+'</td><td>'+'<icon class="icon-routing"></icon>'
							+ '</td></tr>';
                })

                $('#amenity_table').append(trHTML);
                //console.log(response[0].display_name);
            })
			
    }
	search_amenities('hospital');
	$('#radio-amenity input').on('change', function() {
				table_ = document.getElementById('amenity_table');
				table_.innerHTML='';
		   amenity = $('input[name="options"]:checked', '#radio-amenity').val(); 
		   search_amenities(amenity);	
		
		});
        })
    </script>
    -->
	<div class="row">
        <div class="col-md-12">
		<label>Select Amenity</label>
		<div class="btn-group input-group btn-group-justified" id="radio-amenity" data-toggle="buttons">		
                <label class="btn btn-primary active">
                    <input type="radio" name="options" id="health_facility" autocomplete="off" value="hospital" checked>Health Facility
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="options" id="police_station" autocomplete="off" value="police">Police Station
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="options" id="camp" autocomplete="off" value="shelter">Shelter
                </label>
            </div>
        </div>
    </div>
<hr style="border-heigt:1px;border-color:rgba(57,52,86,0.8)">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover" id="amenity_table">
                    <tbody id="myTable"></tbody>
                </table>
            </div>
        </div>
    </div>