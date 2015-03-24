<?php
	include("pgconnection.php");

	$currentPassword = mysql_real_escape_string($_POST['currentPassword']);
	$newPasswordOne = mysql_real_escape_string($_POST['newPasswordOne']);
	$newPasswordTwo = mysql_real_escape_string($_POST['newPasswordTwo']);
	
	$query = "SELECT \"password\" FROM tracking.\"user\" WHERE password = '".$currentPassword."'";
	$exec = pg_query($connect_string,$query);
	
	if( !$exec ){
		header('location:changePassword.php?warningNoQuery=1');
	}
	else{
		$result = pg_fetch_row($exec);
		$numberOfRows = pg_num_rows($exec);
		
		if( $numberOfRows == 0 ){
			header('location:changePassword.php?warningInvalidPassword=1');
		}
		else{
			if( $newPasswordOne == $newPasswordTwo ){
				echo strlen($newPasswordOne);
				if( strlen( $newPasswordOne ) > 6 ){
					$query = "UPDATE tracking.\"user\" SET \"password\"= '".$newPasswordOne."' WHERE \"password\" = '".$currentPassword."'";
					$exec = pg_query($connect_string, $query);
					
					if( !$exec ){
						header('location:changePassword.php?warningNoQuery=1');
					}
					else{
						header('location:changePassword.php?success=1');
					}
				}
				else{
					header('location:changePassword.php?warningLength=1');
				}
			}
			else{
				header('location:changePassword.php?warningNoMatch=1');
			}
		}
	}
 ?>