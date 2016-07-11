<?php
session_start();

	include 'functions.inc.php';
	
	$data_missing = array();
	
	if(empty($_POST['username']))
	{
		// Adds name to array
		$data_missing[] = 'username';
	} else
	{
		// Trim white space from the name and store the name
		$username = strip_tags(trim($_POST['username']));
	}
	
	if(empty($_POST['password'])){
	
		// Adds name to array
		$data_missing[] = 'password';
	
	} else
	{
		// Trim white space from the name and store the name
		$password = strip_tags(trim($_POST['password']));
	}
	
	if(empty($_POST['password_check']))
	{
		// Adds name to array
		$data_missing[] = 'password_check';
	} else
	{
		// Trim white space from the name and store the name
		$password_check = strip_tags(trim($_POST['password_check']));
	}
	
	if(empty($_POST['email']))
	{
		// Adds name to array
		$data_missing[] = 'email';
	} else
	{
		// Trim white space from the name and store the name
		$email = strip_tags($_POST['email']);
	}
	
	if ($password != $password_check)
	{
		$_SESSION['error'] = 5;
		header("Location: ../signup.php");
		// Just to be safe, exit from here
		exit();
	}
	
	if(empty($data_missing))
	{
		include '../dbhandler.php';
	
		// First check if user already exists
		//include 'checkexists.inc.php';
		
		// Checks email to university
		$str = $email;
		$str2 = strstr($str, '@');//@ucf.edu
		if($str2 != FALSE){
			$domain = substr($str2, 1);//ucf.edu
			$query = "SELECT * FROM university WHERE email = '".$domain."' LIMIT 1";
			$row = mysqli_query($link, $query);
			$data = mysqli_fetch_array($row);
			if (!isset($data['unv_id']))
			{
				// If user email does not match a university, display error
				// and exit signup
				$_SESSION['error'] = 7;
				header("Location: ../signup.php");
				exit();
			}
			$_SESSION['unv_id'] = $data['unv_id'];
		}
		
		// Insert into users table
		$sql = "INSERT INTO person (uid, username, password, email) VALUES (?, ?, ?, ?)";
		$stmt = mysqli_prepare($link, $sql);
		$uid = NULL;
		mysqli_stmt_bind_param($stmt, "isss", $uid, $username,
				$password, $email);
	
		mysqli_stmt_execute($stmt);
	
		$affected_rows = mysqli_stmt_affected_rows($stmt);
	
		// If statement executed properly, insert into student
		if ($affected_rows == 1)
		{
			// Get uid
			$sql = "SELECT * FROM person WHERE username = '".$username."' AND password = '".$password."' LIMIT 1";
			$res = mysqli_query($link, $sql);
			$row = mysqli_fetch_array($res);
			$uid = $row['uid'];
			
			// Insert into database
			$sql = "INSERT INTO student (uid, unv_id) VALUES (?, ?)";
			$stmt = mysqli_prepare($link, $sql);
			// unv_id will have to be found using find university function
			$unv_id = $data['unv_id'];
			mysqli_stmt_bind_param($stmt, "ii", $uid, $unv_id);
			mysqli_stmt_execute($stmt);
		}
	
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		
		if ($affected_rows == 1)
		{
			$_SESSION['error'] = 2;
		}
		else
		{
			$_SESSION['error'] = 6;
		}
	
		mysqli_stmt_close($stmt);
		mysqli_close($link);
	
		// return to index
		header("Location: ../index.php");
	
	} else
	{
		 
		$_SESSION['error'] = 4;
		$_SESSION['data_missing'] = $data_missing;
		 
		// return to index
		header("Location: ../signup.php");
	}
	?>
	