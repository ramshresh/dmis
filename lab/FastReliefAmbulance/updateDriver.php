<?php
	include("pgconnection.php");

	$driver_imei = $_REQUEST['id'];
	$query="SELECT * FROM \"tracking\".drivers WHERE \"IMEI\" = '".$driver_imei."'";
	$exec=pg_query($connect_string,$query); 
	$result=pg_fetch_row($exec);
?>

<html>
	<head>
		<title>Search Result</title>
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
				<div id="bannerTabs" >
					<ul>
						<a href="FastReliefAmbulance.php"><li>Home</li></a>
						<a style="background-color: #bb4000;" href="search.php"><li>Search</li></a>
						<a href="adminPanel.php"><li>Admin Panel</li></a>
						<a href="logOut.php"><li>Log Out</li></a>
					</ul>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<div id="body">
			<form action = "updateCommit.php" method="post">
				<table align="center">
					<tr>
						<td style="float:left;width:100px;">Firstname        :</td> <td><input type = "text" name = "firstname" value = <?php echo $result[0]; ?> ></input> </td>
					</tr>
					<tr>
						<td>Lastname         :</td> <td><input type = "text" name = "lastname" value ="<?php echo $result[1]; ?>" ></input> </td>
					</tr>
					<tr>
						<td>Address          :</td> <td><input type = "text" name = "Address" value ="<?php echo $result[2]; ?>" ></input> </td>
					</tr>
					<tr>
						<td>Phone Number     :</td> <td><input type = "text" name = "phno" value = "<?php echo $result[3]; ?>" ></input> </td>
					</tr>
					<tr>
						<td>IMEI             :</td> <td><input type = "text" name = "IMEI" value = "<?php echo $result[4]; ?>" ></input> </td>
					</tr>
					<tr>
						<td>Gender           :</td> <td><input type = "text" name = "gender" value = "<?php echo $result[5]; ?>" ></input> </td>
					</tr>
					<tr>
						<td>Ambulance Number :</td> <td><input type = "text" name = "ANO" value = "<?php echo $result[6]; ?>" ></input> </td>
					</tr>
					<tr>
						<input type="hidden" name="hiddenIMEI" value="<?php echo $driver_imei; ?>" ></input> 
					</tr>
					<table align="center">
						<input type="submit" style="text-decoration:none;" class="button" value="Update" ></input>
					</table>
				</table>
			</form>
		</div>
	</body>
</html>

