<?php
	session_start();	
	include 'functions.inc.php';
	$nameErr = $dateErr = $timeErr = $contactErr = $descErr = $locationErr = $eventTypeErr = NULL;
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
		if (empty($_POST['event_type'])) {
			$eventTypeErr = "Event type is required"; 
		} else {
			$event_type = $_POST['event_type'];
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
		if (empty($_POST['lat']) || empty($_POST['lng'])) {
			$locationErr = "Event location is required";
		} else {
			$lat = test_input($_POST['lat']);
			$lng = test_input($_POST['lng']);
			$address = test_input($_POST['address']);
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
		
		$insert = "INSERT INTO my_event (evt_id, evt_time, evt_comment, evt_date, evt_contact, evt_name, evt_description) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($link, $insert);
		$evt_id = NULL;
		mysqli_stmt_bind_param($stmt, "issssss", $evt_id,
				$evt_time, $evt_comment, $evt_date, $evt_contact, $evt_name, $evt_description);
		mysqli_stmt_execute($stmt);
		$evt_id = mysqli_insert_id($link);
		$affected_rows = mysqli_stmt_affected_rows($stmt);
		if ($affected_rows == 1){
			$_SESSION['error'] = 2;
		}
		else{
			$_SESSION['error'] = 8;
		}
		mysqli_stmt_close($stmt);
		
		if($event_type == "public" || $event_type == "private"){
			$insert = "INSERT INTO " . $event_type . " (evt_id, unv_id) VALUES (?, ?)";
			$stmt = mysqli_prepare($link, $insert);
			mysqli_stmt_bind_param($stmt, "ii", $evt_id, $_SESSION['unv_id']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			
			$insert = "INSERT INTO approve_e (aid, approved, evt_id) VALUES (?, ?, ?)";
			$stmt = mysqli_prepare($link, $insert);
			$aid = NULL;
			$approved = 0;
			mysqli_stmt_bind_param($stmt, "iii", $aid, $approved, $evt_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}else {
			$sql = "SELECT r.rso_id
					FROM rso r
					WHERE r.rso_name = '".$event_type."' ";
			$res = mysqli_query($link, $sql);
			$row = mysqli_fetch_array($res);
			
			$insert = "INSERT INTO rso_e (evt_id, rso_id) VALUES (?, ?)";
			$stmt = mysqli_prepare($link, $insert);
			mysqli_stmt_bind_param($stmt, "ii", $evt_id, $row['rso_id']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		
		$insertLoc = "INSERT INTO locations (lid, lat, lng, address)
					  VALUES (?, ?, ?, ?)";
		$stmt = mysqli_prepare($link, $insertLoc);
		$lid = NULL;
		mysqli_stmt_bind_param($stmt, "idds", $lid, $lat, $lng, $address);
		mysqli_stmt_execute($stmt);
		$lid = mysqli_insert_id($link);
		mysqli_stmt_close($stmt);
		
		$insertAt = "INSERT INTO takes_place (evt_id, lid)
					 VALUES (?, ?)";
		$stmt = mysqli_prepare($link, $insertAt);
		mysqli_stmt_bind_param($stmt, "ii", $evt_id, $lid);
		mysqli_stmt_execute($stmt);
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
		if(!($locationErr == NULL))
			echo "$locationErr<br>";
		if(!($eventTypeErr == NULL))
			echo "$eventTypeErr<br>";
	}
?>