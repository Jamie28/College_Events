<?php
function eventDetails() {
	include "dbhandler.php";
	try
	{
		//fetch the event details from the database 
		$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare("SELECT e.evt_name, e.evt_description, e.evt_time, e.evt_date, e.evt_contact, e.evt_id FROM my_event e, WHERE e.evt_id = :event");
		$stmt->bindParam(':event', $_GET['vari'], PDO::PARAM_INT);
		$stmt->execute();

		//display the event details to the user
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$evt_id = $row['evt_id'];
		echo $row['evt_name'] . "<br>" . $row['evt_description'] . "<br>" . "Contact: " . $row['evt_contact'] . "<br>" . "When: " . $row['evt_date'] . "<br><br>";
		
		$stmt = null;
	}
	catch(Exception $e){
		echo 'Session Error';
	}
}?>

	<div id="page">	
			<?php eventDetails();?>
	</div>
</body>