<?php 
	session_start();
	if(!$_SESSION['authuser1'])
		header('location:index.php');
	if($_SESSION['authuser1']!=1)
		exit();
?>

<?php
	// @author :  Ayam
	include("pgconnection.php");
	$driver_id = $_REQUEST['id'];

	$query= 'SELECT * FROM "tracking".drivers where "IMEI" = '."'".$driver_id."'";
	$exec=pg_query($connect_string,$query);
	$result=pg_fetch_row($exec);
	$firstname=$result[0];
	$lastname=$result[1];
	$address=$result[2];
	$phone=$result[3];
	$imei=$result[4];
	$gender=$result[5];
	/*
	echo "Here is the driver IMEI no ".$driver_id."\n";
	echo "DON'T KNOW THE EXACT DATA RECEIVED FROM ANDROID </BR>";
	echo "<BR> So , THE CONCEPT IS , IMEI NO IS PASSED AS GET/POST VARIABLE TO THIS PAGE AND DRIVER INFO IS DISPLAYED ACCORDINGLY </BR>";
	*/

?>

<html>
	<head>
		<title>
			FAST RELIEF AMBULANCE
		</title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
		<link rel="stylesheet" href="css/style_table.css" type="text/css"/>
		<link rel="stylesheet" href="css/style_button.css" type="text/css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
		<style>body { font-family: Ubuntu, sans-serif; }</style>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
	</head>
	
	<body>
		<div id = "top">
		</div>
		<div id="banner" >
			<div id="bannerAlign">
				<div id="bannerTabs" align="right" >
					<ul>
						<a href="FastReliefAmbulance.php"><li>Home</li></a>
						<a href="search.php"><li>Search</li></a>
						<a href="adminPanel.php"><li>Admin Panel</li></a>
						<a href="logOut.php"><li>Log Out</li></a>
					</ul>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div id="body">
			<div style="clear:both;"></div>
			<h1>Driver Details</h1>
			<div align= "center" id="table">
				<form align="center" action="FastReliefAmbulance.php" method='post' style="clear:both; margin-top:20px;">
					<table border= 0>
						<tr>
							<td style="width:93px;">
								<p>Firstname</p>
							</td>
							<td>
								<?php
									echo ": ".$firstname ;
								?>
							</td>
						</tr>
						
						<tr>
							<td>
								<p>Lastname</p>
							</td>
							<td>
								<?php
									echo ": ".$lastname ;
								?>
							</td>
						</tr>
							
						<tr>
							<td>
								<p>Address</p>
							</td>
							<td>
								<?php
									echo ": ".$address ;
								?>
							</td>
						</tr>
						<tr>
							<td>
								<p>Phone No</p>
							</td>
							<td>
								<?php
									echo ": ".$phone ;
								?>
							</td>
						</tr>
						<tr>
							<td>
								<p>IMEI No</p>
							</td>
							<td>
								<?php
									echo ": ".$imei ;
								?>
							</td>
						</tr>
						<tr>
							<td>
								<p>Gender</p>
							</td>
							<td>
								<?php
									echo ": ".$gender ;
								?>
							</td>
						</tr>
					
					</table>				
				</form>
			</div>
			<div>
				
			</div>
		</div>
		<div style="clear:both;"></div>
		<div id="body">
				
		</div>
		<div style="clear:both;"></div>
		<div id="footer">
			<p> &copy 2014 Fast Relief Ambulance </p>
		</div>
	</body>
</html>