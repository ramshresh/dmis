<?php 

	session_start();
	if(!$_SESSION['authuser1'])
		header('location:index.php');
	if($_SESSION['authuser1']!=1)
		exit();
	
?>



<html>
	<head>
		<title>Ambulence Tracking</title>
		<script src="http://openlayers.org/api/OpenLayers.js"></script>
		<script language="javascript" type="text/javascript" src="jquery.js"></script>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
		<link rel="stylesheet" href="css/style_table.css" type="text/css"/>
		<link rel="stylesheet" href="css/style_button.css" type="text/css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
		<style>body { font-family: Ubuntu, sans-serif; }</style>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
		<!-- <script src="http://www.openstreetmap.org/openlayers/OpenStreetMap.js"></script> -->
	</head>
	
	<body>
		<div id = "top">
		</div>
		<div id="banner" >
			<div id="bannerAlign">
				<div id="bannerTabs" >
					<ul>
						<a style="background-color: #bb4000;" href="FastReliefAmbulance.php"><li>Home</li></a>
						<a href="search.php"><li>Search</li></a>
						<a href="adminPanel.php"><li>Admin Panel</li></a>
						<a href="logOut.php"><li>Log Out</li></a>
					</ul>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<table>
			<tr>
				<?php
				/*
					if($_SESSION['authuser1']==1){
						
					}
				*/	
				?>
			</tr>
		</table>
		
		<div style="width:auto; height:auto; border: 10px;" id="mapAmbulence"></div> 		<!-- THIS DIV LE MAP HOLD GARCHHA AND THIS ID NEEDS TO BE PASSED AS openlayers.MAP() KO ARGUMENT -->
		<div style="clear:both;"></div>
		<div id="footer">
			<p> &copy 2014 Fast Relief Ambulance </p>
		</div>
	</body>

</html>

<script>
	var map = new OpenLayers.Map('mapAmbulence');
	map.addLayer(new OpenLayers.Layer.OSM());
	var lonLat = new OpenLayers.LonLat( 85.3333 ,27.7000 )
          .transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            map.getProjectionObject() // to Spherical Mercator Projection
          );
	
	var zoom=11;
	map.setCenter (lonLat, zoom);
	
	var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
	var epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
    var projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)
	var longitude;
	var latitude;
	var deviceID;
	var AmbID;
	var longi;
	var lati;
	var speed;
	var firstname;
	var lastname;
	var feature;
	var status;
	var status_readable;
	
	//**************************************************AJAX SUPPORT YAHA CHHA HAI *******************************************************************************//
	
	var jsonData;
	function loade() 
	{
	
	
		$.ajax({                                      
		url: 'markers.php',                         
		data: "",                       
		dataType: 'json',                 
		success: function(data)         
		{
			
			
			//map.removeLayer(vectorLayer);
		
			jsonData=data;
			var i;
			i=data.length;
			while(i>0){
		
				var j;
				var tempI=i-1;
			

						//DATAS - YAHA CHHA HAI POSTGRESQL KO DATA------------
							deviceID = data[tempI][1];
							AmbID = data[tempI][11]==null?i:data[tempI][11];
							longi = data[tempI][2];
							lati = data[tempI][3];
							speed = data[tempI][4];
							firstname = data[tempI][5];
							lastname = data[tempI][6];
							status = data[tempI][13];
							if(status == "1"){
							status_readable='Available';
							}
							else if (status == "0"){
							status_readable='Busy';
							}
							else{
							status_readable='Not Set';
							}
							longitude = parseFloat(longi);	
							latitude = parseFloat(lati);						
						//---------------------------------------------------
					
						//MARKERS -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

							feature = new OpenLayers.Feature.Vector(
							new OpenLayers.Geometry.Point( longitude, latitude ).transform(epsg4326, projectTo), {description:'Ambulance No :'+AmbID+'</br>Status: '+status_readable+'</br>Device IMEI: '+deviceID+'<br/>Current Speed: '+speed+'<br/>Driver Name: '+firstname+' '+lastname+'<br/>Click <a target = "_blank" href = driver.php?id='+deviceID+'>here</a> for Driver Info'} ,
							{externalGraphic: 'image/amb_black.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
							);    
					
		
							vectorLayer.addFeatures(feature);
							//vectorLayer.refresh();
						//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------	
							
				i=i-1;
			}
		} 
		});

	}
	map.addLayer(vectorLayer);



  setInterval( function(){
  
   while( map.popups.length ) {
         map.removePopup(map.popups[0]);
    }
  loade();
  vectorLayer.removeAllFeatures();
  vectorLayer.refresh();
  map.removeLayer(vectorLayer);
  map.addLayer(vectorLayer);
 
}, 5000 );
	
	//************************************************************************************************************************************************************//
	
	
	 var controls = {
      selector: new OpenLayers.Control.SelectFeature(vectorLayer, { onSelect: createPopup, onUnselect: destroyPopup })
    };

    function createPopup(feature) {
      feature.popup = new OpenLayers.Popup.FramedCloud("pop",
          feature.geometry.getBounds().getCenterLonLat(),
          null,
          feature.attributes.description,
          null,
          true,
          function() { controls['selector'].unselectAll(); }
      );
      feature.popup.closeOnMove = true;
      map.addPopup(feature.popup);
    }

    function destroyPopup(feature) {
      feature.popup.destroy();
      feature.popup = null;
    }
    
    map.addControl(controls['selector']);
    controls['selector'].activate();
	
	
</script>