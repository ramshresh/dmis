<?php
// @author :  Ayam @ 7/05/2014 

   $host        = "localhost";
   $port        = 5432;
   $dbname      = "FastReliefAmbulance";
   $user 		= "postgres";
   $pass 		= "postgres";
   $connect_string = pg_connect(" host = $host port = $port dbname = $dbname user = $user password = $pass ");
   if(!$connect_string){
      echo "Error : Unable to Connect\n";
	  exit;
   } 
?>
