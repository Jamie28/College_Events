<?php
	include "header.php";
	include "dbhandler.php";
	
	$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
	$evt_id = $_GET['evt_id'];
	$uid = $_SESSION['uid'];
	$comment_id = NULL;
	
	//add new comment into database 
	$insert = "INSERT INTO comments (comment_id, evt_id, uid, text) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_prepare($link, $insert);
	mysqli_stmt_bind_param($stmt, "iiis", $comment_id, $evt_id, $uid, $comment);
	mysqli_stmt_execute($stmt);
	$comment_id = mysqli_insert_id($link);
	mysqli_stmt_close($stmt);
?>
<div id="page">
  <?php 
  	header('Location: events.php?evt_id=' . $evt_id);
  ?> 
</div>
</body>
