<?php
	include("pgconnection.php");

	$fname = $_POST['firstname'];
	$lname= $_POST['lastname'];
	$Address= $_POST['Address'];
	$Phonr= $_POST['phno'];
	$IMEI= $_POST['IMEI'];
	$Gen= $_POST['gender'];
	$ano= $_POST['ANO'];
	
	$decide = true;
	if( empty($fname) ){
		header("Location:register.php?warningFName=1");
		$decide = false;
	}
	if( empty($lname) ){
		header("Location:register.php?warningLName=1");
		$decide = false;
	}
	if( empty($Address) ){
		header("Location:register.php?warningAddress=1");
		$decide = false;
	}
	if( empty($Phonr) ){
		header("Location:register.php?warningPhonr=1");
		$decide = false;
	}
	if( empty($IMEI) ){
		header("Location:register.php?warningIMEI=1");
		echo $IMEI;
		$decide = false;
	}
	if( empty($ano) ){
		header("Location:register.php?warningIMEI=1");
		echo $ano;
		$decide = false;
	}
	
	if( $decide == true ){
		$query="INSERT INTO \"tracking\".drivers 
		VALUES
		( '".$fname."' ,'".$lname."', '".$Address."', '".$Phonr."', '".$IMEI."', '".$Gen."' , '".$ano."')";
		$exec=pg_query($connect_string,$query); 
                $commit=pg_query($connect_string,"COMMIT");
		if( !$exec ){
			header("Location:register.php?warning=1");
		}
		else{
			
			header("Location:register.php?success=1");
		}
	}
?>
