<?php 
	session_start();
	if(!$_SESSION['authuser1'])
		header('location:index.php');
	if($_SESSION['authuser1']!=1)
		exit();
?>

<html>
	<head>
		<title>
			Search Driver
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
			<h1>Search Driver</h1>
			<form action="searchResult.php" method="post">
				<table align = "center"> 	
					<tr>
						<td style="float:left;width:80px;">Firstname</td><td><input type="text" name="firstname"></td>
					</tr>
					<tr>
						<td style="float:left;">Lastname</td><td><input type="text" name="lastname"/></td>
					</tr>
				</table align = "center">
				<table align = "center">
					<tr>
						<td><input style="text-decoration:none;" class="button" type="submit" value="Search" /><br>
					</tr>
				</table>
			</form>
		</div>
		<div id="footer">
			<p> &copy 2014 Fast Relief Ambulance </p>
		</div>
	</body>
</html>
