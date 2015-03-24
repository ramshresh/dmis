<?php
	include("pgconnection.php");
	//$query= 'SELECT COUNT(*) FROM "tracking".coordinates';
	$driver_imei = $_REQUEST['id'];
	//echo $fname; 
	$query="DELETE FROM \"tracking\".drivers WHERE \"IMEI\" = '".$driver_imei."'";
	$exec=pg_query($connect_string,$query); 

	if( !$exec ){
		header("Location:searchResult.php?warning=1");
	}
	else{
		header("Location:searchResult.php?success=1");
	}
?>