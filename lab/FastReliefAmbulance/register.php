<?php 
	session_start();
	if(!$_SESSION['authuser1'])
		header('location:login.php');
	if($_SESSION['authuser1']!=1)
		exit();
?>

<html>
	<head>
		<title>
			Add Driver
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
						<a href="search.php"><li>Search</li></a>
						<a style="background-color: #bb4000;" href="register.php"><li>Admin Panel</li></a>
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
						<a style="background-color: #606060;" href="register.php"><li>Register</li></a>
						<a style="background-color: #C8C8C8;" href="changePassword.php"><li>Change Password</li></a>
					</ul>
					<div style="clear:both;"></div>
				</div>
			</div>
			<form action="insert.php" method="post">
				<table align = "center">
					<tr>
						<td style="float:left;width:100px;">Firstname</td><td><input class="boxOne" type="text" name="firstname"></td>
					</tr>
					<tr>
						<td style="float:left;">Lastname</td><td><input class="boxOne" type="text" name="lastname"/></td>
					</tr>
					<tr>
						<td style="float:left;">Address</td><td><input class="boxOne" type="text" name="Address" /></td>
					<tr>
						<td style="float:left;">Phone Number</td><td><input class="boxOne" type="text" name="phno" /></td>
					</tr>	
					<tr>
						<td style="float:left;">Device IMEI</td><td><input class="boxOne" type="text" name="IMEI" /></td>
					</tr>	
					<tr>
						<td style="float:left;">Ambulance No</td><td><input class="boxOne" type="text" name="ANO" /></td>
					</tr>		
					<tr>
						<td style="float:left;">Gender</td>
						<td>
							<input name="gender" type="radio" value="male" checked>Male
							<input name="gender" type="radio" value="female">Female
						</td>
					</tr>
				</table>
				<table align = "center">
					<tr>
						<td><input class="button" type="submit" value="Register" /><br>
					</tr>
				</table>
				
				<div id="success">
					<p>
						<?php
							if( isset($_GET['success']) && $_GET['success'] == 1 ){				
								echo 'Registration Successful';
							}
						?>
					</p>
				</div>
				<div id="warning">
					<p>
						<?php
							if( isset($_GET['warning']) && $_GET['warning'] == 1 ){				
								echo 'Registration Unsuccessful';
							}
						?>
					</p>
					<p>
						<?php
							if( isset($_GET['warningFName']) && $_GET['warningFName'] == 1 ){				
								echo 'First Name Field Empty';
							}
						?>
					</p>
					<p>
						<?php
							if( isset($_GET['warningLName']) && $_GET['warningLName'] == 1 ){				
								echo 'Last Name Field Empty';
							}
						?>
					</p>
					<p>
						<?php
							if( isset($_GET['warningAddress']) && $_GET['warningAddress'] == 1 ){				
								echo 'Address Field Empty';
							}
						?>
					</p>
					<p>
						<?php
							if( isset($_GET['warningPhonr']) && $_GET['warningPhonr'] == 1 ){				
								echo 'Phone Number Field Empty';
							}
						?>
					</p>
					<p>
						<?php
							if( isset($_GET['warningIMEI']) && $_GET['warningIMEI'] == 1 ){				
								echo 'IMEI Field Empty';
							}
						?>
					</p>
					<p>
						<?php
							if( isset($_GET['warningGen']) && $_GET['warningAno'] == 1 ){				
								echo 'Ambulance Number Field Empty';
							}
						?>
					</p>
				</div>
			</form>
		</div>
		<div id="footer">
			<p> &copy 2014 Fast Relief Ambulance </p>
		</div>
	</body>
</html>
