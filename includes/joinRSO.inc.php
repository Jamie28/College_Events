<?php
	session_start();
	include '../dbhandler.php';
	include 'functions.inc.php';
	
	
	if (isset($_POST['Join']) && loggedIn())
	{
		//INSERT INTO `in_rso` (`uid`, `rso_id`, `since`) VALUES ('2', '2', CURRENT_TIMESTAMP)
		// Insert
		$sql = "INSERT INTO in_rso (uid, rso_id) VALUES (?, ?)";
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "ii", $_SESSION['uid'], $_POST['rso_id']);
		mysqli_stmt_execute($stmt);
		
		// If succesfull
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		if ($affected_rows != 1)
			$_SESSION['error'] = 9;
		
		// reset rso_id session variable
		$_SESSION['rso_id'] = 0;
		
		// Return to joinRSO page
		header("Location: ../joinRSO.php");
	}
	else if (isset($_POST['Leave']) && loggedIn())
	{
		
		// DELETE FROM `in_rso` WHERE `in_rso`.`uid` = 12 AND `in_rso`.`rso_id` = 1
		// Delete
		//$sql = "SELECT * FROM person WHERE username = '".$username."' AND password = '".$password."' LIMIT 1";
		$sql = "DELETE FROM in_rso WHERE in_rso.uid = " . $_SESSION['uid'] . " AND in_rso.rso_id = " . $_POST['rso_id'];
		$stmt = mysqli_prepare($link, $sql);
		//mysqli_stmt_bind_param($stmt, "ii", $_SESSION['uid'], $_POST['rso_id']);
		mysqli_stmt_execute($stmt);
		
		// If succesfull
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		if ($affected_rows != 1)
			$_SESSION['error'] = 9;
		
		// reset rso_id session variable
		$_SESSION['rso_id'] = 0;
		
		// Return to joinRSO page
		header("Location: ../joinRSO.php");
	}
	else
	{
		// Temporary
		$_SESSION['error'] = 9;
		header("Location: ../joinRSO.php");
		
	}
		
	// For reference
	/*$sql = "INSERT INTO person (uid, username, password, email) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_prepare($link, $sql);
	$uid = NULL;
	mysqli_stmt_bind_param($stmt, "isss", $uid, $username,
			$password, $email);
	
	mysqli_stmt_execute($stmt);
	
	$affected_rows = mysqli_stmt_affected_rows($stmt);*/