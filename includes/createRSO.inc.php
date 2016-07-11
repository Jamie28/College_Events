<?php
	session_start();

	include 'functions.inc.php';

	$rsonameErr = $emailError = $distinctemailErr = $since = NULL;
	$rsoname = NULL;
	
	function check_email()
	{
		
	}
	
	if (loggedIn())
	{
		//Check if the user entered an RSO Name
		if(empty($_POST['rsoname']))
		{
			$rsonameErr = "Enter an RSO name.";
		}
		else
		{
			$rsoname = strip_tags(trim($_POST['rsoname']));
		}
		
		//Check if the user filled all email blanks
		if(empty($_POST['email1']) ||
		   empty($_POST['email2']) ||
		   empty($_POST['email3']) ||
		   empty($_POST['email4']) )
		{
			$emailError = "Enter four email addresses.";
		}
		else 
		{
			include '../dbhandler.php';
			
			$email1 = strip_tags($_POST['email1']);
			$email2 = strip_tags($_POST['email2']);
			$email3 = strip_tags($_POST['email3']);
			$email4 = strip_tags($_POST['email4']);
			$currUser = $_SESSION['uid'];
			
			$sql = "SELECT DISTINCT uid, email
						FROM person
						WHERE email = '".$email1."' OR
					      	  email = '".$email2."' OR
					      	  email = '".$email3."' OR
					      	  email = '".$email4."' OR
					      	  uid = '".$currUser."' ";
			$res = mysqli_query($link, $sql);
			
			if(mysqli_num_rows($res) == 5)
			{
				//Get a new RSO id
				$sql4 = "SELECT *
						 FROM rso";
				$res4 = mysqli_query($link, $sql4);
				$rsoid = mysqli_num_rows($res4) + 1;
				
				//Insert the new rso
				$sql = "INSERT INTO rso (rso_id, rso_name, unv_id, owner_id) VALUES (?, ?, ?, ?)";
				$stmt = mysqli_prepare($link, $sql);
					
				$unv_id = $_SESSION['unv_id'];
				mysqli_stmt_bind_param($stmt, "isii", $rsoid, $rsoname, $unv_id, $currUser);
				mysqli_stmt_execute($stmt);
				
				//See if the user is already an admin. Don't want to add to admin table if user already present. 
				//Don't actually need this, admin should have only one unique column, uid.
				$sql2 = "SELECT A.uid
						 FROM admin A
						 WHERE A.uid = '".$currUser."' ";
				$res2 = mysqli_query($link, $sql2);
				
				//No rows found, not an admin yet
				if(mysqli_num_rows($res2) == 0)
				{
					//Insert user into admin table
					$sql3 = "INSERT INTO admin (uid) VALUES (?)";
					$stmt = mysqli_prepare($link, $sql3);
					mysqli_stmt_bind_param($stmt, "i", $currUser);
					mysqli_stmt_execute($stmt);
				}
				
				//Insert the five into the in_rso table
				$sql = "SELECT DISTINCT uid, email
						FROM person
						WHERE email = '".$email1."' OR
					      	  email = '".$email2."' OR
					      	  email = '".$email3."' OR
					      	  email = '".$email4."' OR
					      	  uid = '".$currUser."' ";
				$res = mysqli_query($link, $sql);
				
				for($i = 0; $i < mysqli_num_rows($res); $i++)
				{
					$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
					$curruid = $row['uid'];
					$sqlloop = "INSERT INTO in_rso (rso_id, uid) VALUES (?, ?)";
					$stmt = mysqli_prepare($link, $sqlloop);
					mysqli_stmt_bind_param($stmt, "ii", $rsoid, $curruid);
					mysqli_stmt_execute($stmt);
				}
				header("Location: ../index.php");
			}
			else 
			{
				$distinctemailErr = "Please enter the email addresses of four distinct users";
				echo "$distinctemailErr<br>";
			}
		}
	}
	else
	{
		header("Location: ../index.php");
	}
	
?>