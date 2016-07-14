<?php

	include ("header.php");
	function listPublicEvents() {
	
		include "dbhandler.php";
	
		try
		{
			$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $dbh->prepare("SELECT e.evt_name, e.evt_description, e.evt_date, e.evt_contact, e.evt_id FROM my_event e, public p WHERE e.evt_id = p.evt_id");
			$stmt->execute();
	
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$evt_id = $row['evt_id'];
				echo "<a href='events.php?evt_id=$evt_id'>" . $row['evt_name'] . "</a><br>" . $row['evt_description'] . "<br>" . "Contact: " . $row['evt_contact'] . "<br>" . "When: " . $row['evt_date'] . "<br>";
			}
	
			$stmt = null;
		}
		catch(Exception $e)
		{
			echo 'We are unable to process your request. Please try again later';
		}
	}
	
	function listUniversityEvents() {
	
		include "dbhandler.php";
		try
		{
			$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $dbh->prepare("SELECT e.evt_name, e.evt_date, e.evt_description, e.evt_time, e.location, e.evt_contact, e.evt_id FROM my_event e, private p, student s, university u WHERE e.evt_id = p.evt_id AND p.unv_id = u.unv_id AND s.uid = :uid AND s.unv_id = p.unv_id");
			$stmt->bindParam(':uid', $_SESSION['uid'], PDO::PARAM_INT);
			$stmt->execute();

			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$evt_id = $row['evt_id'];
			
				echo "<a href='events.php?evt_id=$evt_id'>" . $row['evt_name'] . "</a><br>" . $row['evt_description'] . "<br>" . "Contact: " . $row['evt_contact'] . "<br>" . "When: " . $row['evt_date'] . "<br><br>";
			}
	
			$stmt = null;
		}
		catch(Exception $e)
		{
			echo 'We are unable to process your request. Please try again later';
		}
	}
	function listRSOEvents() {
	
		include "dbhandler.php";
		try
		{
			$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $dbh->prepare("SELECT e.evt_name, e.evt_description, e.evt_time, e.location, e.evt_contact, e.evt_id, p.rso_e FROM events e, in_rso s, rso_e p WHERE s.rso_id = p.rso_id AND e.evt_id = p.evt_id AND s.uid = :uid");
			$stmt->bindParam(':uid', $_SESSION['uid'], PDO::PARAM_INT);
			$stmt->execute();
	
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$event_id = $row['event_id'];
				echo "<a href='events.php?evt_id=$evt_id'>". $row['evt_name'] . "</a>". "\t" . $row['evt_description'] . "\t" . $row['evt_time'] . "\t" . $row['location'] . "\t" . $row['evt_comment'] . "<br><br>";
				$data = $row['evt_name'] . "\t" . $row['evt_description'] . "\n";
				print $data;
			}
	
			$stmt = null;
		}
		catch(Exception $e)
		{
			echo 'We are unable to process your request. Please try again later';
		}
	
	}
?>
	
	<!-- show public event -->
		<center><p class="body"> PUBLIC EVENTS
		<br><br>
		
			<?php
			
				if(isset($_SESSION['user_id']) && $_SESSION['user_priv'] == 3)
				{
					listPublicEvents();
				}
				elseif(!isset($_SESSION['user_id']))
				{
					listPublicEvents();
				}
				
			?>
			<div id="page">
		
		
		<center><p class="body"> PRIVATE EVENTS
		
		<br><br>
		
			<?php 
			
				listUniversityEvents();		
			?>
			
		</p>
		
		<center><p class="body"> RSO EVENTS
		
		<br><br>
		
			<?php 
			
				listRSOEvents();		
			?>
			
		</p>
		
		
		<br>
		<br><br><center><div class="logo"><a href="viewEvents.php" style="border:1.5px; 
			border-style:solid; border-color:#660066; padding: .5em;">Return To Top</a></div></center>		
			<br>
		</p>
			
	</div>
</body>