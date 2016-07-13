<?php
include ("header.php");
?>
<h2>Join an RSO</h2>
<?php

if (loggedIn () && isset($_SESSION['unv_id'])) {
	
	include 'dbhandler.php';
	
	// Find rso events
	$unv_id = $_SESSION['unv_id'];
	
	$sql = "SELECT * FROM rso WHERE unv_id ='".$unv_id."'";
	$response = mysqli_query ( $link, $sql );
	
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

			// Check if user is in rso
			$query = "SELECT * FROM in_rso WHERE uid='" . $_SESSION ['uid'] . "' AND rso_id = '".$rso['rso_id']."' LIMIT 1";
			$ares = mysqli_query ( $link, $query );
			if(mysqli_num_rows($ares) == 1)
				$inRSO = true;
			else
				$inRSO = false;
			
			if (!$inRSO)
			{
				// Clickable portion of user info

				echo "<form method='post' action='includes/joinRSO.inc.php'>";
				echo "<input type='hidden' name='rso_id' value='" . $rso['rso_id'] . "'/>";
				echo "<input type='submit' name='Join' value='Join'/></form>";
			}
			else
			{
				echo "<form method='post' action='includes/joinRSO.inc.php'>";
				echo "<input type='hidden' name='rso_id' value='" . $rso['rso_id'] . "'/>";
				echo "<input type='submit' name='Leave' value='Leave'/></form>";
			}
			
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
?>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br><br>

	<a href="index.php">Return</a>
	</body>