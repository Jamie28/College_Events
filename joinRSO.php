<?php
include ("header.php");

if (loggedIn () && isset($_SESSION['unv_id'])) {
	
	include 'dbhandler.php';
	
	// Find rso events
	$unv_id = $_SESSION['unv_id'];
	
	$sql = "SELECT * FROM rso WHERE unv_id ='".$unv_id."'";
	$response = mysqli_query ( $link, $sql );
	
	// Find rso's that user is already a part of
	$sqlName = "SELECT * FROM in_rso WHERE uid='" . $_SESSION ['uid'] . "'";
	$res = mysqli_query ( $link, $sqlName );
	
	if ($response) 
	{
		echo '<table align="left"
				cellspacing="5" cellpadding="8">
				<tr><td align="left"><b>Name</b></td>
				<td align="left"><b>Join</b></td>
				</tr>';
		
		// mysqli_fetch_array will return a row of data from the query
		// until no further data is available
		while ( $rso = mysqli_fetch_array ( $response ) ) {

			echo "<tr><td align='left'>";
						
			echo $rso['rso_name'];
			echo "</td><td align='left'>";

			// Clickable portion of user info
			echo "<form method='get' action='joinRSO.inc.php'>
				<input type='submit' name='Join' value='Join'/>
				</form>";
			
			echo "</td><td align='left'></tr>";
		}
		
		echo '</table>';
	} else
	{	
		echo "No RSOs";
	}
} else {
	// Go home
	header ( "Location: index.php" );
}