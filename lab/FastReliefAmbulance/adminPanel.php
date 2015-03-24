<?php 
	session_start();
	if(!$_SESSION['authuser1'])
		header('location:index.php');
	if($_SESSION['authuser1']!=1)
		exit();
?>

<html>
	<head>
		<title> Admin Panel </title>
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
						<a href="search.php"><li>Search</li></a>
						<a style="background-color: #bb4000;" href="adminPanel.php"><li>Admin Panel</li></a>
						<a href="logOut.php"><li>Log Out</li></a>
					</ul>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		
		<div id="body">
			<div style="clear:both;"></div>
			<div id="bannerAdminPanel">
				<div id="bannerTabsAdminPanel" >
					<ul>
						<a style="background-color: #C8C8C8;" href="register.php"><li>Register</li></a>
						<a style="background-color: #C8C8C8;" href="changePassword.php"><li>Change Password</li></a>
					</ul>
					<div style="clear:both;"></div>
				</div>
			</div>
			<p>	
				Welcome To Admin Panel
			</p>
		</div>
		<div id="footer">
			<p> &copy 2014 Fast Relief Ambulance </p>
		</div>
	</body>
</html>