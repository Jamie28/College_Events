<?php
include "header.php";
$evt_id = $_GET['evt_id'];
function listEventInfo() {
	
	include "dbhandler.php";
	try{
		$evt_id = $_GET['evt_id'];
		$sql = "SELECT *
				FROM my_event e, approve_e a, rso_e r
				WHERE (e.evt_id = '".$evt_id."') AND  
					       ((a.evt_id = '".$evt_id."' AND a.approved = 1) OR
					       (r.evt_id = '".$evt_id."')) ";
		$res = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
		echo "<h2>" . $row['evt_name'] . "</h2>";
		echo "<h5>Date: " . $row['evt_date'] . "</h5>";
		echo "<h5>Time: " . $row['evt_time'] . "</h5>";
		echo "<h3>" . $row['evt_description'] . "</h3>";
		echo "<h3>Contact Phone: " . $row['evt_contact'] . "</h3>";
		
		$sql = "SELECT *
				FROM locations l, takes_place p
				WHERE (l.lid = p.lid) AND (p.evt_id = '".$evt_id."' )";
		$res = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
		echo "<h3>Address: " . $row['address'] . "</h3>";
		echo "<input type='hidden' id='lat' value='" . $row['lat'] . "' />";
		echo "<input type='hidden' id='lng' value='" . $row['lng'] . "' />";

		$stmt = null;
	}
	catch(Exception $e){
		echo 'We are unable to process your request. Please try again later';
	}
}

function listCommentsAndRatings() {
	include "dbhandler.php";
	try{
		$evt_id = $_GET['evt_id'];
		$sql = "SELECT c.text, p.username
				FROM comments c, person p
				WHERE c.evt_id = '".$evt_id."' AND p.uid = c.uid";
		$res = mysqli_query($link, $sql);
		
		echo "<h3>Comments: </h3>";
		while($result = mysqli_fetch_array($res, MYSQLI_ASSOC)){
			echo "<h5>" . $result['username'] . "</h5>";
			echo $result['text'] . "\n";
			echo "<hr>";
		}
		$stmt = null;
	}
	catch(Exception $e){
		echo 'We are unable to process your request. Please try again later';
	}
}?>
<style>
#map {
width: 40%;
height: 400px;}
</style>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=898791360233489";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="page">
	<br><br><center><div class="logo"><a href="index.php"; 
	color: #333333;">College Events</a></div></center>		
		<?php 
			listEventInfo();
			echo "<br>";
		?>
  <div id="map"></div>
  <script>
	var map;
	var marker;
	var lat = Number(document.getElementById('lat').value);
	var lng = Number(document.getElementById('lng').value);
	function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: lat, lng: lng},
		zoom: 17
		});
	marker = new google.maps.Marker({
		position: {lat: lat, lng: lng},
		map: map
		});
	}
  </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ_F7TCpsW-MDsigvIsqdVeoE6hOfa__0&callback=initMap">
  </script>
  <br>
  <br>
		<?php
			listCommentsAndRatings();
		?>
	<div id="page">
	<br><br>
			<form method="post" action="comment.php?evt_id=<?php echo $evt_id; ?>">
				<table>
					<tr><td><label for="text">Add Comment:</label> </td> </tr>
					<tr><td><textarea rows="4" cols="50" id="comment" name="comment" value="" maxlength="150"></textarea></td></tr>
					<tr><td><input type="submit" value="Submit"> </td></tr>
				</table>
			</form>
			</div>
		<br>
		<div class="fb-share-button" data-href="localhost/events.php?evt_id=<?php echo $evt_id; ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
		<a class="twitter-share-button"	href="https://twitter.com/share">Tweet</a>
		<script>
			window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
		</script>
	</div>
</body>