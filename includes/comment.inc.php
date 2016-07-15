<?php
	include "../dbhandler.php";
	$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
	try{
		$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare("SELECT c.text, r.rating FROM comments c, ratings r, my_event e WHERE e.evt_id = c.evt_id AND r.comment_id = c.comment_id AND e.evt_id = :event_id");
		$stmt->bindParam(':evt_id', $_GET['evt_id'], PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		echo "<h3>Comments: </h3>";

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo "<h3>" . $result['text'] . "\t\t\t" . "Rating: " .$result['rating'] . "</h3>" . "<a href=/>Remove</a>";
			$data = $result['text'] . "\t" . $result['rating'] . "\n";
			print $data;
		}
		$stmt = null;
	}
	catch(Exception $e){
		echo 'We are unable to process your request. Please try again later';
	}
?>
<div id="page">
    Request Submitted.
</div>
