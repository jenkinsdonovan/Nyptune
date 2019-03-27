<?php
session_start();
include("../assets/setup/config.php");

$query = "select * from song;";
$results = mysqli_query($db, $query) or die("f");

while($row = mysqli_fetch_assoc($results)) {
	printf("<div id='songcontainer'>");
	
	printf("<div id='songname'></div>");

	printf("</div><br>");
}
