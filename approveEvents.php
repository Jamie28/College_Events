<?php include 'header.php';?>
<div id="page">


		<p class="body">
			
			<form>
				<h3> Approve Events</h3>
				
				<table>
					<tr><td> Approve or Decline </td>
					<td>
					<select>
							  <option value="UCF">Approve</option>
							  <option value="UF">Decline</option>
					</select> 
					</td></tr>
			</form>
					<form method="get" action="includes/approveEvents.inc.php">		
					<tr><td><input type="submit" value="Submit"> </td></tr>
					</form>
				</table>
			
			
		</p>
	</div>
</body>