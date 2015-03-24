<?php 
	session_start();
	if(!$_SESSION['authuser1'])
		header('location:index.php');
	if($_SESSION['authuser1']!=1)
		exit();
?>

<html>
	<head>
		<title> Change Password </title>
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
						<a style="background-color: #bb4000;" href="changePassword.php"><li>Admin Panel</li></a>
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
						<a style="background-color: #606060;" href="changePassword.php"><li>Change Password</li></a>
					</ul>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div style="clear:both;"></div>
			<div id="left_lower_header">
				<tr>
					<form action="changePasswordQuery.php" method='post' style="clear:both;">
						<table align="center">
							<tr>
								<td>
									Current Password
								</td>
								<td>
									<input type="password" name="currentPassword"  class="fancy">
								</td>
							</tr>
							<tr>
								<td>
									New Password
								</td>
								<td>
									<input type="password" name="newPasswordOne"  class="fancy">
								</td>
							</tr>
							<tr>
								<td>
									New Password
								</td>
								<td>
									<input type="password" name="newPasswordTwo"  class="fancy">
								</td>
							</tr>
						</table>
						<td>
							<input style="text-decoration:none;" class="button" type="submit" value="CHANGE PASSWORD" >
						</td>
					</form>
				</tr>
				<div id = "success">
					<p>
						<?php
							if( isset($_GET['success']) && $_GET['success'] == 1 ){				
								echo 'Password Change Successful';
							}
						?>
					</p>
				</div>
				<div id = "warning">
					<p>
						<?php
							if( isset($_GET['warningNoQuery']) && $_GET['warningNoQuery'] == 1 ){				
								echo 'Query Unsuccessful';
							}
							if( isset($_GET['warningInvalidPassword']) && $_GET['warningInvalidPassword'] == 1 ){				
								echo 'Invalid Password';
							}
							if( isset($_GET['warningNoMatch']) && $_GET['warningNoMatch'] == 1 ){				
								echo 'Passwords Do Not Match';
							}
							if( isset($_GET['warningLength']) && $_GET['warningLength'] == 1 ){				
								echo 'Password Length Less Than Six ';
							}
						?>
					</p>
				</div>
			</div>
		</div>	
		<div id="footer">
			<p> &copy 2014 Fast Relief Ambulance </p>
		</div>
	</body>
</html>