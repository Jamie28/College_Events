<?php
	session_start();
	include 'functions.inc.php';
	
	if (isset($_POST['Approve']) && loggedIn() && isSuperAdmin())
	{
		include '../dbhandler.php';
		// UPDATE `approve_e` SET `approved` = '1' WHERE `approve_e`.`aid` = 1 AND `approve_e`.`evt_id` = 1
		$sql = "UPDATE approve_e SET approved = 1 WHERE evt_id = ".$_POST['evt_id']." AND aid = ".$_POST['aid']."";
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_execute($stmt);
		
		// If succesfull
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		if ($affected_rows != 1)
			$_SESSION['error'] = 9;
		
		// Return to joinRSO page
		header("Location: ../approveEvent.php");
	}
	else if (isset($_POST['Unapprove']) && loggedIn() && isSuperAdmin)
	{
		include '../dbhandler.php';
		// UPDATE `approve_e` SET `approved` = '0' WHERE `approve_e`.`aid` = 1 AND `approve_e`.`evt_id` = 1
		$sql = "UPDATE approve_e SET approved = 0 WHERE evt_id = ".$_POST['evt_id']." AND aid = ".$_POST['aid']."";
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_execute($stmt);
		
		// If succesfull
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		if ($affected_rows != 1)
			$_SESSION['error'] = 9;
		
		// Return to joinRSO page
		header("Location: ../approveEvent.php");
	}
	else
	{
		// Temporary
		$_SESSION['error'] = 9;
		header("Location: ../approveEvent.php");
		
	}