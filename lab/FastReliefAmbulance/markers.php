<?php

//--@author: Ayam
	
	
   //header("Refresh: 5;url='FastReliefAmbulance.php'");  // AHILE LAI 5/5 SECONDS MA AUTOREFRESH HUNCHHA. KTA HO YESMA BICHAR GARA HAI..
	include("pgconnection.php");
   
	
	$longi=0;
	$lati=0;
	//$query = 'SELECT * FROM "tracking".coordinates LEFT JOIN "tracking".drivers on "tracking".coordinates."device_id" = "tracking".drivers."IMEI" where "device_id" IN (SELECT "IMEI" FROM "tracking".drivers) ';
	$query = 'SELECT * FROM "tracking".coordinates LEFT JOIN "tracking".drivers on "tracking".coordinates."device_id" = "tracking".drivers."IMEI" LEFT JOIN tracking."A_Status" on "tracking".coordinates."device_id" = tracking."A_Status"."IMEI" where "device_id" IN (SELECT "IMEI" FROM "tracking".drivers)';
	$exec=pg_query($connect_string,$query);
	/*
	$result=pg_fetch_row($exec);
	echo json_encode($result);
	*/
	
	while($result=pg_fetch_row($exec)){
		//$rows[]['data'] = $result;
		$rows[] = $result;
	}
	echo json_encode($rows);
	
?>