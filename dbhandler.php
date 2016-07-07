<?php

	$server = "localhost";
	$user = "root";
	$pass = "";
	$db_name = "database_systems";
	
	$link = mysqli_connect($server, $user, $pass, $db_name);
	
	if(!isset($link))
	{
		die("Connection failed: " . mysqli_connect_error());
	}