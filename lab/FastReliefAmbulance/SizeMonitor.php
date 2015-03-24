	<?php
	// @author :  Ayam
	include("pgconnection.php");
	//date_default_timezone_set('Australia/Melbourne');
	$query= "SELECT pg_relation_size('\"tracking\".location')";
	$exec=pg_query($connect_string,$query);
	$result=pg_fetch_row($exec);
	$Size=$result[0];
	if($Size > 8192) {
			$query= "COPY (SELECT * FROM \"tracking\".location) TO 'D:/FRA_backup_".date('Y-m-d')."_".time().".csv'";
			$exec=pg_query($connect_string,$query);
			$query2 = "Truncate Table \"tracking\".location";
			$exec=pg_query($connect_string,$query2);		
	}
	
	echo "The Size is \t". $Size . "\n";


?>