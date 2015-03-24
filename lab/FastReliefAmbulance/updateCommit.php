<?php
	include("pgconnection.php");
	echo "<h1>I am Running</h1>";
	$fname = $_POST['firstname'];
	$lname= $_POST['lastname'];
	$Address= $_POST['Address'];
	$Phonr= $_POST['phno'];
	$IMEI= $_POST['IMEI'];
	$Gen= $_POST['gender'];
	$ano= $_POST['ANO'];
	$hidden_IMEI = $_REQUEST['hiddenIMEI'];
	echo "<h1>I am NOT Running</h1>";
	$decide = true;
	if( empty($fname) ){
		header("Location:updateDriver.php?warningFName=1");
		$decide = false;
	}
	if( empty($lname) ){
		header("Location:updateDriver.php?warningLName=1");
		$decide = false;
	}
	if( empty($Address) ){
		header("Location:updateDriver.php?warningAddress=1");
		$decide = false;
	}
	if( empty($Phonr) ){
		header("Location:updateDriver.php?warningPhonr=1");
		$decide = false;
	}
	if( empty($IMEI) ){
		header("Location:updateDriver.php?warningIMEI=1");
		echo $IMEI;
		$decide = false;
	}
	if( empty($ano) ){
		header("Location:updateDriver.php?warningIMEI=1");
		echo $ano;
		$decide = false;
	}
	
	if( $decide == true ){
		
		$query = "UPDATE tracking.drivers SET \"Firstname\"='".$fname."', \"Lastname\"='".$lname."', \"Address\"='".$Address."', \"Phonr\"='".$Phonr."', \"IMEI\"='".$IMEI."', \"Gender\"='".$Gen."', \"Ambulance_Number\"='".$ano."' WHERE \"IMEI\"='".$hidden_IMEI."'";
		$exec=pg_query($connect_string,$query); 
		
		
		/*
		if( !$exec || $exec2){
			header("Location:register.php?warning=1");
		}
		else{
			
			header("Location:register.php?success=1");
		}
		*/
		if($exec){
			header("Location:searchResult.php");
		}
		else{
			echo "Update Unsuccessful";
		}
	}
?>
