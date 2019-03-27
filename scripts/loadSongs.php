<?php
session_start();
include("../assets/setup/config.php");

$query = "select * from song;";
$results = mysqli_query($db, $query) or die("f");

while($row = mysqli_fetch_assoc($results)) {
	echo "<div id='songcontainer'>" .
		"<a onclick=\"changeSong('songs/{$row['ArtistName']}-{$row['SongID']}')\" " .
		"href='#'>" .
		"{$row['ArtistName']} - {$row['SongName']}" .	
		"</a></div><br>";
}
