<?php
session_start();
include("../assets/setup/config.php");

$query = "select * from song;";
$results = mysqli_query($db, $query) or die("f");

$songs = array();
while($row = mysqli_fetch_assoc($results)) {
		array_push($songs, $row['SongName']);
}

echo implode(';,;', $songs) ;
