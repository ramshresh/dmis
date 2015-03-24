<?php
	//Author@Aawesh Man Shrestha
	//Date 6/14/2014
	$create=mysql_query("CREATE DATABASE IF NOT EXISTS tracking") or die (mysql_error());
	mysql_select_db("tracking");

	$location="CREATE TABLE IF NOT EXISTS location (
	device_id VARCHAR(255) NOT NULL,
	latitude varchar(255) NOT NULL,
	longitude varchar(255) NOT NULL,
	speed varchar(255) NOT NULL)";
	$results=mysql_query($location) or die(mysql_error());
?>
