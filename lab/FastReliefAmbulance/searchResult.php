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
	
	if (isset($_REQUEST['firstname']) && isset($_REQUEST['lastname'])){
		$driver_fname = $_REQUEST['firstname'];
		$driver_lname = $_REQUEST['lastname'];
		if ($driver_lname == null && $driver_fname!= null){
				$query= 'SELECT * FROM "tracking".drivers where "Firstname" LIKE '."'%".$driver_fname."%'";
		}
		else if ($driver_fname == null && $driver_lname!= null){
			$query= 'SELECT * FROM "tracking".drivers where "Lastname" LIKE '."'%".$driver_lname."%'";
		}
			else if ($driver_fname == null && $driver_lname == null){
				$query= 'SELECT * FROM "tracking".drivers';
			}
			else {
				$query= 'SELECT * FROM "tracking".drivers where "Lastname" LIKE '."'%".$driver_lname."%'". ' UNION SELECT * FROM "tracking".drivers where "Firstname" LIKE '."'%".$driver_fname."%'";
			}
		}
	else {
		$query= 'SELECT * FROM "tracking".drivers';
	}
 ?>

<html>
	<head>
		<title>
			Search Result
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
			<h1>Search Result</h1>
			<div id = "searchList"> 	
				<div id="searchResult">
					<table id="searchTable" style="border-color: #dd4813;" align="center" border="2px;">
						<tr>
							<th style="width: 200px">	
								<p style="color: #dd4813;" >
									First Name
								</p>
							</th>
							<th style="width: 200px">
								<p style="color: #dd4813;">
									Last Name
								</p>
							</th>
							<th style="width: 200px">
								<p style="color: #dd4813;">
									Address
								</p>
							</th>
							<th style="width: 200px">
								<p style="color: #dd4813;">
									Phone Number
								</p>
							</th>
							<th style="width: 200px">
								<p style="color: #dd4813;">
									IMEI
								</p>
							</th>
							<th style="width: 200px">
								<p style="color: #dd4813;">
									Ambulance Number
								</p>
							</th>
							<th style="width: 200px">
								<p style="color: #dd4813;">
									Gender
								</p>
							</th>
							<th style="width: 200px">
								<p style="color: #dd4813;">
								</p>
							</th>
							<th >
								<p style="color: #dd4813;">
								</p>
							</th>
						</tr>
						
					<?php
						$exec=pg_query($connect_string,$query);
						$rows = pg_num_rows($exec);
						
						if( $rows == 0 )
							header("Location:searchResultNull.php");
						else if( $rows == 1 )
							echo $rows.' Result Found';
						else{
							echo $rows.' Results Found';
						}
						
						while ($result=pg_fetch_row($exec)){
							$firstname=$result[0];
							$lastname=$result[1];
							$address=$result[2];
							$phone=$result[3];
							$imei=$result[4];
							$gender=$result[5];
							$ambulanceNumber=$result[6];
								
					?>
					
						<tr>
							<td>
								<p>
									<?php
										echo "". $firstname ."" 
									?>
								</p>
							</td>
							<td>
								<p>
								<?php
									echo "". $lastname ."" 
								?>
							</td>
							<td>
								<p>
									<?php
										echo "". $address ."" 
									?>
								</p>
							</td>
							<td>
								<p>
									<?php
										echo "". $phone ."" 
									?>
								</p>
							</td>
							<td>
								<p>
									<?php
										echo "". $imei ."" 
									?>
								</p>
							</td>
							<td>
								<p>
									<?php
										echo "". $ambulanceNumber ."" 
									?>
								</p>
							</td>
							<td>
								<p>
									<?php
										echo "". $gender ."" 
									?>
								</p>
							</td>
							<td>
								<p>
									<?php 
										echo "<a href = updateDriver.php?id=".$imei.">Edit</a> ";
									?>
								</p>
							</td>
							<td>
								<p>
									<?php 
										echo "<a href = deleteDriver.php?id=".$imei.">Delete</a> " ;
									?>
								</p>
							</td>
						</tr>
					</div>
					<?php
						}
					?>
					<div id="success">
						<p>
							<?php
								if( isset($_GET['success']) && $_GET['success'] == 1 ){				
									echo 'Deletion Successful';
								}
							?>
						</p>
					</div>
					<div id="warning">
						<p>
							<?php
								if( isset($_GET['warning']) && $_GET['warning'] == 1 ){				
									echo 'Deletion Unsuccessful';
								}
							?>
						</p>
					</table>
				</div>
			</div>
		</div>
		<div id="footer">
			<p> &copy 2014 Fast Relief Ambulance </p>
		</div>
	</body>

</html>
