<?php
	include '../dbhandler.php';
	
	// First check if user already exists
	//include 'checkexists.inc.php';
	
	// Will need function that checks email to university
		
	// Insert into users table
	$sql = "INSERT INTO person (uid, username, password, email) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_prepare($link, $sql);
	$uid = NULL;
	mysqli_stmt_bind_param($stmt, "isss", $uid, $username,
			$password, $email);
	
	mysqli_stmt_execute($stmt);
	
	$affected_rows = mysqli_stmt_affected_rows($stmt);