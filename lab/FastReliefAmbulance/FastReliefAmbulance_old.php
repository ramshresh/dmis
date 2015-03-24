<?php 
	session_start();
	if(!$_SESSION['authuser1'])
		header('location:index.php');
	if($_SESSION['authuser1']!=1)
		exit();
?>
<?php

//--@author: Ayam
	
	
   //header("Refresh: 5;url='FastReliefAmbulance.php'");  // AHILE LAI 5/5 SECONDS MA AUTOREFRESH HUNCHHA. KTA HO YESMA BICHAR GARA HAI..
//   require_once 'table.php'; 

	include("pgconnection.php");
   
	$query= 'SELECT COUNT(*) FROM "tracking".coordinates';
	$exec=pg_query($connect_string,$query);
	$result=pg_fetch_row($exec);	
	//$total_ambulances = $result[0];
	
	$longi=0;
	$lati=0;
	$query = 'SELECT * FROM "tracking".coordinates LEFT JOIN "tracking".drivers on "tracking".coordinates."device_id" = "tracking".drivers."IMEI" where "device_id" IN (SELECT "IMEI" FROM "tracking".drivers) ';
	//I HAVE DECIDED TO CREATE A TRIGGER 
	//I WILL EXPLAIN IT LATER
	//ARKO TRIGGER NI BANAKO CHHU FOR DELETING DHERAI PAST DATAS. WHENEVER TABLE EXCEEDS 200 MB, ALL THE RECORDS ARE DELETED AUTOMATICALLY
	$exec=pg_query($connect_string,$query);
?>


<html>
	<head>
		<title>Ambulence Tracking</title>
		<script src="http://openlayers.org/api/OpenLayers.js"></script>
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
					if($_SESSION['authuser1']==1){
						
					}
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
	
	
	


	<?php 
		$i=1;
		while($result=pg_fetch_row($exec)){
						
						$deviceID = $result[1];
						$AmbID = $result[11]==null?$i:$result[11];
						$longi = $result[2];
						$lati = $result[3];
						$speed = $result[4];
						$firstname = $result[5];
						$lastname = $result[6];
	?>
	
	
	

						//longit =<?php echo $longi;?>;
						//latit =<?php echo $lati;?>;
						longitude = parseFloat("<?php echo $longi;?>");
						latitude = parseFloat("<?php echo $lati;?>");
						dvID=<?php echo $deviceID;?>
//	/*



						var feature = new OpenLayers.Feature.Vector(
						new OpenLayers.Geometry.Point( longitude, latitude ).transform(epsg4326, projectTo), {description:'Ambulance No :<?php echo $AmbID;?></br>Device IMEI: <?php echo $deviceID;?><br/>Current Speed: <?php echo $speed;?><br/>Driver Name: <?php echo $firstname; echo " ".$lastname?><br/>Click <a target = "_blank" href = driver.php?id='+dvID+'>here</a> for Driver Info'} ,
						{externalGraphic: 'image/amb_black.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
						);    
					
		
						vectorLayer.addFeatures(feature);
//	*/	
	
	<?php 
		$i++;
		}
	?>
    

	
    map.addLayer(vectorLayer);
	vectorLayer.refresh();
	
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
      //feature.popup.closeOnMove = true;
      map.addPopup(feature.popup);
    }

    function destroyPopup(feature) {
      feature.popup.destroy();
      feature.popup = null;
    }
    
    map.addControl(controls['selector']);
    controls['selector'].activate();
	
	
</script>