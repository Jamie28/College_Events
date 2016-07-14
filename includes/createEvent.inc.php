<?php
	session_start();
	if (loggedIn () && isAdmin()) {
	include 'functions.inc.php';
	
	
	$nameErr = $dateErr = $timeErr = $contactErr = $descErr = $locationErr = NULL;
	
	if (loggedIn() && isAdmin()){
		
		if (empty($_POST['evt_name'])) {
			$nameErr = "Event name is required";
		} else {
			$evt_name = test_input($_POST['evt_name']);
			if (!preg_match("/^[a-zA-Z ]*$/",$evt_name)) {
				$nameErr = "Only letters and white space allowed";
			}
		}
	
		if (empty($_POST['evt_time'])) {
			$timeErr = "Event time is required";
		} else{
			$evt_time = test_input($_POST['evt_time']);
		}
	
		if (empty($_POST['evt_date'])) {
			$dateErr = "Event date is required";
		} else {
			$evt_date = test_input($_POST['evt_date']);
		}
	
		if (empty($_POST['evt_comment'])) {
			$comment = "";
		} else {
			$evt_comment = test_input($_POST['evt_comment']);
		}
	
		if (empty($_POST['evt_description'])) {
			$descErr = "Event description is required";
		} else {
			$evt_description = test_input($_POST['evt_description']);
		}
		
		if (empty($_POST['evt_contact'])) {
			$contactErr = "A contact is required";
		} else {
			$evt_contact = test_input($_POST['evt_contact']);
		}
		
		if (empty($_POST['location'])) {
			$locationErr = "Event location is required";
		} else {
			$location = test_input($_POST['location']);
		}
	}		
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if((($nameErr == NULL) && ($timeErr == NULL) && ($dateErr == NULL) && ($locationErr == NULL))){
		
		include '../dbhandler.php';
		
		$insert = "INSERT INTO my_event (evt_id, evt_time, evt_comment, evt_date, evt_contact, evt_name, evt_description, location) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($link, $insert);
		$evt_id = NULL;
		mysqli_stmt_bind_param($stmt, "isssssss", $evt_id,
				$evt_time, $evt_comment, $evt_date, $evt_contact, $evt_name, $evt_description, $location);
		mysqli_stmt_execute($stmt);
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		if ($affected_rows == 1)
		{
			$_SESSION['error'] = 2;
		}
		else
		{
			$_SESSION['error'] = 8;
		}
		mysqli_stmt_close($stmt);
		mysqli_close($link);
		header("Location: ../index.php");
	}else {
		if (!($nameErr == NULL))
			echo "$nameErr<br>";
		if (!($timeErr==NULL))
			echo "$timeErr<br>";
		if(!($dateErr==NULL))
			echo "$dateErr<br>";
		if(!($contactErr==NULL))
			echo "$contactErr<br>";
		if(!($descErr==NULL))
			echo "$descErr<br>";
		if (!($locationErr == NULL))
			echo "$locationErr<br>";	
	}
	}
	
?>