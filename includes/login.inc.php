<?php

	session_start();

	// Check NID and password
	if (isset($_POST['username']) && isset($_POST['password']))
	{
		// Include code to access database
		include '../dbhandler.php';
		
		// Fetches nid and password from user and 
		// removes any html or php code
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
	
		// Query statement
		$sql = "SELECT * FROM person WHERE username = '".$username."' AND password = '".$password."' LIMIT 1";
		$res = mysqli_query($link, $sql);
	
		// If a row was returned from query
		if (mysqli_num_rows($res) == 1)
		{
			// Fetch data from row
			$row = mysqli_fetch_array($res);
	
			$_SESSION['username'] = $row['username'];
			$_SESSION['uid'] = $row['uid'];
			
			// Set logged in variable
			$_SESSION['logged_in'] = true;
			
			// Check if user is a superadmin
			$sql = "SELECT * FROM s_admin WHERE uid = '".$_SESSION['uid']."' LIMIT 1";
			$res = mysqli_query($link, $sql);
			if(mysqli_num_rows($res) == 1)
			{
				$_SESSION['status'] = 2;
			}
			
			// Check if user is an admin
			$sql = "SELECT * FROM admin WHERE uid = '".$_SESSION['uid']."' LIMIT 1";
			$res = mysqli_query($link, $sql);
			if(mysqli_num_rows($res) == 1)
			{
				$_SESSION['status'] = 1;
			}
			
			// If user is a student, find which school user belongs to
			// store university id in session array so that it can be
			// accessed on other pages
			$sql = "SELECT unv_id FROM student WHERE uid = '".$_SESSION['uid']."' LIMIT 1";
			$res2 = mysqli_query ( $link, $sql );
			if (mysqli_num_rows ( $res2 ) == 1) {
				$row = mysqli_fetch_array($res2);
				$_SESSION ['unv_id'] = $row['unv_id'];
			}
			
			// Return to index
			header("Location: ../index.php");
	
		} else
		{
			// Return error code 1 (login failed)
			$_SESSION['error'] = 1;
			header("Location: ../index.php");
		}
	}