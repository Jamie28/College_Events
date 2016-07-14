<?php

	include ("header.php");
	function listPublicEvents() {
	
		include "dbhandler.php";
	
		$feed_url = 'https://events.ucf.edu/feed.rss';
		$content = file_get_contents($feed_url);
		$x = new SimpleXmlElement($content);
	
		echo "<div class='list-group'>";
	
		foreach($x->channel->item as $entry) {
			echo "<h3><a class='list-group-item-heading' href='$entry->link' title='$entry->title'>" . $entry->title . "</a></h3>";
			echo "<p class='list-group-item-text'>" . $entry->description . "</p>";
		}
		echo "</div>";
	
		try
		{
			$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
			/*** $message = a message saying we have connected ***/
			/*** set the error mode to excptions ***/
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			/*** prepare the select statement ***/
			$stmt = $dbh->prepare("SELECT e.evt_name, e.evt_description, e.evt_date, e.evt_contact, e.evt_comment, e.evt_id, p.evt_id FROM my_event e, public p WHERE e.evt_id = p.evt_id");
			/*** execute the prepared statement ***/
			$stmt->execute();
	
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$evt_id = $row['evt_id'];
				echo "<a href='includes/events.inc.php?evt_id=$evt_id'>" . $row['evt_name'] . "</a>".  "\t" . $row['evt_description'] . "\t" . $row['evt_date'] . "\t" . $row['evt_contact'] . "\t" . $row['evt_comment'] . "<br><br>";
				$data = $row['evt_name'] . "\t" . $row['evt_description'] . "\n";
				print $data;
			}
	
			$stmt = null;
		}
		catch(Exception $e)
		{
			/*** if we are here, something has gone wrong with the database ***/
			echo 'We are unable to process your request. Please try again later';
		}
	
	}
	
	function listUniversityEvents() {
	
		include "dbhandler.php";
		try
		{
			$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
			/*** $message = a message saying we have connected ***/
			/*** set the error mode to excptions ***/
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			/*** prepare the select statement ***/
			$stmt = $dbh->prepare("SELECT e.evt_name, e.evt_description, e.evt_time, e.location, e.evt_contact, e.evt_id FROM events e, private u, person s WHERE e.evt_id = u.evt_id AND s.uid = :uid AND s.unv_id = u.unv_id");
			$stmt->bindParam(':uid', $_SESSION['uid'], PDO::PARAM_INT);
	
			/*** execute the prepared statement ***/
			$stmt->execute();
	
			//		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$event_id = $row['evt_id'];
				echo "<a href='includes/events.php?evt_id=$evt_id'>". $row['evt_name'] . "</a>". "\t" . $row['evt_description'] . "\t" . $row['evt_time'] . "\t" . $row['location'] . "\t" . $row['evt_comment'] . "<br><br>";
				$data = $row['evt_name'] . "\t" . $row['evt_description'] . "\n";
				print $data;
			}
	
			$stmt = null;
		}
		catch(Exception $e)
		{
			/*** if we are here, something has gone wrong with the database ***/
			echo 'We are unable to process your request. Please try again later';
		}
	
	}
	function listRSOEvents() {
	
		include "dbhandler.php";
		try
		{
			$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
			/*** $message = a message saying we have connected ***/
			/*** set the error mode to excptions ***/
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			/*** prepare the select statement ***/
			$stmt = $dbh->prepare("SELECT e.evt_name, e.evt_description, e.evt_time, e.location, e.evt_contact, e.evt_id, p.rso_e FROM events e, in_rso s, rso_e p WHERE s.rso_id = p.rso_id AND e.evt_id = p.evt_id AND s.uid = :uid");
			$stmt->bindParam(':uid', $_SESSION['uid'], PDO::PARAM_INT);
	
				
	
			/*** execute the prepared statement ***/
			$stmt->execute();
	
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$event_id = $row['event_id'];
				echo "<a href='includes/events.php?evt_id=$evt_id'>". $row['evt_name'] . "</a>". "\t" . $row['evt_description'] . "\t" . $row['evt_time'] . "\t" . $row['location'] . "\t" . $row['evt_comment'] . "<br><br>";
				$data = $row['evt_name'] . "\t" . $row['evt_description'] . "\n";
				print $data;
			}
	
			$stmt = null;
		}
		catch(Exception $e)
		{
			/*** if we are here, something has gone wrong with the database ***/
			echo 'We are unable to process your request. Please try again later';
		}
	
	}
?>
	
	<!-- show public event -->
		<center><p class="body"> Public Events
		<br>
		
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
		
		
		<center><p class="body"> Private Events
		
		<br>
		
			<?php 
			
				listUniversityEvents();		
			?>
			
		</p>
		
		<center><p class="body"> RSO Events
		
		<br>
		
			<?php 
			
				listRSOEvents();		
			?>
			
		</p>
		
		
		<br>
		<br><br><center><div class="logo"><a href="viewEvents.php" style="border:1.5px; 
			border-style:solid; border-color:#660066; padding: .5em;">Top Of Page</a></div></center>		
			<br>
		</p>
			
	</div>
</body>