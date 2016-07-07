<?php
	
	session_start();
	
	include 'functions.inc.php';
	
	
	// Only input into database if user is a superadmin
	if (loggedIn() && isSuperAdmin())
	{
		$data_missing = array();
		
		if(empty($_POST['unv_name']))
		{
			// Adds name to array
			$data_missing[] = 'Name';
		} else
		{
			// Trim white space from the name and store the name
			$unv_name = strip_tags(trim($_POST['unv_name']));
		}
		
		if(empty($_POST['email'])){
		
			// Adds name to array
			$data_missing[] = 'email';
		
		} else
		{
			// Trim white space from the name and store the name
			$email = strip_tags(trim($_POST['email']));
		}
		
		if(empty($_POST['address'])){
		
			// Adds name to array
			$data_missing[] = 'address';
			$address = NULL;
		
		} else
		{
			// Trim white space from the name and store the name
			$address = strip_tags(trim($_POST['address']));
		}
		
		if(empty($_POST['description'])){
		
			// Adds name to array
			$data_missing[] = 'description';
			$description = NULL;
		
		} else
		{
			// Trim white space from the name and store the name
			$description = strip_tags(trim($_POST['description']));
		}
		
		if(empty($_POST['population'])){
		
			// Adds name to array
			$data_missing[] = 'population';
			$population = NULL;
		
		} else
		{
			// Trim white space from the name and store the name
			$population = strip_tags(trim($_POST['population']));
		}
		
		
		// Enter univerity if we atelast have name and email
		if(!isset($data_missing['unv_name']) & !isset($data_missing['email']))
		{
			include '../dbhandler.php';
			 
			// Insert into university table
			$sql = "INSERT INTO university (unv_id, unv_name, population, description, email, 
					address) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($link, $sql);
			
			$unv_id = NULL;
			mysqli_stmt_bind_param($stmt, "isisss", $unv_id, 
					$unv_name, $population, $description, $email, $address);
		
			mysqli_stmt_execute($stmt);
		
			$affected_rows = mysqli_stmt_affected_rows($stmt);
			
			if ($affected_rows == 1)
			{
				$_SESSION['error'] = 2;
			}
			else
			{
				$_SESSION['error'] = 3;
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
			header("Location: ../createUnv.php");
		}
	}
	else
	{
		header("Location: ../index.php");
	}
?>
	