<?php
session_start();
$location = "UCF";

function listEventInfo() {
	include "dbhandler.php";
	try{
		$dbh = new PDO("mysql:host=$server;dbname=$db_name", $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbh->prepare("SELECT evt_name, evt_description, evt_date, evt_contact, evt_comment, evt_id, location FROM my_event WHERE evt_id = :evt_id");
		$stmt->bindParam(':evt_id', $_GET['evt_id'], PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$GLOBALS['location'] = $result['location'];
		echo "<h3>Name: " . $result['evt_name'] . "</h3>";
		echo "<h3>Description: " . $result['evt_description'] . "</h3>";
		echo "<h3>Date: " . $result['evt_date'] . "</h3>";
		echo "<h3>Contact Phone: " . $result['evt_contact'] . "</h3>";
		echo "<h3>Comments: " . $result['evt_comment'] . "</h3>";
		echo $result['evt_name'] . "\t" . $result['evt_description'] . "\t" . $result['evt_date'] . "\t" . $result['evt_contact'] . "\t" . $result['evt_comment'] . "<br><br>";
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
		$stmt = $dbh->prepare("SELECT c.text, r.rating FROM comments c, ratings r, events e WHERE e.event_id = c.event_id AND r.comment_id = c.comment_id AND e.event_id = :event_id");
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
	        $result = $stmt->fetch(PDO::FETCH_ASSOC);
			$name = $result["evt_name"];
			$user_id = $row["uid"];
	        if($name == false){
	        	echo 'No public events found';
				header('Location: /');
		    }
            else{
    	        foreach($result as $output){
					 echo output;
				}
		    }
}?>
<div id="page">
	<br><br><center><div class="logo"><a href="index.php" style="text-decoration: none; 
	color: #333333;">College Event Website</a></div></center>		
		<?php 
			listEventInfo();
			echo "<br>";
			listCommentsAndRatings();
		?>
	<div id="page">
			<form>
				<table>
<!--					<tr><td> Add Comment: </td>-->
					<tr><td> <label for="text">Add Comment:</label> </td>
						<td> <input type="text" id="comment" name="comment" value="" maxlength="150" /> </td></tr>
<!--					<td> <input type="text" name="" value=""> </td></tr>-->
			</form>
			<form method="get" action="../comment_submitted.php">
					<tr><td><input type="submit" value="Submit"> </td></tr>
				</table>
			</form>
			</div>
		<br>
		<iframe
			width="600"
			height="450"
			frameborder="0" style="border:0"
			src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA-bycgCKodNWMCGD9CUspU9ZC7aGxmHbk
			&q=<?php echo $location ?>
			&attribution_source=Google+Maps+Embed+API
			&attribution_web_url=http://www.butchartgardens.com/
			&attribution_ios_deep_link_id=comgooglemaps://?daddr=Butchart+Gardens+Victoria+BC">
		</iframe>
		<a class="twitter-share-button"	href="https://twitter.com/share">Tweet</a>
		<script>
			window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
		</script>
		<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
	</div>
</body>