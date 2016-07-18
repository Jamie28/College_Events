<?php
include "header.php";
function listEventInfo() {
	
	include "dbhandler.php";
	try{
		$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare("SELECT e.evt_name, e.evt_description, e.evt_date, e.evt_contact, e.evt_id, e.evt_comment FROM my_event e, public p WHERE e.evt_id = p.evt_id");
		$stmt->bindParam(':evt_id', $_GET['evt_id'], PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		echo "<h3>Name: " . $result['evt_name'] . "</h3>";
		echo "<h3>Description: " . $result['evt_description'] . "</h3>";
		echo "<h3>Date: " . $result['evt_date'] . "</h3>";
		echo "<h3>Contact Phone: " . $result['evt_contact'] . "</h3>";
		//echo "<h3>Comments: " . $result['evt_comment'] . "</h3>";
		$stmt = null;
	}
	catch(Exception $e){
		echo 'We are unable to process your request. Please try again later';
	}
}

function listCommentsAndRatings() {
	include "dbhandler.php";
	try{
		$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare("SELECT c.text, r.rating FROM comments c, ratings r, my_event e, public p WHERE e.evt_id = p.evt_id AND p.evt_id = c.evt_id AND r.comment_id = c.comment_id");
		$stmt->bindParam(':evt_id', $_GET['evt_id'], PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		echo "<h3>Comments: </h3>";
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo $result['text'] . "    " . "Rating: " .$result['rating'] . "\n";
		}
		$stmt = null;
	}
	catch(Exception $e){
		echo 'We are unable to process your request. Please try again later';
	}
}?>
<div id="page">
	<br><br><center><div class="logo"><a href="index.php"; 
	color: #333333;">College Events</a></div></center>		
		<?php 
			listEventInfo();
			echo "<br>";
			listCommentsAndRatings();
		?>
	<div id="page">
	<br><br>
			<form>
				<table>
					<tr><td> <label for="text">Add Comment:</label> </td>
						<td> <input type="text" id="comment" name="comment" value="" maxlength="150" /> </td></tr>
			</form>
			<form method="post" action="comment.php">
					<tr><td><input type="submit" value="Submit"> </td></tr>
				</table>
			</form>
			</div>
		<br>
		<a class="twitter-share-button"	href="https://twitter.com/share">Tweet</a>
		<script>
			window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
		</script>
	</div>
</body>