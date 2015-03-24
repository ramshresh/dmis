<?php

	//Author@Aawesh Man Shrestha
	//Date 6/14/2014
	include("connectdb.php");
	mysql_select_db("tracking");
	//here will be the code to display the map
	//For now lets just display the data from ta database
	//later on we will feed these data to openlayesrs
	$query = "SELECT * FROM location";
	$results = mysql_query($query) or die(mysql_error());
	
	echo '<table align="center" border="10px solid" style="text-align:center;"><tr><th width="200">device_id</th><th width="200">latitude</th><th width="200">longitude</th><th width="200">speed</th></tr>';
	while($row = mysql_fetch_array($results)){
		$user_id = $row['device_id'];
		$latitude = $row['latitude'];
		$longitude = $row['longitude'];
		$speed = $row['speed'];
		echo '<tr><td>'.$user_id.'</td><td>'.$latitude.'</td><td>'.$longitude.'</td><td>'.$speed.'<td></tr>';
	}
	echo '</table>';

?>