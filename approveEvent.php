<?php include ("header.php");?>

<h2>Approve Events</h2>

<?php

// This page allows for the superadmin to approve events made by individual students
// RSO events don't need approval

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
				<td align="left"><b>University</b></td>
				<td align="left"><b>Public/Private</b></td>
				<td align="left"><b>Description</b></td>
				<td align="left"><b>Comments</b></td>
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
				
				// Get private events
				$sql = "SELECT * FROM private WHERE evt_id ='".$approve_e['evt_id']."'";
				$res = mysqli_query ( $link, $sql );
				
				// if there is a private event, get the result array
				if ($res)
				{
					$private = mysqli_fetch_array($res);
					$isPrivate = true;
					
					// Get university ID
					$sql = "SELECT * FROM university WHERE unv_id ='".$private['unv_id']."'";
					$res = mysqli_query ( $link, $sql );
					$university = mysqli_fetch_array($res);
				}
				else
				{	
					// Get public events
					$sql = "SELECT * FROM public WHERE evt_id ='".$approve_e['evt_id']."'";
					$res = mysqli_query ( $link, $sql );
					$public = mysqli_fetch_array($res);
					
					$isPrivate = false;
					
					// Get university ID
					$sql = "SELECT * FROM university WHERE unv_id ='".$public['unv_id']."'";
					$res = mysqli_query ( $link, $sql );
					$university = mysqli_fetch_array($res);
				}
				
				echo "<tr><td align='left'>";
				// Event name
				echo $my_event['evt_name'];
				// Approve button
				echo "</td><td align='left'>";
				echo "<form method='post' action='includes/approveEvent.inc.php'>";
				echo "<input type='hidden' name='evt_id' value='" . $approve_e['evt_id'] . "'/>";
				echo "<input type='hidden' name='aid' value='" . $approve_e['aid'] . "'/>";
				echo "<input type='submit' name='Approve' value='Approve'/></form>";
				// University Name
				echo "</td><td align='left'>";
				echo $university['unv_name'];
				// Public or private
				echo "</td><td align='left'>";
				if ($isPrivate)
					echo "Private";
				else if (!$isPrivate)
					echo "Public";
				// Event Description
				echo "</td><td align='left'>";
				echo $my_event['evt_description'];
				// Comments
				echo "</td><td align='left'>";
				echo $my_event['evt_comment'];
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
		
				// Get private events
				$sql = "SELECT * FROM private WHERE evt_id ='".$approve_e['evt_id']."'";
				$res = mysqli_query ( $link, $sql );
				
				// if there is a private event, get the result array
				if ($res)
				{
					$private = mysqli_fetch_array($res);
					$isPrivate = true;
					
					// Get university ID
					$sql = "SELECT * FROM university WHERE unv_id ='".$private['unv_id']."'";
					$res = mysqli_query ( $link, $sql );
					$university = mysqli_fetch_array($res);
				}
				else
				{	
					// Get public events
					$sql = "SELECT * FROM public WHERE evt_id ='".$approve_e['evt_id']."'";
					$res = mysqli_query ( $link, $sql );
					$public = mysqli_fetch_array($res);
					
					$isPrivate = false;
					
					// Get university ID
					$sql = "SELECT * FROM university WHERE unv_id ='".$public['unv_id']."'";
					$res = mysqli_query ( $link, $sql );
					$university = mysqli_fetch_array($res);
				}
		
				echo "<tr><td align='left'>";
				// Event name
				echo $my_event['evt_name'];
				// Approve button
				echo "</td><td align='left'>";
				echo "<form method='post' action='includes/approveEvent.inc.php'>";
				echo "<input type='hidden' name='evt_id' value='" . $approve_e['evt_id'] . "'/>";
				echo "<input type='hidden' name='aid' value='" . $approve_e['aid'] . "'/>";
				echo "<input type='submit' name='Unapprove' value='Unapprove'/></form>";
				// University Name
				echo "</td><td align='left'>";
				echo $university['unv_name'];
				// Public or private
				echo "</td><td align='left'>";
				if ($isPrivate)
					echo "Private";
				else if (!$isPrivate)
					echo "Public";
				// Event Description
				echo "</td><td align='left'>";
				echo $my_event['evt_description'];
				// Comments
				echo "</td><td align='left'>";
				echo $my_event['evt_comment'];
				echo "</td><td align='left'></tr>";
			}
		}
		echo '</table>';
	}
	
} else {
	// Go home
	header ( "Location: index.php" );
}
