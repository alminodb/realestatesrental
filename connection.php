<?php 

	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "realestate";
	
	$db = mysqli_connect($host, $username, $password, $database);

	if(!$db){
		die("Unable to connect to database!");
	}

?>