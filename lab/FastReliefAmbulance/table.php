<?php
// @author :  Ayam 

	$dc=mysql_connect('localhost','root','') or die("UNABLE TO CONNECT");
	$con= 'CREATE DATABASE IF NOT EXISTS coordinates';

	mysql_query($con,$dc) or die(mysql_error($dc));
	mysql_select_db('coordinates',$dc) or die(mysql_error($dc));


	$con= 'CREATE TABLE IF NOT EXISTS location(
		id				int  	NOT NULL  AUTO_INCREMENT,
		longitude		float	NOT NULL,
		latitude		float	NOT NULL,
		PRIMARY KEY(id)
		) AUTO_INCREMENT=1 ';
		
	mysql_query($con,$dc) or die(mysql_error($dc));

?>



	
	