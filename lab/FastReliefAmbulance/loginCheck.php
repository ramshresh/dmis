<?php
	session_start();
	include("pgconnection.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = "SELECT \"password\", \"username\" FROM tracking.\"user\" WHERE username = '".$username."' and password = '".$password."'";
	$exec=pg_query($connect_string,$query);
	$rows = pg_num_rows($exec);

	if(!$exec){
		$_SESSION['authuser1'] = 0;
		header("Location:index.php?warning=1");
	}
	else if( $rows == 0 ){
		$_SESSION['authuser1'] = 0;
		header("Location:index.php?warning=2");
	}
	else{
		$_SESSION['authuser1'] = 1;
		header("Location:FastReliefAmbulance.php");
	}
?>