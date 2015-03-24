<?php
	//Author@Ayam Pokhrel
	//Date 6/14/2014
	
	//include("createdb.php");
	//include("pgconnection.php");
	include("SizeMonitor.php");
	
	$device_id = $_POST['device_id'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$speed = $_POST['speed'];
	$status =  $_POST['status'];
	$insert = "INSERT INTO \"tracking\".location(device_id,latitude,longitude,speed) VALUES('$device_id','$latitude','$longitude',$speed)";
	$results=pg_query($connect_string,$insert);
	//$statusToBeInserted = $status=="1"?"yes":"no";
	//$insert = "INSERT INTO \"tracking\".A_Status(IMEI,status) VALUES('$device_id','$statusToBeInserted')";
	$update = "UPDATE tracking.\"A_Status\" SET status = '$status' WHERE \"IMEI\"='$device_id'";
	$result=pg_query($connect_string,$update);
?>
