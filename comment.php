<?php
	include "dbhandler.php";
	include "events.php";
	$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
	try{
		$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$eid = $dbh->prepare("SELECT evt_id FROM my_event WHERE evt_id = :evt_id");
		$eid->bindParam(':evt_id', $_GET['evt_id'], PDO::PARAM_INT);
		$eid->execute();
		$uid = $dbh->prepare("SELECT uid FROM person WHERE uid = :uid");
		$uid->bindParam(':evt_id', $_GET['evt_id'], PDO::PARAM_INT);
		$uid->execute();
		$stmt = $dbh->prepare("INSERT INTO comments (evt_id, uid, text) VALUES ( $evt_id, $uid, :comment)");
		$stmt->bindParam(':evt_id', $_GET['evt_id'], PDO::PARAM_INT);
		$stmt->execute();
	}
	catch(Exception $e){
		echo 'We are unable to process your request. Please try again later';
	}?>
<div id="page">
   Request Submitted.
</div><br><br>
<a href="index.php">Return Home</a>
</body>
