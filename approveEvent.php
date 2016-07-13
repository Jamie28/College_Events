<?php
include ("header.php");
?>
<h2>Approve Event</h2>
<?php

if (loggedIn () && isSuperAdmin()) {
	
	include 'dbhandler.php';
	
	// Find rso events
	
	$sql = "SELECT * FROM approve_e WHERE approved ='0'";
	$response = mysqli_query ( $link, $sql );
	
	if ($response) 
	{
		echo '<table align="left"
				cellspacing="5" cellpadding="8">
				<tr><td align="left"><b>Event</b></td>
				<td align="left"><b>Approve</b></td>
				<td align="left"><b>RSO</b></td>
				<td align="left"><b>Description</b></td>
				</tr>';
		
		// mysqli_fetch_array will return a row of data from the query
		// until no further data is available
		while ( $approve_e = mysqli_fetch_array ( $response ) ) {
			
			if ($approve_e['approved'] == 0)
			{
				// The event needs to be approved
				// Get event info
				$sql = "SELECT * FROM my_event WHERE evt_id ='".$approve_e['evt_id']."'";
				$res = mysqli_query ( $link, $sql );
				$my_event = mysqli_fetch_array($res);
				
				// Get rso id
				$sql = "SELECT * FROM rso_e WHERE evt_id ='".$approve_e['evt_id']."'";
				$res = mysqli_query ( $link, $sql );
				$rso_e = mysqli_fetch_array($res);
				
				// Get rso name
				$sql = "SELECT * FROM rso WHERE rso_id ='".$rso_e['rso_id']."'";
				$res = mysqli_query ( $link, $sql );
				$rso = mysqli_fetch_array($res);
				
				echo "<tr><td align='left'>";
				// Event name
				echo $my_event['evt_name'];
				// Approve button
				echo "</td><td align='left'>";
				echo "<form method='post' action='includes/approveEvent.inc.php'>";
				echo "<input type='hidden' name='evt_id' value='" . $approve_e['evt_id'] . "'/>";
				echo "<input type='hidden' name='aid' value='" . $approve_e['aid'] . "'/>";
				echo "<input type='submit' name='Approve' value='Approve'/></form>";
				// RSO name
				echo "</td><td align='left'>";
				echo $rso['rso_name'];
				// Event Description
				echo "</td><td align='left'>";
				echo $my_event['description'];
				echo "</td><td align='left'></tr>";
			}
		}
	}
	
	// Now search through approve_e once more, and display the already approved events at the bottom
	// This is mostly for testing purposes
	$sql = "SELECT * FROM approve_e WHERE approved ='1'";
	$response = mysqli_query ( $link, $sql );
		
	if ($response)
	{
		// mysqli_fetch_array will return a row of data from the query
		// until no further data is available
		while ( $approve_e = mysqli_fetch_array ( $response ) ) {
				
			if ($approve_e['approved'] == 1)
			{
				// The event needs to be approved
				// Get event info
				$sql = "SELECT * FROM my_event WHERE evt_id ='".$approve_e['evt_id']."'";
				$res = mysqli_query ( $link, $sql );
				$my_event = mysqli_fetch_array($res);
		
				// Get rso id
				$sql = "SELECT * FROM rso_e WHERE evt_id ='".$approve_e['evt_id']."'";
				$res = mysqli_query ( $link, $sql );
				$rso_e = mysqli_fetch_array($res);
		
				// Get rso name
				$sql = "SELECT * FROM rso WHERE rso_id ='".$rso_e['rso_id']."'";
				$res = mysqli_query ( $link, $sql );
				$rso = mysqli_fetch_array($res);
		
				echo "<tr><td align='left'>";
				// Event name
				echo $my_event['evt_name'];
				// Approve button
				echo "</td><td align='left'>";
				echo "<form method='post' action='includes/approveEvent.inc.php'>";
				echo "<input type='hidden' name='evt_id' value='" . $approve_e['evt_id'] . "'/>";
				echo "<input type='hidden' name='aid' value='" . $approve_e['aid'] . "'/>";
				echo "<input type='submit' name='Unapprove' value='Unapprove'/></form>";
				// RSO name
				echo "</td><td align='left'>";
				echo $rso['rso_name'];
				// Event Description
				echo "</td><td align='left'>";
				echo $my_event['description'];
				echo "</td><td align='left'></tr>";
			}
		}
		echo '</table>';
	}
	
} else {
	// Go home
	header ( "Location: index.php" );
}