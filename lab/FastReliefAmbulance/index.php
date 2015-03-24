<?php
	session_start();

	$_SESSION['authuser1']=0;
	//session_destroy();
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
				<div id="bannerTabs" >
					
					<ul>
						<a href="index.php"><li>Home</li></a>
						<a href="about.php"><li>About</li></a>
					</ul>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<div id = "body">
			<form align="center" action="loginCheck.php" method='post' style="clear:both; margin-top:20px;">
				<table align= "center">	
					<tr>
						<td>
							Username
						</td>
						<td>
							<input type="text" name="username"  class="fancy">
						</td>
					</tr>
					<tr>
						<td>
							Password
						</td>
						<td>
							<input type="password" name="password"  class="fancy">
						</td>
					</tr>
				<table align= "center">
					<tr>
						<td>&nbsp;</td>
						<td>
							<input style="text-decoration:none;" class="button" type="submit" value="LOGIN" style="margin-top:20px; margin-left:40px;">
						</td>
					</tr>
				</table>
									
			</form>
		</div>
				<div id="warning">
					<p>
						<?php
							if( isset($_GET['warning'])){ 
								if( $_GET['warning'] == 1 ){				
									echo 'Login Unsuccesful: Query Error';
								}
								if( $_GET['warning'] == 2 ){				
									echo 'Login Unsuccesful: Invalid Username or Password';
								}
							}
							
						?>
					</p>
				</div>
		<div style="clear:both;"></div>
		<div id="footer">
			<p> &copy 2014 Fast Relief Ambulance </p>
		</div>
	</body>
</html>